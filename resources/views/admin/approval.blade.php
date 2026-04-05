@extends('layouts.app')
@section('title', 'Persetujuan Tulisan - Panel Admin')

@section('content')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="row mb-5 align-items-center">
            <div class="col-md-8 mb-3 mb-md-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-indigo-100 text-indigo-600 rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-clipboard-check fs-4"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold text-slate-800 mb-0">Persetujuan Tulisan</h2>
                        <p class="text-slate-500 mb-0">Moderasi karya yang diajukan oleh penulis sebelum dipublikasikan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="bg-white px-4 py-2 rounded-4 shadow-sm border border-slate-100 d-inline-flex align-items-center">
                    <span class="text-slate-400 small me-2">Total Antrean:</span>
                    <span class="badge bg-danger rounded-pill fw-bold">{{ $dataKarya->total() }}</span>
                </div>
            </div>
        </div>

        <!-- Approval Table -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white/90 backdrop-blur">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-slate-50 border-bottom border-slate-200">
                                    <tr>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase" style="width: 5%;">No</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase" style="width: 20%;">Penulis</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase" style="width: 45%;">Karya & Cuplikan</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase text-center" style="width: 30%;">Aksi Moderasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataKarya as $dk)
                                        <tr class="border-bottom border-slate-100 transition duration-200 hover:bg-slate-50">
                                            <td class="py-3 px-4 text-slate-400 small fw-medium">{{ $loop->iteration + ($dataKarya->currentPage() - 1) * $dataKarya->perPage() }}</td>
                                            <td class="py-3 px-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($dk->user->name) }}&background=6366f1&color=fff&bold=true" 
                                                        alt="" class="rounded-circle me-3 shadow-sm border border-2 border-white" width="40" height="40">
                                                    <div>
                                                        <h6 class="mb-0 fw-bold text-slate-900 text-sm">{{ $dk->user->name }}</h6>
                                                        <small class="text-slate-400">{{ \Carbon\Carbon::parse($dk->created_at)->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="d-flex align-items-start gap-3">
                                                    <div class="rounded-3 bg-slate-100 overflow-hidden shadow-sm d-flex align-items-center justify-content-center flex-shrink-0" style="width: 70px; height: 50px;">
                                                        @if($dk->filepath)
                                                            <img src="{{ asset('storage/' . $dk->filepath) }}" alt="Thumb" class="w-100 h-100 object-fit-cover">
                                                        @else
                                                            <i class="bi bi-image text-slate-300"></i>
                                                        @endif
                                                    </div>
                                                    <div class="overflow-hidden">
                                                        <h6 class="mb-1 fw-bold text-slate-800 text-truncate" title="{{ $dk->judul }}">{{ $dk->judul }}</h6>
                                                        <p class="text-slate-500 mb-0 small text-truncate-2" style="max-height: 38px; line-height: 1.4;">
                                                            {{ strip_tags($dk->content) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <!-- Detail Button -->
                                                    <a href="{{ route('posts.show', $dk->id) }}" class="btn btn-light border-slate-200 text-slate-600 btn-sm rounded-pill px-3 transition hover:shadow-sm" target="_blank">
                                                        <i class="bi bi-eye me-1"></i> Detail
                                                    </a>

                                                    <!-- Approve Button -->
                                                    <form action="{{ route('admin.approval.approve', $dk->id) }}" method="POST" id="form-approve-{{ $dk->id }}">
                                                        @csrf
                                                        <button type="button" class="btn btn-emerald-soft text-emerald-700 btn-sm rounded-pill px-3 transition hover:shadow-sm fw-bold border border-emerald-100" 
                                                            onclick="confirmAction('form-approve-{{ $dk->id }}', 'Setujui Karya?', 'Karya ini akan segera dipublikasikan di halaman utama.', 'Terima', '#10B981')">
                                                            <i class="bi bi-check-circle me-1"></i> Terima
                                                        </button>
                                                    </form>

                                                    <!-- Reject Button -->
                                                    <form action="{{ route('admin.approval.reject', $dk->id) }}" method="POST" id="form-reject-{{ $dk->id }}">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger-soft text-danger btn-sm rounded-pill px-3 transition hover:shadow-sm fw-bold border border-danger-100"
                                                            onclick="confirmAction('form-reject-{{ $dk->id }}', 'Tolak & Kembalikan?', 'Karya akan dikembalikan ke Draft penulis untuk diperbaiki.', 'Tolak', '#EF4444')">
                                                            <i class="bi bi-x-circle me-1"></i> Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if($dataKarya->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center justify-content-center py-5">
                                                    <div class="bg-slate-50 text-slate-200 rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                                                        <i class="bi bi-patch-check fs-1"></i>
                                                    </div>
                                                    <h5 class="fw-bold text-slate-700 mb-1">Semua Bersih!</h5>
                                                    <p class="text-slate-400 mb-0">Tidak ada karya baru yang membutuhkan persetujuan saat ini.</p>
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
                            <span class="text-slate-500 small fw-medium">Menampilkan {{ $dataKarya->firstItem() }} hingga {{ $dataKarya->lastItem() }} dari {{ $dataKarya->total() }} karya</span>
                            <div class="d-flex justify-content-end mb-0">{{ $dataKarya->links('pagination::bootstrap-5') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmAction(formId, title, text, confirmText, color) {
            Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: color,
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, ' + confirmText,
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    container: 'swal2-soft-backdrop',
                    popup: 'rounded-4 border-0'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            })
        }
    </script>
    <style>
        .btn-emerald-soft {
            background-color: #ecfdf5;
        }
        .btn-emerald-soft:hover {
            background-color: #d1fae5;
        }
        .btn-danger-soft {
            background-color: #fef2f2;
        }
        .btn-danger-soft:hover {
            background-color: #fee2e2;
        }
        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @endpush
@endsection
