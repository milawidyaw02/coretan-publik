<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Models\PostView;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $totalUsers = User::where('role', 'user')->count();
            $currentMonthUsers = User::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->where('role', 'user')
                ->count();
            $lastMonthUsers = User::whereMonth('created_at', now()->subMonth()->month)
                ->whereYear('created_at', now()->year)
                ->where('role', 'user')
                ->count();

            if ($lastMonthUsers > 0) {
                $growth = (($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100;
            } else {
                $growth = $currentMonthUsers > 0 ? 100 : 0;
            }

            if ($currentMonthUsers > $lastMonthUsers) {
                $status = 'up';
            } elseif ($currentMonthUsers < $lastMonthUsers) {
                $status = 'down';
            } else {
                $status = 'stable';
            }

            $needReview = PostModel::where('post_status', 'pending')->count();
            $countPublished = PostModel::where('post_status', 'published')->count();
            // $totalPosts = PostModel::count();
            // $totalPending = PostModel::where('status', 'pending')->count();
            // $totalApproved = PostModel::where('status', 'approved')->count();

            return view('dashboard-admin', compact('totalUsers', 'growth', 'status', 'needReview', 'countPublished'));
        } else {
            $totalPublikasi = PostModel::where('id_user', Auth::user()->id)->where('post_status', 'published')->count();
            $totalOutstanding = PostModel::where('id_user', Auth::user()->id)->where('post_status', 'pending')->count();
            $totalDraft = PostModel::where('id_user', Auth::user()->id)->where('post_status', 'draft')->count();

            $userPostIds = PostModel::where('id_user', Auth::user()->id)->pluck('id');
            // $totalPembaca = PostView::whereIn('post_id', $userPostIds)->count();
            $listCurrent5 = PostModel::where('id_user', Auth::user()->id)->limit(5)->get();
            return view('dashboard', compact('totalPublikasi', 'totalOutstanding', 'totalDraft', 'listCurrent5'));
        }
    }
}
