<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\UrbanVillage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total User
        $totalUsers = User::count();

        // Total UMKM berdasarkan status
        $totalActiveBusinesses = Business::where('status', 'Aktif')->count();
        $totalInactiveBusinesses = Business::where('status', 'Tidak Aktif')->count();

        // Query UMKM per bulan
        $businessesPerMonth = Business::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Buat array 1–12 bulan
        $months = [];
        foreach (range(1, 12) as $m) {
            $months[$m] = $businessesPerMonth[$m] ?? 0;
        }

        // Label bulan dengan Carbon (Bahasa Indonesia)
        Carbon::setLocale('id');
        $monthLabels = [];
        foreach (range(1, 12) as $m) {
            $monthLabels[] = Carbon::create(null, $m, 1)->locale('id')->translatedFormat('F');
        }

        // Kategorikan umkm berdasarkan kelurahannya
        $businessesPerVillage = UrbanVillage::withCount('businesses')->get();

        return view('dashboard.index', compact(
            'totalUsers',
            'totalActiveBusinesses',
            'totalInactiveBusinesses',
            'months',
            'monthLabels',
            'businessesPerVillage'
        ));
    }
}
