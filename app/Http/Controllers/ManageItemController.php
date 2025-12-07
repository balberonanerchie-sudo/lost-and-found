<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManageItemController extends Controller
{
   
    public function index()
    {
        $items = Item::with('owner')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('pages.manage-item', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date_found' => 'required|date',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:unclaimed,claimed,returned'
        ]);

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
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date_found' => 'required|date',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:unclaimed,claimed,returned',
            'owner_id' => 'nullable|exists:users,id'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);

        return redirect()->route('admin.items')
            ->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified item
     */
    public function destroy(Item $item)
    {
        // Delete image if exists
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('admin.items')
            ->with('success', 'Item deleted successfully!');
    }

    /**
     * Update item status
     */
    public function updateStatus(Request $request, Item $item)
    {
        $validated = $request->validate([
            'status' => 'required|in:unclaimed,claimed,returned',
            'owner_id' => 'nullable|exists:users,id'
        ]);

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item status updated successfully!',
            'item' => $item
        ]);
    }

    /**
     * Search items
     */
    public function search(Request $request)
    {
        $query = Item::query()->with('owner');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
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
}
