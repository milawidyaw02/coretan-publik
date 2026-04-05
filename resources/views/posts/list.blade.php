@extends('layouts.app')
@section('title', 'Daftar Karya - CoretanPublik')

@section('content')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="row mb-5 align-items-center">
            <div class="col-md-8 mb-3 mb-md-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-indigo-100 text-indigo-600 rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-journal-text fs-4"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold text-slate-800 mb-0">Daftar Karya Anda</h2>
                        <p class="text-slate-500 mb-0">Kelola dan lihat semua tulisan yang pernah Anda buat.</p>
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

        <!-- Feedback Alerts -->
        @if(session('success'))
            <div
                class="alert alert-success rounded-3 mb-4 border-0 bg-green-50 text-green-700 d-flex align-items-center shadow-sm">
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
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase"
                                            style="width: 5%;">No</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase"
                                            style="width: 15%;">Thumbnail</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase"
                                            style="width: 35%;">Judul Karya</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase"
                                            style="width: 10%;">Status</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase"
                                            style="width: 15%;">Dibuat Pada</th>
                                        <th class="py-3 px-4 text-slate-500 fw-bold tracking-wide small text-uppercase text-center"
                                            style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Mockup Data 1 -->
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
                                                @if($dk->post_status === 'draft')
                                                    <span class="badge bg-slate-100 text-slate-600 border border-slate-200 rounded-pill px-3 py-2 shadow-sm d-inline-flex align-items-center gap-1">
                                                        <i class="bi bi-file-earmark-text"></i> Draft
                                                    </span>
                                                @elseif($dk->post_status === 'pending')
                                                    <span class="badge bg-amber-50 text-amber-600 border border-amber-200 rounded-pill px-3 py-2 shadow-sm d-inline-flex align-items-center gap-2">
                                                        <span class="spinner-grow spinner-grow-sm text-amber-500" style="width: 0.4rem; height: 0.4rem;" role="status"></span>
                                                        Direview
                                                    </span>
                                                @elseif($dk->post_status === 'published')
                                                    <span class="badge bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-pill px-3 py-2 shadow-sm d-inline-flex align-items-center gap-1">
                                                        <i class="bi bi-check2-circle fs-6"></i> Terpublikasi
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 text-slate-600 small">{{ $dk->created_at }}</td>
                                            <td class="py-3 px-4 text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('posts.show', $dk->id) }}"
                                                        class="btn btn-sm btn-light bg-indigo-50 text-indigo-600 hover:bg-indigo-100 border-0 rounded-3 d-flex align-items-center justify-content-center transition"
                                                        style="width: 36px; height: 36px;" title="Lihat">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    @if($dk->post_status === 'draft')
                                                        <a href="{{ route('posts.edit', $dk->id) }}"
                                                            class="btn btn-sm btn-light bg-yellow-50 text-yellow-600 hover:bg-yellow-100 border-0 rounded-3 d-flex align-items-center justify-content-center transition"
                                                            style="width: 36px; height: 36px;" title="Edit">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <!-- Tombol Ajukan (SweetAlert) -->
                                                        <form action="{{ route('posts.ajukan', $dk->id) }}" method="POST" class="d-inline m-0 p-0" id="form-ajukan-{{ $dk->id }}">
                                                            @csrf
                                                            <button type="button" onclick="confirmAjukan({{ $dk->id }})"
                                                                class="btn btn-sm btn-light bg-emerald-50 text-emerald-600 hover:bg-emerald-100 border-0 rounded-3 d-flex align-items-center gap-1 transition px-3"
                                                                style="height: 36px;" title="Ajukan untuk Review">
                                                                <i class="bi bi-send-check"></i>
                                                                <span class="fw-semibold">Ajukan</span>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if($dk->post_status === 'published')
                                                        <button type="button"
                                                            class="btn btn-sm btn-light bg-red-50 text-red-600 hover:bg-red-100 border-0 rounded-3 d-flex align-items-center justify-content-center transition"
                                                            style="width: 36px; height: 36px;" title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach



                                    @if($dataKarya->isEmpty())

                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                                    <i class="bi bi-journal-x text-slate-300 mb-3"
                                                        style="font-size: 3.5rem;"></i>
                                                    <h5 class="fw-bold text-slate-700 mb-1">Pena Kamu Masih Tertutup</h5>
                                                    <p class="text-slate-500 mb-4 px-3">Kamu belum pernah membuat tulisan
                                                        satupun. Ayo mulai tuangkan idemu sekarang!</p>
                                                    <a href="{{ route('posts.create') }}"
                                                        class="btn btn-outline-primary fw-bold text-indigo-600 border-indigo-600 hover:bg-indigo-600 hover:text-white rounded-pill px-4 transition">
                                                        <i class="bi bi-pencil-square me-1"></i> Mulai Menulis
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination Footer -->
                    @if($dataKarya->hasPages())
                        <div
                            class="card-footer bg-white border-top border-slate-100 p-4 pb-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <span class="text-slate-500 small fw-medium">
                                Menampilkan {{ $dataKarya->firstItem() }} hingga {{ $dataKarya->lastItem() }} dari
                                {{ $dataKarya->total() }} tulisan
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

@stack('scripts')
<script>
    function confirmAjukan(id) {
        Swal.fire({
            title: 'Ajukan Karya?',
            text: "Karya ini akan masuk antrian dan di-review oleh Admin. Selama masa review, tulisan tidak dapat di-edit.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10B981',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Ajukan!',
            cancelButtonText: 'Batal',
            backdrop: `rgba(15, 23, 42, 0.5)`
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-ajukan-' + id).submit();
            }
        });
    }
</script>