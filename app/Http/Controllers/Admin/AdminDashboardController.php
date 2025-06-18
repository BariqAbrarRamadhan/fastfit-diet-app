<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WaterLog;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->query('tab', 'overview');
        $today = Carbon::today();
        $totalUsers = User::count();
        $totalArticles = Article::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $dailyWeightLogs = WeightLog::whereDate('created_at', $today)->count();
        $dailyWaterLogs = WaterLog::whereDate('created_at', $today)->count();
        $dailyActivities = $dailyWeightLogs + $dailyWaterLogs;

        $stats = [
            [
                'title' => 'Total Pengguna',
                'value' => $totalUsers,
                'icon' => 'users',
                'change' => '+12.5%', // TODO: hitung growth jika ingin
                'isPositive' => true,
            ],
            // [
            //     'title' => 'Aktivitas Harian',
            //     'value' => $dailyActivities,
            //     'icon' => 'activity',
            //     'change' => '+8.2%', // TODO: hitung growth jika ingin
            //     'isPositive' => true,
            // ],
            [
                'title' => 'Konten Baru',
                'value' => $totalArticles,
                'icon' => 'file-text',
                'change' => '+15.3%', // TODO: hitung growth jika ingin
                'isPositive' => true,
            ],
            [
                'title' => 'Admin Aktif',
                'value' => $totalAdmins,
                'icon' => 'shield',
                'change' => '-2.1%', // TODO: hitung growth jika ingin
                'isPositive' => false,
            ],
        ];

        // Recent activities: ambil dari log berat, air, dan user terbaru
        $recentWeightLogs = WeightLog::with('user')->latest()->take(3)->get()->map(function ($log) {
            return [
                'user' => $log->user->name ?? '-',
                'action' => 'mencatat berat badan (' . $log->weight . ' kg)',
                'time' => $log->created_at->diffForHumans(),
                'avatar' => $log->user->image ?? asset('images/placeholder.svg'),
            ];
        });
        $recentWaterLogs = WaterLog::with('user')->latest()->take(2)->get()->map(function ($log) {
            return [
                'user' => $log->user->name ?? '-',
                'action' => 'mencatat minum air (' . $log->volume . ' ml)',
                'time' => $log->created_at->diffForHumans(),
                'avatar' => $log->user->image ?? asset('images/placeholder.svg'),
            ];
        });
        $recentActivities = $recentWeightLogs->concat($recentWaterLogs)->sortByDesc('time')->take(5)->values();

        // Fallback jika tidak ada aktivitas
        if ($recentActivities->isEmpty()) {
            $recentActivities = collect([
                [
                    'user' => 'System',
                    'action' => 'aplikasi siap digunakan',
                    'time' => 'baru saja',
                    'avatar' => asset('images/placeholder.svg'),
                ],
                [
                    'user' => 'Admin',
                    'action' => 'dashboard siap diakses',
                    'time' => '1 menit yang lalu',
                    'avatar' => asset('images/placeholder.svg'),
                ]
            ]);
        }

        $recentUsers = User::latest()->take(5)->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at->format('d M Y'),
                'role' => $user->role ?? 'user',
                'image' => $user->image ?? asset('images/placeholder.svg'),
            ];
        })->toArray();

        return view('admin.dashboard', compact('activeTab', 'stats', 'recentActivities', 'recentUsers', 'totalUsers'));
    }
}