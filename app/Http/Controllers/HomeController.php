<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page with top 5 best posts.
     */
    public function index()
    {
        // Get published posts, count views, sort by views desc then latest, limit 5
        $dataKarya = PostModel::with('user')
            ->withCount('views')
            ->where('post_status', 'published')
            ->orderBy('views_count', 'desc')
            ->latest()
            ->limit(5)
            ->get();

        return view('home', compact('dataKarya'));
    }

    /**
     * Display all published posts with search functionality.
     */
    public function allPosts(Request $request)
    {
        $search = $request->input('search');

        $query = PostModel::with('user')
            ->withCount('views')
            ->where('post_status', 'published');

        // Apply search filter if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        // Sorting: Most Read by default or Latest? 
        // User asked for sorting through frequent read, 
        // but for general exploration usually latest is better, 
        // however we will stick to view count priority for consistency.
        $dataKarya = $query->orderBy('views_count', 'desc')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('posts.explore', compact('dataKarya', 'search'));
    }
}
