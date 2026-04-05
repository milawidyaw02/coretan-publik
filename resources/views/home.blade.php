@extends('layouts.app')
@section('title', 'Beranda - CoretanPublik')

<!-- Menyembunyikan Sidebar di halaman Home -->
@section('hide-sidebar', true)

@section('content')
<!-- Hero Section (Responsive Bootstrap + Tailwind Utility) -->
<div class="bg-indigo-600 text-white rounded-4 p-4 p-md-5 mb-5 shadow-lg position-relative overflow-hidden">
    <!-- Decorative Ornaments -->
    <div class="position-absolute top-0 end-0 rounded-circle bg-white opacity-10" style="width: 400px; height: 400px; margin-top: -150px; margin-right: -150px; filter: blur(50px);"></div>
    <div class="position-absolute bottom-0 start-0 rounded-circle bg-purple-500 opacity-20" style="width: 300px; height: 300px; margin-bottom: -100px; margin-left: -50px; filter: blur(40px);"></div>
    
    <div class="position-relative z-1 text-center text-lg-start py-3">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="badge bg-white text-indigo-600 px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">v1.0 Terbuka untuk Umum</span>
                <h1 class="display-4 fw-bolder mb-3 tracking-tight" style="line-height: 1.2;">Temukan Inspirasi di Setiap Coretan.</h1>
                <p class="lead text-indigo-100 mb-4 opacity-100 fw-medium" style="max-width: 600px;">Platform terbuka bagi ribuan penulis untuk mempublikasikan karya secara gratis setelah melalui proses kurasi. Baca, tulis, dan bagikan pada dunia.</p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg rounded-pill fw-bold text-indigo-600 shadow-sm px-4 hover:scale-105 transition-transform">Masuk & Menulis</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg rounded-pill fw-bold text-indigo-600 shadow-sm px-4 hover:scale-105 transition-transform">Ke Dashboard Penulis</a>
                    @endguest
                    <a href="#karya-terkini" class="btn btn-outline-light btn-lg rounded-pill fw-medium px-4">Eksplor Karya</a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-end">
                <!-- Stacked Image Decorative -->
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=500&q=80" alt="Hero img 1" class="img-fluid rounded-4 shadow-lg position-absolute top-0 end-0 transform rotate-3" style="max-height: 280px; object-fit: cover; z-index: 2; margin-right: 20px;">
                    <!-- <img src="https://images.unsplash.com/photo-1455390582262-044cdead27d8?w=500&q=80" alt="Hero img 2" class="img-fluid rounded-4 shadow-sm opacity-75 transform -rotate-6 mt-4 me-5" style="max-height: 280px; object-fit: cover; z-index: 1;"> -->
                    <!-- Spacer equivalent to height to prevent breaking layout -->
                    <div style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Header Section Kumpulan Karya -->
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 mt-5 gap-3" id="karya-terkini">
    <div>
        <h2 class="h3 fw-bolder text-slate-800 m-0 tracking-tight">Eksplorasi Karya Terkini</h2>
        <p class="text-slate-500 m-0 small mt-1">5 Karya terpopuler pilihan pembaca.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('posts.all') }}" class="btn btn-indigo-600 text-white fw-bold rounded-pill px-4 shadow-sm transition hover:scale-105">
            Lihat Semua Karya <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>
</div>

<!-- Bootstrap Responsive Row for Cards -->
<div class="row g-4 mb-5 pb-5">
    @forelse ($dataKarya as $dk)
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border border-slate-100 shadow-sm rounded-4 overflow-hidden card-hover group cursor-pointer bg-white transition-all duration-300 hover:shadow-lg">
                <div class="position-relative bg-slate-200 overflow-hidden" style="height: 220px;">
                    @if($dk->filepath)
                        <img src="{{ asset('storage/' . $dk->filepath) }}" class="w-100 h-100 object-fit-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $dk->judul }}">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-slate-100">
                            <i class="bi bi-image text-slate-300 display-4"></i>
                        </div>
                    @endif
                    <!-- View Count Badge -->
                    <span class="badge bg-white text-indigo-600 position-absolute top-0 start-0 m-3 shadow-sm px-3 py-2 rounded-pill bg-opacity-90 backdrop-blur z-1 border border-indigo-100">
                        <i class="bi bi-eye-fill me-1"></i> {{ number_format($dk->views_count) }} Dibaca
                    </span>
                    <span class="badge bg-indigo-600 text-white position-absolute top-0 end-0 m-3 shadow-sm px-3 py-2 rounded-pill z-1">Baru</span>
                </div>
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title fw-bold text-slate-800 text-truncate-2 mb-2 group-hover:text-indigo-600 transition-colors" style="line-height: 1.4;">{{ $dk->judul }}</h5>
                    <p class="card-text text-slate-500 text-sm mb-4" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.6;">
                        {{ strip_tags($dk->content) }}
                    </p>
                    <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top border-slate-100">
                        <div class="d-flex align-items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($dk->user->name) }}&background=6366f1&color=fff&bold=true" class="rounded-circle shadow-sm border border-2 border-white" width="32" height="32">
                            <span class="small fw-bold text-slate-700">{{ $dk->user->name }}</span>
                        </div>
                        <small class="text-slate-400 fw-medium text-xs">{{ \Carbon\Carbon::parse($dk->created_at)->diffForHumans() }}</small>
                    </div>
                </div>
                <a href="{{ route('posts.show', $dk->id) }}" class="stretched-link"></a>
            </div>
        </div>
    @empty
        <div class="col-12 py-5 text-center">
            <div class="bg-slate-50 rounded-4 py-5 px-3 border border-dashed border-slate-300">
                <i class="bi bi-journal-x text-slate-300 display-1 mb-3"></i>
                <h4 class="fw-bold text-slate-700">Belum Ada Karya Terbit</h4>
                <p class="text-slate-500 mb-0">Jadilah yang pertama untuk membagikan tulisan Anda!</p>
            </div>
        </div>
    @endforelse
</div>

@endsection
