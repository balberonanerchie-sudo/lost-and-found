<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class ManageUserController extends Controller
{
    /**
     * Display a listing of users (with filters + search).
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Global search: name, email, department
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%");
            });
        }

        // Role filter (admin / user)
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Status filter (active / inactive)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends($request->query());

        // ---- SUMMARY COUNTS ----
        $totalUsers    = User::count();
        $activeUsers   = User::where('status', 'active')->count();
        $adminCount    = User::where('role', 'admin')->count();
        $inactiveUsers = User::where('status', 'inactive')->count();

        // ---- MONTH-OVER-MONTH PERCENTAGES (based on new users each month) ----
        $startThisMonth = now()->startOfMonth();
        $startLastMonth = (clone $startThisMonth)->subMonth();
        $endLastMonth   = (clone $startThisMonth)->subSecond();

        // Helper closure
        $percentChange = function ($thisMonth, $lastMonth) {
            if ($lastMonth <= 0) {
                return null; // avoid division by zero / meaningless %
            }
            return (int) round((($thisMonth - $lastMonth) / $lastMonth) * 100);
        };

        // Total users: new accounts by month
        $newTotalThisMonth = User::whereBetween('created_at', [$startThisMonth, now()])->count();
        $newTotalLastMonth = User::whereBetween('created_at', [$startLastMonth, $endLastMonth])->count();
        $totalUsersChangePct = $percentChange($newTotalThisMonth, $newTotalLastMonth);

        // Active users: new active accounts
        $newActiveThisMonth = User::where('status', 'active')
            ->whereBetween('created_at', [$startThisMonth, now()])->count();
        $newActiveLastMonth = User::where('status', 'active')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])->count();
        $activeUsersChangePct = $percentChange($newActiveThisMonth, $newActiveLastMonth);

        // Admins: new admins
        $newAdminsThisMonth = User::where('role', 'admin')
            ->whereBetween('created_at', [$startThisMonth, now()])->count();
        $newAdminsLastMonth = User::where('role', 'admin')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])->count();
        $adminChangePct = $percentChange($newAdminsThisMonth, $newAdminsLastMonth);

        // Inactive users: new inactives
        $newInactiveThisMonth = User::where('status', 'inactive')
            ->whereBetween('created_at', [$startThisMonth, now()])->count();
        $newInactiveLastMonth = User::where('status', 'inactive')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])->count();
        $inactiveChangePct = $percentChange($newInactiveThisMonth, $newInactiveLastMonth);

        return view('pages.manage-user', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'adminCount',
            'inactiveUsers',
            'totalUsersChangePct',
            'activeUsersChangePct',
            'adminChangePct',
            'inactiveChangePct'
        ));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:8|confirmed',
            'role'       => ['required', Rule::in(['admin', 'user'])],
            'status'     => ['required', Rule::in(['active', 'inactive'])],
            'department' => 'nullable|string|max:255',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users')
            ->with('success', 'User created successfully!');
    }

    /**
     * Update the specified user (id comes from form).
     */
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        // Prevent changing own status to inactive while logged in
        if ($user->id === auth()->id() && $request->status === 'inactive') {
            return redirect()->route('admin.users')
                ->with('error', 'You cannot set your own account to inactive while logged in.');
        }


        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'role'       => ['required', Rule::in(['admin', 'user'])],
            'status'     => ['required', Rule::in(['active', 'inactive'])],
            'department' => 'nullable|string|max:255',
            'password'   => 'nullable|string|min:8|confirmed',
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user (id comes from form).
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);

        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')
                ->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully!');
    }

    /**
     * Update user role only (kept for future AJAX use; still uses route model binding).
     */
    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        // Prevent changing own role
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot change your own role!',
            ], 403);
        }

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'User role updated successfully!',
            'user'    => $user,
        ]);
    }

    /**
     * Legacy search endpoint: reuse index() logic.
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }
}
