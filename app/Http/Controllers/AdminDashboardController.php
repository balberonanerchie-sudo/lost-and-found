<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Appointment;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $now        = Carbon::now();
        $startThis  = $now->copy()->startOfMonth();
        $endThis    = $now->copy()->endOfMonth();
        $startPrev  = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $endPrev    = $now->copy()->subMonthNoOverflow()->endOfMonth();

        // TOTAL ITEMS
        $totalItems          = Item::count();
        $totalItemsThis      = Item::whereBetween('created_at', [$startThis, $endThis])->count();
        $totalItemsPrev      = Item::whereBetween('created_at', [$startPrev, $endPrev])->count();
        $totalItemsChangePct = $totalItemsPrev
            ? round((($totalItemsThis - $totalItemsPrev) / $totalItemsPrev) * 100)
            : null;

        // CLAIMED ITEMS
        $claimedItems          = Item::where('status', 'claimed')->count();
        $claimedThis           = Item::where('status', 'claimed')
            ->whereBetween('updated_at', [$startThis, $endThis])->count();
        $claimedPrev           = Item::where('status', 'claimed')
            ->whereBetween('updated_at', [$startPrev, $endPrev])->count();
        $claimedItemsChangePct = $claimedPrev
            ? round((($claimedThis - $claimedPrev) / $claimedPrev) * 100)
            : null;

        // PENDING CLAIMS (appointments that are claims and not completed/cancelled)
        $pendingClaims          = Appointment::where('type', 'claim')
            ->whereIn('status', ['pending', 'approved'])->count();
        $pendingThis            = Appointment::where('type', 'claim')
            ->whereIn('status', ['pending', 'approved'])
            ->whereBetween('created_at', [$startThis, $endThis])->count();
        $pendingPrev            = Appointment::where('type', 'claim')
            ->whereIn('status', ['pending', 'approved'])
            ->whereBetween('created_at', [$startPrev, $endPrev])->count();
        $pendingClaimsChangePct = $pendingPrev
            ? round((($pendingThis - $pendingPrev) / $pendingPrev) * 100)
            : null;

        // ACTIVE USERS (reuse same stats as Manage Users)
        $activeUsers          = User::where('status', 'active')->count();
        $activeThis           = User::where('status', 'active')
            ->whereBetween('created_at', [$startThis, $endThis])->count();
        $activePrev           = User::where('status', 'active')
            ->whereBetween('created_at', [$startPrev, $endPrev])->count();
        $activeUsersChangePct = $activePrev
            ? round((($activeThis - $activePrev) / $activePrev) * 100)
            : null;

        // REPORTS FOR CHART (last 7 days vs previous 7 days)
        $startRange     = $now->copy()->subDays(6)->startOfDay();  // last 7 days
        $endRange       = $now->copy()->endOfDay();
        $startPrevRange = $now->copy()->subDays(13)->startOfDay(); // previous 7 days
        $endPrevRange   = $now->copy()->subDays(7)->endOfDay();

        $totalReports      = Report::whereBetween('created_at', [$startRange, $endRange])->count();
        $lostReportsCount  = Report::where('type', 'lost')
            ->whereBetween('created_at', [$startRange, $endRange])->count();
        $foundReportsCount = Report::where('type', 'found')
            ->whereBetween('created_at', [$startRange, $endRange])->count();

        $totalReportsPrev = Report::whereBetween('created_at', [$startPrevRange, $endPrevRange])->count();
        $reportsChangePct = $totalReportsPrev
            ? round((($totalReports - $totalReportsPrev) / $totalReportsPrev) * 100)
            : null;

        // GROUPED LOST/FOUND COUNTS FOR LAST 7 DAYS
        $labels      = [];
        $lostPerDay  = [];
        $foundPerDay = [];

        for ($i = 6; $i >= 0; $i--) {
            $day      = $now->copy()->subDays($i);
            $labels[] = $day->format('D'); // Mon, Tue, ...

            $startDay = $day->copy()->startOfDay();
            $endDay   = $day->copy()->endOfDay();

            $lostPerDay[] = Report::where('type', 'lost')
                ->whereBetween('created_at', [$startDay, $endDay])
                ->count();

            $foundPerDay[] = Report::where('type', 'found')
                ->whereBetween('created_at', [$startDay, $endDay])
                ->count();
        }

        return view('pages.AdminDashboard', compact(
            'totalItems',
            'totalItemsChangePct',
            'claimedItems',
            'claimedItemsChangePct',
            'pendingClaims',
            'pendingClaimsChangePct',
            'activeUsers',
            'activeUsersChangePct',
            'totalReports',
            'reportsChangePct',
            'lostReportsCount',
            'foundReportsCount',
            'labels',
            'lostPerDay',
            'foundPerDay'
        ));
    }
}
