<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Store a new lost/found report from the student form.
     */
    public function store(Request $request)
    {
        \Log::info('REPORT STORE HIT', [
            'contact_email' => $request->input('contact_email'),
            'type'          => $request->input('type'),
        ]);

        $validated = $request->validate([
            'type'          => 'required|in:lost,found',
            'item_name'     => 'required|string|max:255',
            'category'      => 'nullable|string|max:100',
            'description'   => 'nullable|string|max:5000',
            'location'      => 'nullable|string|max:255',
            'incident_date' => 'nullable|date',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // 5MB
            'contact_email' => 'required_if:type,lost|nullable|email|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('photo')) {
            // Stored in storage/app/public/reports, served via /storage symlink
            $imagePath = $request->file('photo')->store('reports', 'public');
        }

        // Build the full data array once
        $data = [
            'user_id'       => Auth::id(),
            'type'          => $validated['type'],           // lost / found
            'item_name'     => $validated['item_name'],
            'category'      => $validated['category'] ?? null,
            'description'   => $validated['description'] ?? null,
            'location'      => $validated['location'] ?? null,
            'incident_date' => $validated['incident_date'] ?? null,
            'image_path'    => $imagePath,
            'contact_email' => $validated['contact_email'] ?? Auth::user()?->email,
            // KEY CHANGE: status by type
            'status'        => $validated['type'] === 'found'
                ? 'pending_appointment'   // hidden until admin approves
                : 'new',                  // lost reports appear immediately
            'item_id'       => null,
        ];

        // Single insert
        $report = Report::create($data);

        // For FOUND reports, go straight to the Schedule Pickup form
        if ($report->type === 'found') {
            return redirect()->route('appointments.turnover', $report->id);
        }

        // LOST reports: just show success and stay on the form (or redirect where you like)
        return redirect()->back()
            ->with('success', 'Your report has been submitted. Our staff will review it shortly.');
    }


    /**
     * Admin: list ALL reports (lost + found), with optional filters.
     */
    // app/Http/Controllers/ReportController.php

    public function index(Request $request)
    {
        $query = Report::query();

        // Filter by type (lost / found)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by category (exact match from select)
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by location (partial match)
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by status (new / linked / closed)
                if ($request->filled('status')) {
                    $query->where('status', $request->status);
                }

        // Search across item_name, location, and contact_email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('item_name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('contact_email', 'like', "%{$search}%");
            });
        }
        
        // Hide found reports that are still waiting for appointment approval
        $query->where('status', '!=', 'pending_appointment');

        $reports = $query
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString(); // keep filters/search in pagination links

        return view('pages.adminReports', compact('reports'));
    }
    /**
     * From a FOUND report, create a new Item and link them.
     */
    public function createItemFromFound(Report $report)
    {
        if ($report->type !== 'found') {
            return back()->with('error', 'Only found reports can be converted into items.');
        }

        // Basic mapping from report → items table; adjust field names if needed.
        $item = Item::create([
            'item_name'  => $report->item_name,
            'category'   => $report->category ?? 'other',
            'description'=> $report->description,
            'location'   => $report->location,
            'date_found' => $report->incident_date ?? now()->toDateString(),
            'image'      => $report->image_path,   // assumes items.image stores path
            'status'     => 'unclaimed',           // or whatever your default is
        ]);

        // Link report to the new item and mark as linked/processed.
        $report->update([
            'item_id' => $item->id,
            'status'  => 'linked',
        ]);

        return back()->with('success', 'Item created from report and linked successfully.');
    }

    /**
     * From a LOST report, redirect to Manage Items with filters
     * prefilled to help the admin visually match items.
     */
    public function matchInItems(Report $report)
    {
        if ($report->type !== 'lost') {
            return redirect()
                ->route('admin.reports')
                ->with('error', 'Matching is only available for lost reports.');
        }

        $params = [];

        if (!empty($report->category)) {
            $category = $report->category;
            if ($category === 'other') {
            $category = 'others';
        }

            $params['category'] = $report->category;
        }

        if (!empty($report->location)) {
            $params['location'] = $report->location;
        }

        if (!empty($report->item_name)) {
            $params['search'] = $report->item_name;
        }

        if (empty($params)) {
            return redirect()
                ->route('admin.items')
                ->with('warning', 'No name, category, or location on this report to use for matching.');
        }

        // /admin/items?category=...&location=...&search=...
        return redirect()->route('admin.items', $params);
    }



    /**
     * Show a simple edit form for a report.
     * (You can make a dedicated Blade later; for now this is a stub.)
     */
    public function edit(Report $report)
    {
        return view('pages.adminReportEdit', compact('report'));
    }

    /**
     * Update a report from the edit form.
     */
    public function update(Request $request)
    {
        $report = Report::findOrFail($request->input('report_id'));

        $validated = $request->validate([
            'type'          => 'required|in:lost,found',
            'item_name'     => 'required|string|max:255',
            'category'      => 'nullable|string|max:100',
            'description'   => 'nullable|string|max:5000',
            'location'      => 'nullable|string|max:255',
            'incident_date' => 'nullable|date',
            'contact_email' => 'nullable|email|max:255',
            'status'        => 'nullable|string|max:50',
        ]);

        $report->update($validated);

        return redirect()->route('admin.reports')
            ->with('success', 'Report updated successfully.');
    }


    /**
     * Delete a report.
     */
    public function destroy(Request $request)
    {
        $report = Report::findOrFail($request->input('report_id'));
        $report->delete();

        return back()->with('success', 'Report deleted successfully.');
    }

    /**
     * Admin: after matching a lost report to a found item and verifying ownership,
     * link them and finalize the claim.
     */
    public function confirmClaimFromModal(Request $request)
    {
        $data = $request->validate([
            'item_id'   => 'required|exists:items,id',
            'report_id' => 'required|exists:reports,id',
        ]);

        $item   = Item::findOrFail($data['item_id']);
        $report = Report::findOrFail($data['report_id']);

        // Safety: only allow LOST reports
        if ($report->type !== 'lost') {
            return redirect()
                ->route('admin.items')
                ->with('error', 'Only lost reports can be linked as claims.');
        }

        // 1) Mark item as claimed and set owner
        $item->update([
            'status'   => 'claimed',
            'owner_id' => $report->user_id, // assumes reports.user_id exists
        ]);

        // 2) Link lost report to item and close it
        $report->update([
            'item_id' => $item->id, // assumes reports has item_id column
            'status'  => 'closed',
        ]);

        return redirect()
            ->route('admin.items')
            ->with('success', 'Lost report linked and item marked as claimed.');
    }
}
