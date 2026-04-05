@extends('layouts.app')
@section('title', 'Menunggu Review - CoretanPublik')

@section('content')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="row mb-5 align-items-center">
            <div class="col-md-8 mb-3 mb-md-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-amber-100 text-amber-600 rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-hourglass-split fs-4"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold text-slate-800 mb-0">Menunggu Review</h2>
                        <p class="text-slate-500 mb-0">Semua karya Anda yang sedang dalam antrean pemeriksaan oleh Admin.</p>
                    </div>
                </div>
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
                                            style="width: 15%;">Diajukan Pada</th>
                                       
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
                                                <span class="badge bg-amber-100 text-amber-700 rounded-pill px-3 py-2 fw-medium border border-amber-200">
                                                    Menunggu Review
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-slate-600 small">{{ \Carbon\Carbon::parse($dk->updated_at)->format('d M Y') }}</td>
                                            
                                        </tr>
                                    @endforeach

                                    @if($dataKarya->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                                    <i class="bi bi-inbox text-slate-300 mb-3" style="font-size: 3.5rem;"></i>
                                                    <h5 class="fw-bold text-slate-700 mb-1">Oh, Antrean Kosong!</h5>
                                                    <p class="text-slate-500 mb-4 px-3">Saat ini tidak ada karya Anda yang sedang menunggu proses pengecekan.</p>
                                                    <a href="{{ route('posts.list') }}" class="btn btn-outline-secondary rounded-pill px-4 transition">
                                                        Lihat Semua Karya
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
