@extends('layouts.app')
@section('title', 'Admin Panel - CoretanPublik')
@section('header', 'Dashboard Utama Administrator')

@section('content')
    <!-- Admin Statistik Cards -->
    <div class="row g-4 mb-5">

        <!-- Stat 1: Total Users -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 card-hover h-100 p-4 bg-gradient-to-br from-blue-50 to-white">
                <div class="d-flex flex-column h-100 justify-content-between">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-blue-100 text-blue-600 rounded-3 p-2 shadow-sm">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <span class="badge bg-blue-100 text-blue-700 rounded-pill">
                            @if($status == 'up')
                                <i class="bi bi-arrow-up-right"> {{ $growth }} %</i>
                            @elseif($status == 'down')
                                <i class="bi bi-arrow-down-right"> {{ $growth }} %</i>
                            @else
                                <i class="bi bi-arrow-right">Stable</i>
                            @endif
                        </span>
                    </div>
                    <div>
                        <h2 class="fw-bolder text-slate-800 mb-0 tracking-tight" style="font-size: 2.2rem;">
                            {{ $totalUsers }}
                        </h2>
                        <h6 class="text-slate-500 fw-medium mt-1 mb-0 small uppercase tracking-wider">Total Pengguna Aktif
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat 2: Post In Review -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 card-hover h-100 p-4 bg-gradient-to-br from-rose-50 to-white">
                <div class="d-flex flex-column h-100 justify-content-between">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-rose-100 text-rose-600 rounded-3 p-2 shadow-sm position-relative">
                            <i class="bi bi-file-earmark-check-fill fs-4"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </div>
                    </div>
                    <div>
                        <h2 class="fw-bolder text-rose-600 mb-0 tracking-tight" style="font-size: 2.2rem;">{{ $needReview }}</h2>
                        <h6 class="text-slate-500 fw-medium mt-1 mb-0 small uppercase tracking-wider">Menunggu Persetujuan
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat 3: Total Karya / Post -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 card-hover h-100 p-4 bg-gradient-to-br from-emerald-50 to-white">
                <div class="d-flex flex-column h-100 justify-content-between">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-emerald-100 text-emerald-600 rounded-3 p-2 shadow-sm">
                            <i class="bi bi-journal-text fs-4"></i>
                        </div>
                        <span class="badge bg-emerald-100 text-emerald-700 rounded-pill">+43 Baru</span>
                    </div>
                    <div>
                        <h2 class="fw-bolder text-slate-800 mb-0 tracking-tight" style="font-size: 2.2rem;">{{ $countPublished }}</h2>
                        <h6 class="text-slate-500 fw-medium mt-1 mb-0 small uppercase tracking-wider">Total Tulisan Terbit
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Tabel Antrian Artikel -->
        <div class="col-12 col-lg-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold text-slate-800 m-0 tracking-tight">Antrian Persetujuan Artikel</h5>
                <a href="#"
                    class="text-decoration-none fw-medium text-indigo-600 hover:text-indigo-800 transition small">Lihat
                    Semua <i class="bi bi-arrow-right ms-1"></i></a>
            </div>

            <div class="card border-0 border-slate-100 shadow-sm rounded-4 overflow-hidden bg-white h-100">
                <div class="table-responsive h-100 d-flex flex-column">
                    <table class="table table-hover align-middle m-0 text-slate-600 border-bottom-0">
                        <thead class="bg-slate-50 text-slate-500 text-uppercase"
                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            <tr>
                                <th scope="col" class="py-3 px-4 border-0 fw-bold">Penulis</th>
                                <th scope="col" class="py-3 border-0 fw-bold">Judul Postingan</th>
                                <th scope="col" class="py-3 border-0 fw-bold">Waktu Submit</th>
                                <th scope="col" class="py-3 text-center border-0 fw-bold">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0 flex-grow-1">
                            <!-- Baris 1 -->
                            <tr class="group hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-indigo-100 text-indigo-700 rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                            style="width: 32px; height: 32px; font-size: 0.8rem;">AR</div>
                                        <div>
                                            <div class="fw-semibold text-slate-900 small">Ahmad Ridho</div>
                                            <div class="text-slate-400" style="font-size: 0.7rem;">@aridho99</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 fw-medium text-slate-800" style="max-width: 200px;">
                                    <div class="text-truncate">Senja di Pelabuhan Ratu: Sebuah Memori</div>
                                    <span class="badge bg-slate-100 text-slate-500 fw-normal">Cerpen</span>
                                </td>
                                <td class="py-3 text-slate-500 small">2 jam yang lalu</td>
                                <td class="py-3 text-center">
                                    <button class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm"
                                        style="font-size:0.8rem;">Review</button>
                                </td>
                            </tr>

                            <!-- Baris 2 -->
                            <tr class="group hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-rose-100 text-rose-700 rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                            style="width: 32px; height: 32px; font-size: 0.8rem;">SN</div>
                                        <div>
                                            <div class="fw-semibold text-slate-900 small">Sarah Novita</div>
                                            <div class="text-slate-400" style="font-size: 0.7rem;">@sarah_writes</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 fw-medium text-slate-800" style="max-width: 200px;">
                                    <div class="text-truncate">Framework UI Modern Tahun 2026</div>
                                    <span class="badge bg-slate-100 text-slate-500 fw-normal">Artikel / Esai</span>
                                </td>
                                <td class="py-3 text-slate-500 small">5 jam yang lalu</td>
                                <td class="py-3 text-center">
                                    <button class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm"
                                        style="font-size:0.8rem;">Review</button>
                                </td>
                            </tr>

                            <!-- Baris 3 -->
                            <tr class="group hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-emerald-100 text-emerald-700 rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                            style="width: 32px; height: 32px; font-size: 0.8rem;">BZ</div>
                                        <div>
                                            <div class="fw-semibold text-slate-900 small">Bagas Zeta</div>
                                            <div class="text-slate-400" style="font-size: 0.7rem;">@bagaskuy</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 fw-medium text-slate-800" style="max-width: 200px;">
                                    <div class="text-truncate">Malam Tak Berbintang</div>
                                    <span class="badge bg-slate-100 text-slate-500 fw-normal">Puisi</span>
                                </td>
                                <td class="py-3 text-slate-500 small">1 Hari yang lalu</td>
                                <td class="py-3 text-center">
                                    <button class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm"
                                        style="font-size:0.8rem;">Review</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection