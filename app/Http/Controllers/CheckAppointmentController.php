<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class CheckAppointmentController extends Controller
{
    /**
     * Display a listing of appointments
     */
    public function index()
    {
        $appointments = Appointment::with(['user', 'item'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(15);

        return view('pages.check-appointment', compact('appointments'));
    }

    /**
     * Store a newly created appointment
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:1000',
            'status' => 'nullable|in:pending,confirmed,completed,cancelled'
        ]);

        // Default status to pending if not provided
        $validated['status'] = $validated['status'] ?? 'pending';

        Appointment::create($validated);

        return redirect()->back()
            ->with('success', 'Appointment booked successfully!');
    }

    /**
     * Update the specified appointment
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified appointment
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment deleted successfully!');
    }

    /**
     * Update appointment status
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment->update($validated);

        // If appointment is completed, mark item as claimed
        if ($validated['status'] === 'completed') {
            $appointment->item->update([
                'status' => 'claimed',
                'owner_id' => $appointment->user_id
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Appointment status updated successfully!',
            'appointment' => $appointment->load(['user', 'item'])
        ]);
    }

    /**
     * Get appointments for calendar (API endpoint)
     */
    public function calendar()
    {
        $appointments = Appointment::with(['user', 'item'])
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->item->name . ' - ' . $appointment->user->name,
                    'start' => $appointment->date . 'T' . $appointment->time,
                    'status' => $appointment->status,
                    'className' => 'fc-event-' . $appointment->status,
                    'extendedProps' => [
                        'user' => $appointment->user->name,
                        'item' => $appointment->item->name,
                        'notes' => $appointment->notes
                    ]
                ];
            });

        return response()->json($appointments);
    }

    /**
     * Search appointments
     */
    public function search(Request $request)
    {
        $query = Appointment::with(['user', 'item']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('item', function($itemQuery) use ($search) {
                    $itemQuery->where('name', 'like', "%{$search}%");
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

        $appointments = $query->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(15);

        return view('pages.check-appointment', compact('appointments'));
    }
}
