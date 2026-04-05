@extends('layouts.app')
@section('title', 'Dashboard Penulis - CoretanPublik')
@section('header', 'Overview Dashboard')

@section('content')
    <!-- Statistik Cards (Bootstrap Grid + Tailwind Styling) -->
    <div class="row g-4 mb-5">

        <!-- Stat 1 -->
         <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 card-hover h-100 p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-slate-500 fw-medium mb-1 small uppercase tracking-wider">Total Draft</h6>
                        <h2 class="fw-bolder text-indigo-600 mb-0 tracking-tight" style="font-size: 2.5rem;">{{ $totalDraft }}</h2>
                    </div>
                    <div
                        class="bg-indigo-50 text-indigo-600 rounded-4 d-flex align-items-center justify-content-center p-3 transition-transform duration-300 hover:scale-110">
                        <i class="bi bi-file-earmark-text fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat 2 -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 card-hover h-100 p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-slate-500 fw-medium mb-1 small uppercase tracking-wider">Menunggu Review</h6>
                        <h2 class="fw-bolder text-amber-500 mb-0 tracking-tight" style="font-size: 2.5rem;">{{ $totalOutstanding }}</h2>
                    </div>
                    <div
                        class="bg-amber-50 text-amber-500 rounded-4 d-flex align-items-center justify-content-center p-3 transition-transform duration-300 hover:scale-110">
                        <i class="bi bi-hourglass-split fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat 3 -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 card-hover h-100 p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-slate-500 fw-medium mb-1 small uppercase tracking-wider">Total Terpublikasi</h6>
                        <h2 class="fw-bolder text-slate-800 mb-0 tracking-tight" style="font-size: 2.5rem;">{{ $totalPublikasi }}</h2>
                    </div>
                    <div
                        class="bg-emerald-50 text-emerald-600 rounded-4 d-flex align-items-center justify-content-center p-3 transition-transform duration-300 hover:scale-110">
                        <i class="bi bi-check-circle-fill fs-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom border-slate-200 pb-3 mt-4">
        <h4 class="fw-bold text-slate-800 m-0 tracking-tight">Riwayat Tulisan Anda</h4>
        <a href="{{ route('posts.list') }}" class="text-decoration-none fw-medium text-indigo-600 hover:text-indigo-800 transition">Lihat Semua <i
                class="bi bi-arrow-right ms-1"></i></a>
    </div>

    <div class="card border-0 border-slate-100 shadow-sm rounded-4 overflow-hidden mb-5 bg-white">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0 text-slate-600">
                <thead class="bg-slate-50 text-slate-500 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    <tr>
                        <th scope="col" class="py-3 px-4 border-0 fw-bold text-slate-500 uppercase tracking-wide text-xs">Judul Karya</th>
                        <th scope="col" class="py-3 border-0 fw-bold text-slate-500 uppercase tracking-wide text-xs">Kategori</th>
                        <th scope="col" class="py-3 border-0 fw-bold text-slate-500 uppercase tracking-wide text-xs">Status</th>
                        <th scope="col" class="py-3 border-0 fw-bold text-slate-500 uppercase tracking-wide text-xs">Terakhir Update</th>
                        <th scope="col" class="py-3 text-center border-0 fw-bold text-slate-500 uppercase tracking-wide text-xs">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($listCurrent5 as $karya)
                        <tr class="group hover:bg-slate-50 transition-colors">
                            <td class="py-3 px-4 fw-semibold text-slate-900 w-25">{{ $karya->judul }}</td>
                            <td class="py-3 text-slate-500">-</td>
                            <td class="py-3">
                                @if($karya->post_status === 'draft')
                                    <span class="badge bg-slate-100 text-slate-600 border border-slate-200 rounded-pill px-3 py-2 shadow-sm d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-file-earmark-text"></i> Draft
                                    </span>
                                @elseif($karya->post_status === 'pending')
                                    <span class="badge bg-amber-50 text-amber-600 border border-amber-200 rounded-pill px-3 py-2 shadow-sm d-inline-flex align-items-center gap-2">
                                        <span class="spinner-grow spinner-grow-sm text-amber-500" style="width: 0.4rem; height: 0.4rem;" role="status"></span>
                                        Direview
                                    </span>
                                @elseif($karya->post_status === 'published')
                                    <span class="badge bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-pill px-3 py-2 shadow-sm d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-check2-circle fs-6"></i> Terpublikasi
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 text-slate-500 small">{{ \Carbon\Carbon::parse($karya->updated_at)->diffForHumans() }}</td>
                            <td class="py-3 text-center">
                                <div class="d-flex align-items-center justify-content-center gap-2 transition-opacity">
                                    <!-- Selalu tampilkan tombol Detail untuk di Show -->
                                    <a href="{{ route('posts.show', $karya->id) }}" class="btn btn-sm fw-semibold rounded-pill px-3 d-inline-flex align-items-center gap-1 transition-colors" 
                                       style="background-color: #EEF2FF; color: #4F46E5; border: 1px solid #C7D2FE;" title="Lihat detail halaman"
                                       onmouseover="this.style.backgroundColor='#4F46E5'; this.style.color='white';"
                                       onmouseout="this.style.backgroundColor='#EEF2FF'; this.style.color='#4F46E5';">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    
                                    <!-- Tombol Edit / Lanjut Tulis jika masih draft -->
                                    @if($karya->post_status === 'draft')
                                        <a href="{{ route('posts.edit', $karya->id) }}" class="btn btn-sm fw-semibold rounded-pill px-3 shadow-sm d-inline-flex align-items-center gap-1 transition-all"
                                           style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white; border: none;"
                                           onmouseover="this.style.transform='translateY(-2px)';"
                                           onmouseout="this.style.transform='translateY(0)';">
                                            <i class="bi bi-pencil-square"></i> Lanjut Tulis
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-5 text-center text-slate-500">
                                <i class="bi bi-journal-x fs-2 d-block mb-2 text-slate-300"></i>
                                Belum ada karya apapun. Mulai menulislah sekarang!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tokopedia Style Status Tracking Tracker -->
    @php
        $latestTrackable = \App\Models\PostModel::where('id_user', Auth::id())
            ->whereIn('post_status', ['pending'])
            ->latest('updated_at')
            ->first();
            
        if(!$latestTrackable) {
            $latestTrackable = \App\Models\PostModel::where('id_user', Auth::id())->latest('updated_at')->first();
        }
    @endphp

    @if($latestTrackable)
        <div class="mt-5 mb-5 px-md-3">
            <h5 class="fw-bold text-slate-800 m-0 mb-3 tracking-tight d-flex align-items-center">
                <i class="bi bi-geo-alt-fill text-indigo-500 me-2"></i> Lacak Status Karya Terkini
            </h5>
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                <div class="d-flex flex-column flex-md-row align-items-md-center mb-4 pb-3 border-bottom border-slate-100 gap-3">
                    <img src="{{ asset('storage/' . $latestTrackable->filepath) }}" 
                         class="rounded-3 shadow-sm object-fit-cover" 
                         style="width: 80px; height: 60px;" 
                         onerror="this.style.display='none'">
                    <div>
                        <div class="badge bg-indigo-50 text-indigo-600 rounded-pill px-2 py-1 mb-1" style="font-size: 0.65rem;">
                            ID-{{ strtoupper(substr(md5($latestTrackable->id), 0, 8)) }}
                        </div>
                        <h6 class="fw-bold text-slate-800 mb-1 leading-tight">{{ $latestTrackable->judul }}</h6>
                        <p class="text-slate-500 small mb-0">Update terakhir: {{ \Carbon\Carbon::parse($latestTrackable->updated_at)->diffForHumans() }}</p>
                    </div>
                </div>
                
                <div class="mt-4 pt-4 mb-2">
                    <div class="row align-items-start position-relative m-0">
                        <!-- Horizontal Background Line -->
                        <div class="position-absolute bg-slate-200 rounded-pill" style="left: 16.66%; width: 66.66%; top: 20px; height: 4px; z-index: 0;"></div>
                        
                        @php
                            $bgDraft = 'bg-emerald-500'; $textDraft = 'text-slate-800 fw-bold';
                            $bgReview = 'bg-white border border-slate-200'; $textReview = 'text-slate-400';
                            $bgPublik = 'bg-white border border-slate-200'; $textPublik = 'text-slate-400';
                            $progressWidth = '0%';
                            $lineColorClass = 'bg-slate-200';
                            
                            if($latestTrackable->post_status === 'pending') {
                                $bgDraft = 'bg-emerald-500'; 
                                $bgReview = 'bg-amber-500 border-amber-500'; 
                                $textReview = 'text-amber-600 fw-bold';
                                $progressWidth = '33.33%';
                                $lineColorClass = 'bg-amber-500 shadow-sm';
                            } elseif($latestTrackable->post_status === 'published') {
                                $bgDraft = 'bg-emerald-500';
                                $bgReview = 'bg-emerald-500 border-emerald-500'; 
                                $textReview = 'text-emerald-700';
                                $bgPublik = 'bg-emerald-500 border-emerald-500'; 
                                $textPublik = 'text-emerald-600 fw-bold';
                                $progressWidth = '66.66%';
                                $lineColorClass = 'bg-emerald-500 shadow-sm';
                            }
                        @endphp
                        
                        <!-- Active Loading Line -->
                        <div class="position-absolute {{ $lineColorClass }} rounded-pill transition-all duration-1000" style="left: 16.66%; top: 20px; height: 4px; z-index: 1; width: {{ $progressWidth }};"></div>

                        <!-- Node 1: Draft -->
                        <div class="col-4 text-center position-relative px-1 px-md-3" style="z-index: 10;">
                            <div class="{{ $bgDraft }} text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm transition-all" style="width: 44px; height: 44px; border: 4px solid white; {{ $bgDraft=='bg-emerald-500' ? 'box-shadow: 0 0 0 4px #10B98120 !important;' : '' }}">
                                <i class="bi bi-pencil" style="font-size: 1.2rem;"></i>
                            </div>
                            <!-- Desktop/Tablet Text Card -->
                            <div class="d-none d-md-block p-3 rounded-4 border transition-all hover:shadow-md {{ $latestTrackable->post_status === 'draft' ? 'border-indigo-200 bg-indigo-50 shadow-sm' : 'border-slate-100 bg-white' }}">
                                <h6 class="mb-1 {{ $latestTrackable->post_status === 'draft' ? 'text-indigo-600 fw-bolder' : $textDraft }} text-sm text-truncate">Tulisan Disimpan</h6>
                                <p class="text-slate-500 small mb-0 text-truncate-2" style="font-size: 0.75rem;">Eksekusi naskah dirampungkan.</p>
                                <div class="text-slate-400 mt-2 fw-medium" style="font-size: 0.70rem;">{{ \Carbon\Carbon::parse($latestTrackable->created_at)->format('d M, H:i') }}</div>
                            </div>
                            <!-- Mobile Small Text -->
                            <div class="d-md-none mt-2 bg-white rounded-3 p-1">
                                <h6 class="mb-0 {{ $latestTrackable->post_status === 'draft' ? 'text-indigo-600 fw-bolder' : $textDraft }}" style="font-size: 0.70rem; line-height: 1.1;">Tulisan<br>Disimpan</h6>
                            </div>
                        </div>

                        <!-- Node 2: Review -->
                        <div class="col-4 text-center position-relative px-1 px-md-3" style="z-index: 10;">
                            <div class="{{ $bgReview }} text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm transition-all duration-500" style="width: 44px; height: 44px; border: 4px solid white; {{ $bgReview=='bg-amber-500 border-amber-500' ? 'box-shadow: 0 0 0 4px #F59E0B30 !important;' : ($bgReview=='bg-emerald-500 border-emerald-500' ? 'box-shadow: 0 0 0 4px #10B98120 !important;' : '') }}">
                                @if($latestTrackable->post_status === 'published')
                                    <i class="bi bi-check-lg" style="font-size: 1.2rem;"></i>
                                @elseif($latestTrackable->post_status === 'pending')
                                    <span class="spinner-grow bg-white" style="width: 12px; height: 12px;"></span>
                                @else
                                    <i class="bi bi-hourglass-split" style="font-size: 1.2rem; color: #cbd5e1;"></i>
                                @endif
                            </div>
                            <div class="d-none d-md-block p-3 rounded-4 border transition-all hover:shadow-md {{ $latestTrackable->post_status === 'pending' ? 'border-amber-200 bg-amber-50 shadow-sm' : 'border-slate-100 bg-white' }}">
                                <h6 class="mb-1 {{ $textReview }} text-sm text-truncate">Review Editor</h6>
                                <p class="text-slate-500 small mb-0 text-truncate-2" style="font-size: 0.75rem;">Sedang diperiksa kelayakannya.</p>
                                @if($latestTrackable->post_status === 'pending' || $latestTrackable->post_status === 'published')
                                    <div class="text-slate-400 mt-2 fw-medium" style="font-size: 0.70rem;">{{ \Carbon\Carbon::parse($latestTrackable->updated_at)->format('d M, H:i') }}</div>
                                @else
                                   <div class="text-slate-300 mt-2 fw-medium" style="font-size: 0.70rem;">- - - -</div>
                                @endif
                            </div>
                            <div class="d-md-none mt-2 bg-white rounded-3 p-1">
                                <h6 class="mb-0 {{ $textReview }}" style="font-size: 0.70rem; line-height: 1.1;">Review<br>Editor</h6>
                            </div>
                        </div>

                        <!-- Node 3: Publikasi -->
                        <div class="col-4 text-center position-relative px-1 px-md-3" style="z-index: 10;">
                            <div class="{{ $bgPublik }} text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm transition-all duration-500" style="width: 44px; height: 44px; border: 4px solid white; {{ $bgPublik=='bg-emerald-500 border-emerald-500' ? 'box-shadow: 0 0 0 4px #10B98130 !important;' : '' }}">
                                @if($latestTrackable->post_status === 'published')
                                    <i class="bi bi-globe" style="font-size: 1.2rem;"></i>
                                @else
                                    <i class="bi bi-globe" style="font-size: 1.2rem; color: #cbd5e1;"></i>
                                @endif
                            </div>
                            <div class="d-none d-md-block p-3 rounded-4 border transition-all hover:shadow-md {{ $latestTrackable->post_status === 'published' ? 'border-emerald-200 bg-emerald-50 shadow-sm' : 'border-slate-100 bg-white' }}">
                                <h6 class="mb-1 {{ $textPublik }} text-sm text-truncate">Karya Terpublikasi</h6>
                                <p class="text-slate-500 small mb-0 text-truncate-2" style="font-size: 0.75rem;">Selesai! Tulisan Anda kini tayang dan bisa dibaca siapapun.</p>
                                @if($latestTrackable->post_status === 'published')
                                    <div class="text-slate-400 mt-2 fw-medium" style="font-size: 0.70rem;">{{ \Carbon\Carbon::parse($latestTrackable->updated_at)->format('d M Y, H:i') }}</div>
                                @else
                                   <div class="text-slate-300 mt-2 fw-medium" style="font-size: 0.70rem;">Est. 1-2 Hari Aktual</div>
                                @endif
                            </div>
                             <div class="d-md-none mt-2">
                                <h6 class="mb-0 {{ $textPublik }}" style="font-size: 0.70rem; line-height: 1.1;">Karya<br>Terpublikasi</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection