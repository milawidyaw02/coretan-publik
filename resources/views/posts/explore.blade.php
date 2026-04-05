@extends('layouts.app')
@section('title', 'Jelajahi Karya - CoretanPublik')

<!-- Sembunyikan Sidebar agar fokus ke konten -->
@section('hide-sidebar', true)

@section('content')
<div class="container py-5">
    <!-- Header & Search Section -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bolder text-slate-800 tracking-tight mb-3">Jelajahi Inspirasi</h1>
        <p class="text-slate-500 mx-auto" style="max-width: 600px;">Telusuri ribuan karya tulis kreatif dari penulis di seluruh dunia yang telah terverifikasi oleh editor kami.</p>
        
        <div class="mt-5 mx-auto" style="max-width: 700px;">
            <form action="{{ route('posts.all') }}" method="GET" class="position-relative">
                <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border">
                    <span class="input-group-text bg-white border-0 ps-4">
                        <i class="bi bi-search text-slate-400"></i>
                    </span>
                    <input type="text" name="search" value="{{ $search }}" class="form-control border-0 py-3 shadow-none text-slate-700" placeholder="Cari judul tulisan atau kata kunci...">
                    <button class="btn btn-indigo-600 px-4 text-white fw-bold transition" type="submit">Cari</button>
                </div>
                @if($search)
                    <div class="text-start mt-2 ms-3">
                        <small class="text-slate-400">Menampilkan hasil pencarian untuk: <span class="fw-bold text-indigo-600">"{{ $search }}"</span></small>
                        <a href="{{ route('posts.all') }}" class="text-danger small ms-2 text-decoration-none hover:underline">Hapus Filter</a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Results Section -->
    <div class="row g-4 mt-2">
        @forelse ($dataKarya as $dk)
            <div class="col-12 col-md-6 col-xl-4 px-3 px-md-2">
                <div class="card h-100 border border-slate-100 shadow-sm rounded-4 overflow-hidden card-hover group cursor-pointer bg-white transition-all duration-300 hover:shadow-lg">
                    <!-- Image Wrapper -->
                    <div class="position-relative bg-slate-200 overflow-hidden" style="height: 220px;">
                        @if($dk->filepath)
                            <img src="{{ asset('storage/' . $dk->filepath) }}" class="w-100 h-100 object-fit-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $dk->judul }}">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-slate-100">
                                <i class="bi bi-image text-slate-300 display-4"></i>
                            </div>
                        @endif
                        
                        <!-- View Count Badge -->
                        <div class="position-absolute top-0 start-0 m-3 z-1">
                            <span class="badge bg-white text-indigo-600 shadow-sm px-3 py-2 rounded-pill bg-opacity-90 backdrop-blur border border-indigo-100">
                                <i class="bi bi-eye-fill me-1"></i> {{ number_format($dk->views_count) }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold text-slate-800 text-truncate-2 mb-2 group-hover:text-indigo-600 transition-colors" style="line-height: 1.4;">
                            {{ $dk->judul }}
                        </h5>
                        <p class="card-text text-slate-500 text-sm mb-4" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.6;">
                            {{ strip_tags($dk->content) }}
                        </p>
                        
                        <!-- Footer metadata -->
                        <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top border-slate-100">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($dk->user->name) }}&background=6366f1&color=fff&bold=true" class="rounded-circle shadow-sm border border-2 border-white" width="32" height="32">
                                <span class="small fw-bold text-slate-700">{{ $dk->user->name }}</span>
                            </div>
                            <small class="text-slate-400 fw-medium text-xs">{{ \Carbon\Carbon::parse($dk->created_at)->diffForHumans() }}</small>
                        </div>
                    </div>
                    <!-- Stretched Link -->
                    <a href="{{ route('posts.show', $dk->id) }}" class="stretched-link"></a>
                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center">
                <div class="bg-slate-50 rounded-4 py-5 px-3 border border-dashed border-slate-300">
                    <i class="bi bi-search text-slate-300 display-1 mb-3"></i>
                    <h4 class="fw-bold text-slate-700">Karya Tidak Ditemukan</h4>
                    <p class="text-slate-500 mb-0">Coba gunakan kata kunci lain atau telusuri semua karya.</p>
                    <a href="{{ route('posts.all') }}" class="btn btn-outline-indigo-600 rounded-pill mt-4 px-4">Tampilkan Semua</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($dataKarya->hasPages())
        <div class="d-flex justify-content-center mt-5 pt-4">
            {{ $dataKarya->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    /* Mobile specific adjustment */
    @media (max-width: 767.98px) {
        .card-body {
            padding: 1.5rem !important;
        }
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
</style>
@endsection
