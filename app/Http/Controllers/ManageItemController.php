<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManageItemController extends Controller
{
    /**
     * Display a listing of items for Admin (with filters + search)
     */
    public function index(Request $request)
    {
        $query = Item::with('owner');

        // Text search: item_name, location, description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('item_name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Location filter (partial match)
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date_found', '<=', $request->date_to);
        }

        $items = $query
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends($request->query()); // keep filters/search on pagination

        return view('pages.manage-item', compact('items'));
    }

    /**
     * Display a listing of items for User
     */
    public function userIndex()
    {
        $items = Item::latest()->orderBy('created_at', 'desc')->paginate(15);
        return view('pages.studSearch', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name'   => 'required|string|max:255',
            'category'    => 'required|string',
            'description' => 'nullable|string|max:1000',
            'location'    => 'required|string|max:255',
            'date_found'  => 'required|date',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Default status
        $validated['status'] = 'unclaimed';

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        Item::create($validated);

        return redirect()->route('admin.items')
            ->with('success', 'Item added successfully!');
    }

    /**
     * Update the specified item
     */
    public function update(Request $request)
    {
        $item = Item::findOrFail($request->item_id);

        $validated = $request->validate([
            'item_name'   => 'required|string|max:255',
            'category'    => 'required|string',
            'location'    => 'required|string|max:255',
            'date_found'  => 'nullable|date',
            'description' => 'nullable|string|max:1000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'      => 'required|in:unclaimed,claimed,returned,pending',
            'owner_id'    => 'nullable|exists:users,id',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        // If date not provided, keep original
        if (empty($validated['date_found'])) {
            unset($validated['date_found']);
        }

        $item->update($validated);

        return redirect()->route('admin.items')
            ->with('success', 'Item updated successfully!');
    }

    /**
     * Delete the specified item
     */
    public function destroy(Request $request)
    {
        $item = Item::findOrFail($request->item_id);

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('admin.items')
            ->with('success', 'Item deleted successfully!');
    }

    /**
     * Update item status (JSON endpoint)
     */
    public function updateStatus(Request $request, Item $item)
    {
        $validated = $request->validate([
            'status'   => 'required|in:unclaimed,claimed,returned',
            'owner_id' => 'nullable|exists:users,id',
        ]);

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item status updated successfully!',
            'item'    => $item,
        ]);
    }

    /**
     * (Optional) Separate search endpoint – kept but aligned with item_name
     */
    public function search(Request $request)
    {
        $query = Item::query()->with('owner');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('item_name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date_found', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date_found', '<=', $request->date_to);
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('pages.manage-item', compact('items'));
    }

    public function markClaimed(Item $item)
    {
        $item->update(['status' => 'claimed']);

        return redirect()->route('admin.items')
            ->with('success', 'Item ' . $item->item_name . ' marked as Claimed.');
    }
}
