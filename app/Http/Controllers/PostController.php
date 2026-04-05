<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Auth;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    /**
     * Show the form for creating a new post.
     */
    public function index()
    {
        $dataKarya = PostModel::where('post_status', 'draft')->where('id_user', Auth::user()->id)->latest()->paginate(10);

        return view('posts.list', compact('dataKarya'));
    }

    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store()
    {
        $judul_tulisan = request('title');
        $isi_tulisan = request('content_karya');
        $id_user = Auth::user()->id;

        $validation = Validator::make(request()->all(), [
            'title' => 'required',
            'content_karya' => 'required',
            'thumbnail' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with('error', 'Semua kolom harus diisi dan periksa format gambar!');
        }

        $filepath = null;
        if (request()->hasFile('thumbnail')) {
            $file = request()->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storeAs('post_images', $filename, 'public');
        }

        $insertKarya = PostModel::create([
            'judul' => $judul_tulisan,
            'content' => $isi_tulisan,
            'filepath' => $filepath,
            'post_status' => 'draft',
            'id_user' => $id_user,
        ]);

        if ($insertKarya) {
            return redirect()->back()->with('success', 'Post berhasil dibuat (Placeholder)');
        } else {
            return redirect()->back()->with('error', 'Post gagal dibuat');
        }
    }

    /**
     * Show a specific post and track its views.
     */
    public function show($id)
    {
        $karya = PostModel::findOrFail($id);

        // IP Tracker Logic
        $ip = request()->ip();
        $sudahBaca = \App\Models\PostView::where('post_id', $karya->id)
            ->where('ip_address', $ip)
            ->whereDate('created_at', today())
            ->exists();
        if (!$sudahBaca) {
            \App\Models\PostView::create([
                'post_id' => $karya->id,
                'ip_address' => $ip
            ]);
        }

        return view('posts.show', compact('karya'));
    }

    /**
     * Show the edit form.
     */
    public function edit($id)
    {
        $karya = PostModel::where('id', $id)->where('id_user', Auth::user()->id)->firstOrFail();
        return view('posts.edit', compact('karya'));
    }

    /**
     * Update the post.
     */
    public function update($id)
    {
        $karya = PostModel::where('id', $id)->where('id_user', Auth::user()->id)->firstOrFail();

        $validation = Validator::make(request()->all(), [
            'title' => 'required',
            'content_karya' => 'required',
            'thumbnail' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with('error', 'Semua kolom harus diisi dan periksa format gambar!');
        }

        if (request()->hasFile('thumbnail')) {
            $file = request()->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storeAs('post_images', $filename, 'public');
            $karya->filepath = $filepath;
        }

        $karya->judul = request('title');
        $karya->content = request('content_karya');
        $karya->save();

        return redirect()->route('dashboard')->with('success', 'Karya berhasil diperbarui');
    }

    public function ajukan($id)
    {
        $karya = PostModel::where('id', $id)->where('id_user', Auth::user()->id)->firstOrFail();
        $karya->post_status = 'pending';
        $karya->save();
        return redirect()->route('posts.list')->with('success', 'Karya berhasil diajukan');
    }

    public function review()
    {
        $dataKarya = PostModel::where('id_user', Auth::user()->id)->where('post_status', 'pending')->latest()->paginate(10);
        return view('posts.review', compact('dataKarya'));
    }

    public function published()
    {
        $dataKarya = PostModel::where('id_user', Auth::user()->id)->where('post_status', 'published')->latest()->paginate(10);
        return view('posts.published', compact('dataKarya'));
    }

    // --- Admin Approval Methods ---
    public function approvalIndex()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        // Fetch pending posts and eager load the user who created them
        $dataKarya = PostModel::with('user')->where('post_status', 'pending')->latest()->paginate(10);
        return view('admin.approval', compact('dataKarya'));
    }

    public function approvePost($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $karya = PostModel::findOrFail($id);
        $karya->post_status = 'published';
        $karya->save();

        return redirect()->route('admin.approval.index')->with('success', 'Karya berhasil disetujui dan dipublikasikan');
    }

    public function rejectPost($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $karya = PostModel::findOrFail($id);
        $karya->post_status = 'draft'; // Revert back to draft for the user to fix
        $karya->save();

        return redirect()->route('admin.approval.index')->with('success', 'Karya telah dikembalikan ke draft pembuat');
    }
}
