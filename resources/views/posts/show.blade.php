@extends('layouts.app')
@section('title', $karya->judul . ' - CoretanPublik')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="javascript:history.back()" class="btn btn-sm btn-light rounded-pill mb-4 px-3 text-slate-500 border-slate-200 shadow-sm hover:bg-slate-100 transition-colors">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            
            @if($karya->filepath)
            <div class="rounded-4 overflow-hidden mb-4 shadow-sm" style="max-height: 400px;">
                <img src="{{ asset('storage/'.$karya->filepath) }}" alt="Cover Image" class="w-100 h-100 object-fit-cover">
            </div>
            @endif

            <h1 class="fw-bolder text-slate-900 mb-3 tracking-tight" style="font-size: 2.8rem; line-height: 1.2;">{{ $karya->judul }}</h1>
            
            <div class="d-flex align-items-center gap-3 mb-5 pb-4 border-bottom border-slate-100">
                <div class="d-flex align-items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($karya->user->name ?? 'Penulis') }}&background=EEF2FF&color=4F46E5" class="rounded-circle shadow-sm" width="40" height="40">
                    <div>
                        <div class="fw-bold text-slate-700">{{ $karya->user->name ?? 'Anonim' }}</div>
                        <div class="text-slate-400 small">{{ \Carbon\Carbon::parse($karya->created_at)->format('d M Y') }}</div>
                    </div>
                </div>
            </div>

            <article class="text-slate-700" style="font-size: 1.15rem; line-height: 1.8; white-space: pre-wrap;">
{{ $karya->content }}
            </article>
        </div>
    </div>
</div>
@endsection
