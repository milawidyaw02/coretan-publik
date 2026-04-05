@extends('layouts.app')
@section('title', 'Karya Terpublikasi - CoretanPublik')

@section('content')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="row mb-5 align-items-center">
            <div class="col-md-8 mb-3 mb-md-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-emerald-100 text-emerald-600 rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold text-slate-800 mb-0">Karya Terpublikasi</h2>
                        <p class="text-slate-500 mb-0">Karya terbaik Anda yang sudah lolos seleksi dan dapat dinikmati masyarakat umum.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('posts.create') }}"
                    class="btn btn-primary fw-bold px-4 py-2.5 rounded-pill d-inline-flex align-items-center gap-2 shadow hover:shadow-lg transition transform hover:-translate-y-1"
                    style="background-color: #4F46E5; border-color: #4F46E5;">
                    <i class="bi bi-plus-lg"></i>
                    Tulis Karya Baru
                </a>
            </div>
        </div>

        <!-- Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white/90 backdrop-blur">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-slate-50 border-bottom border-slate-200">
                                    <tr>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase"
                                            style="width: 5%;">No</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase"
                                            style="width: 15%;">Thumbnail</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase"
                                            style="width: 35%;">Judul Karya</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase"
                                            style="width: 10%;">Status</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase"
                                            style="width: 15%;">Dipublikasikan</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase text-center"
                                            style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataKarya as $dk)
                                        <tr class="border-bottom border-slate-100 transition duration-200 hover:bg-slate-50">
                                            <td class="py-3 px-4 text-slate-600 fw-medium">{{ $loop->iteration }}</td>
                                            <td class="py-3 px-4">
                                                <div class="rounded-3 bg-slate-100 overflow-hidden d-flex align-items-center justify-content-center shadow-sm"
                                                    style="width: 80px; height: 56px;">
                                                    @if($dk->filepath)
                                                        <img src="{{ asset('storage/' . $dk->filepath) }}" alt="Thumbnail"
                                                            class="w-100 h-100 object-fit-cover">
                                                    @else
                                                        <i class="bi bi-image text-slate-400 fs-4"></i>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <h6 class="mb-1 fw-bold text-slate-800">{{ $dk->judul }}</h6>
                                                <div class="text-slate-500 small text-truncate" style="max-width: 250px;">
                                                    {{ $dk->content }}
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="badge bg-emerald-100 text-emerald-700 rounded-pill px-3 py-2 fw-medium border border-emerald-200">
                                                    <i class="bi bi-check-circle me-1"></i> Terpublikasi
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-slate-600 small">{{ \Carbon\Carbon::parse($dk->updated_at)->format('d M Y') }}</td>
                                            <td class="py-3 px-4 text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('posts.show', $dk->id) }}"
                                                        class="btn btn-sm btn-light bg-indigo-50 text-indigo-600 hover:bg-indigo-100 border-0 rounded-3 d-flex align-items-center gap-1 transition px-3"
                                                        style="height: 36px;" title="Baca Rilis">
                                                        <i class="bi bi-eye"></i> <span class="fw-medium">Baca</span>
                                                    </a>
                                                    
                                                    <button type="button"
                                                        class="btn btn-sm btn-light bg-red-50 text-red-600 hover:bg-red-100 border-0 rounded-3 d-flex align-items-center justify-content-center transition"
                                                        style="width: 36px; height: 36px;" title="Take-Down Karya Ini">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if($dataKarya->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                                    <i class="bi bi-globe text-slate-300 mb-3" style="font-size: 3.5rem;"></i>
                                                    <h5 class="fw-bold text-slate-700 mb-1">Belum Ada yang Pamer!</h5>
                                                    <p class="text-slate-500 mb-4 px-3">Belum ada satupun karya Anda yang tayang. Terus hasilkan tulisan emasmu ya!</p>
                                                    <a href="{{ route('posts.list') }}" class="btn btn-outline-secondary rounded-pill px-4 transition">
                                                        Kembali ke Draft
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($dataKarya->hasPages())
                        <div class="card-footer bg-white border-top border-slate-100 p-4 pb-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <span class="text-slate-500 small fw-medium">Menampilkan {{ $dataKarya->firstItem() }} hingga {{ $dataKarya->lastItem() }}</span>
                            <div class="d-flex justify-content-end mb-0">{{ $dataKarya->links('pagination::bootstrap-5') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
