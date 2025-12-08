<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Item;
use App\Models\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckAppointmentController extends Controller
{
    /**
     * Admin: list all appointments (with filters/pagination).
     */
    public function index()
    {
        $pending = Appointment::with(['user', 'item'])
            ->where('status', 'pending')
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        $approved = Appointment::with(['user', 'item'])
            ->where('status', 'approved')
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        $completed = Appointment::with(['user', 'item'])
            ->where('status', 'completed')
            ->orderBy('date', 'desc')
            ->get();

        // Stats for the cards
        $totalCount     = Appointment::count();
        $pendingCount   = $pending->count();
        $approvedCount  = $approved->count();
        $completedCount = $completed->count();

        return view('pages.check-appointment', compact(
            'pending',
            'approved',
            'completed',
            'totalCount',
            'pendingCount',
            'approvedCount',
            'completedCount'
        ));
    }


    /**
     * Student: read-only list of this user's appointments.
     */
    public function studentIndex()
    {
        $appointments = Appointment::with('item')
            ->where('user_id', auth()->id())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->paginate(10);

        return view('pages.studAppointmentsRead', compact('appointments'));
    }

    /**
     * Store a newly created appointment.
     */
    public function store(Request $request)
    {
        $type = $request->input('type'); // 'turnover' or 'claim'

        $rules = [
            'type'  => 'required|in:turnover,claim',
            'date'  => 'required|date|after_or_equal:today',
            'time'  => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ];

        if ($type === 'claim') {
            $rules['item_id'] = 'required|exists:items,id';
        } else {
            $rules['item_id'] = 'nullable|exists:items,id';
        }

        $validated = $request->validate($rules);

        // Convert "01:00 PM" → "13:00:00" for MySQL TIME column
        $timeString = $validated['time'];

        if (preg_match('/am|pm/i', $timeString)) {
            $validated['time'] = Carbon::createFromFormat('h:i A', $timeString)
                ->format('H:i:s');
        } else {
            // If already 24h like "13:00", normalize to "13:00:00"
            if (preg_match('/^\d{2}:\d{2}$/', $timeString)) {
                $validated['time'] = $timeString . ':00';
            }
        }

        $validated['user_id'] = auth()->id();
        $validated['status']  = 'pending';

        Appointment::create($validated);

        return redirect()
            ->route('report')
            ->with('success', 'Appointment booked successfully!');
    }




    /**
     * Update the specified appointment (admin).
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'date'   => 'required|date',
            'time'   => 'required|date_format:H:i',
            'notes'  => 'nullable|string|max:1000',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified appointment (admin).
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment deleted successfully!');
    }

    /**
     * Update appointment status (admin, often via AJAX).
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update($validated);

        // If appointment is completed, mark item as claimed
        if ($validated['status'] === 'completed' && $appointment->item) {
            $appointment->item->update([
                'status'   => 'claimed',
                'owner_id' => $appointment->user_id,
            ]);
        }

        return response()->json([
            'success'     => true,
            'message'     => 'Appointment status updated successfully!',
            'appointment' => $appointment->load(['user', 'item']),
        ]);
    }

    /**
     * Get appointments for calendar (API endpoint).
     */
    public function calendar()
    {
        $appointments = Appointment::with(['user', 'item'])
            ->get()
            ->map(function ($appointment) {
                $itemName = $appointment->item->name
                    ?? $appointment->item->item_name
                    ?? 'Item';

                return [
                    'id'         => $appointment->id,
                    'title'      => $itemName . ' - ' . $appointment->user->name,
                    'start'      => $appointment->date . 'T' . $appointment->time,
                    'status'     => $appointment->status,
                    'className'  => 'fc-event-' . $appointment->status,
                    'extendedProps' => [
                        'user'  => $appointment->user->name,
                        'item'  => $itemName,
                        'notes' => $appointment->notes,
                    ],
                ];
            });

        return response()->json($appointments);
    }

    /**
     * Admin search/filter appointments.
     */
    public function search(Request $request)
    {
        $query = Appointment::with(['user', 'item']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })->orWhereHas('item', function ($itemQuery) use ($search) {
                    $itemQuery->where('name', 'like', "%{$search}%")
                              ->orWhere('item_name', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        $appointments = $query
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(15);

        return view('pages.check-appointment', compact('appointments'));
    }
    /**
     * Student: show Schedule Pickup form for a specific item (Claim flow).
     */
    public function createClaim(Item $item)
    {
        $user = auth()->user();

        return view('pages.studAppointment', compact('item', 'user'));
    }

    /**
     * Student: show Schedule Pickup form after a FOUND report (turnover).
     */
    public function createTurnover(Report $report)
    {
        $user = auth()->user();

        return view('pages.studAppointment', [
            'user'   => $user,
            'report' => $report,
            'mode'   => 'turnover',
        ]);
    }
    public function approve(Appointment $appointment)
    {
        $appointment->update(['status' => 'approved']);

        return redirect()
            ->route('admin.appointments')
            ->with('success', 'Appointment approved successfully.');
    }

    public function reject(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);

        return redirect()
            ->route('admin.appointments')
            ->with('success', 'Appointment cancelled. Ask the user to book a new time.');
    }


    public function complete(Appointment $appointment)
    {
        $appointment->update(['status' => 'completed']);

        // If linked to an item, mark it claimed
        if ($appointment->item_id) {
            $appointment->item->update([
                'status'   => 'claimed',
                'owner_id' => $appointment->user_id,
            ]);
        }

        return redirect()
            ->route('admin.appointments')
            ->with('success', 'Appointment marked as completed.');
    }

    public function cancel(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);

        return redirect()
            ->route('admin.appointments')
            ->with('success', 'Appointment cancelled.');
    }

}
