@extends('layouts.app')
@section('title', 'Persetujuan Tulisan - Admin Panel')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-8 mb-3 mb-md-0">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-red-100 text-red-600 rounded-circle d-flex align-items-center justify-content-center shadow-sm border border-red-200" style="width: 54px; height: 54px;">
                    <i class="bi bi-shield-check fs-3"></i>
                </div>
                <div>
                    <h2 class="fw-bold text-slate-800 mb-0 tracking-tight">Persetujuan Tulisan</h2>
                    <p class="text-slate-500 mb-0">Tinjau dan setujui karya yang dikirimkan oleh para penulis sebelum dipublikasikan.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Feedback Alerts -->
    @if(session('success'))
        <div class="alert alert-success rounded-3 mb-4 border-0 bg-green-50 text-green-700 d-flex align-items-center shadow-sm">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger rounded-3 mb-4 border-0 bg-red-50 text-red-700 d-flex align-items-center shadow-sm">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white/90 backdrop-blur">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-slate-50 border-bottom border-slate-200">
                                <tr>
                                    <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase" style="width: 5%;">No</th>
                                    <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase" style="width: 25%;">Penulis</th>
                                    <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase" style="width: 35%;">Judul Karya</th>
                                    <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase" style="width: 15%;">Tanggal Dikirim</th>
                                    <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase text-center" style="width: 20%;">Aksi Review</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Looping Data -->
                                @forelse ($dataKarya ?? [] as $dk)
                                    <tr class="border-bottom border-slate-100 transition duration-200 hover:bg-slate-50">
                                        <td class="py-3 px-4 text-slate-600 fw-medium">{{ $loop->iteration }}</td>
                                        <td class="py-3 px-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($dk->user->name ?? 'Penulis') }}&background=E0E7FF&color=4F46E5&bold=true" class="rounded-circle me-3 border border-slate-200" width="40" height="40" alt="Avatar">
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-slate-800 tracking-tight">{{ $dk->user->name ?? 'Nama Penulis' }}</h6>
                                                    <span class="text-slate-500 text-xs">{{ $dk->user->email ?? 'email@example.com' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <h6 class="mb-1 fw-bold text-slate-800">{{ $dk->judul }}</h6>
                                            <div class="text-slate-500 small text-truncate" style="max-width: 250px;">
                                                <i class="bi bi-file-earmark-text text-slate-400 me-1"></i> Mode Review
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-slate-600 small">{{ $dk->created_at ? $dk->created_at->format('d M Y - H:i') : 'Tanggal Tidak Diketahui' }}</td>
                                        <td class="py-3 px-4 text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <!-- Tombol Review (Lihat Full Content) -->
                                                <a href="#" class="btn btn-sm btn-light bg-indigo-50 text-indigo-600 hover:bg-indigo-100 border-0 rounded-3 d-flex align-items-center transition" title="Baca Naskah">
                                                    <i class="bi bi-book me-1"></i> Baca
                                                </a>
                                                
                                                <!-- Action form untuk proses logika (dikerjakan oleh user nanti) -->
                                                <form action="#" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="button" class="btn btn-sm text-white fw-semibold rounded-3 d-flex align-items-center transition shadow-sm hover:-translate-y-0.5" style="background-color: #10B981;" title="Setujui">
                                                        <i class="bi bi-check-lg me-1"></i> Terima
                                                    </button>
                                                </form>

                                                <form action="#" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="button" class="btn btn-sm text-white fw-semibold rounded-3 d-flex align-items-center transition shadow-sm hover:-translate-y-0.5" style="background-color: #EF4444;" title="Tolak">
                                                        <i class="bi bi-x-lg me-1"></i> Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Empty State Jika Tidak Ada Antrian Review -->
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                                <div class="bg-green-50 text-green-500 rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm border border-green-100" style="width: 80px; height: 80px;">
                                                    <i class="bi bi-inbox fs-1"></i>
                                                </div>
                                                <h5 class="fw-bold text-slate-700 mb-1">Semua Telah Direview</h5>
                                                <p class="text-slate-500 mb-0">Hore! Tidak ada antrian karya baru yang menunggu persetujuan Anda saat ini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Pagination Footer -->
                @if(isset($dataKarya) && $dataKarya instanceof \Illuminate\Pagination\LengthAwarePaginator && $dataKarya->hasPages())
                <div class="card-footer bg-white border-top border-slate-100 p-4 pb-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <span class="text-slate-500 small fw-medium">
                        Menampilkan {{ $dataKarya->firstItem() }} hingga {{ $dataKarya->lastItem() }} dari {{ $dataKarya->total() }} antrian
                    </span>
                    <div class="d-flex justify-content-end mb-0">
                        {{ $dataKarya->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection
