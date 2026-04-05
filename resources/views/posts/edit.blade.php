@extends('layouts.app')
@section('title', 'Edit Karya - CoretanPublik')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                @if(session('error'))
                    <div class="alert alert-danger rounded-3 mb-4 border-0 bg-red-50 text-red-700 d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                        {{ session('error') }}
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success rounded-3 mb-4 border-0 bg-green-50 text-green-700 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white/90 backdrop-blur">
                    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-md-5">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="bg-indigo-100 text-indigo-600 rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="bi bi-pencil-square fs-4"></i>
                            </div>
                            <div>
                                <h2 class="fw-bold text-slate-800 mb-0">Edit Karya</h2>
                                <p class="text-slate-500 mb-0">Perbarui, simpan, dan sempurnakan tulisanmu.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-md-5 pt-4">
                        <form action="{{ route('posts.update', $karya->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Thumbnail/Cover Image -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-slate-700 tracking-wide small text-uppercase">Cover
                                    Image (Opsional)</label>
                                <div class="border-2 border-dashed border-slate-300 rounded-4 p-5 text-center transition duration-200 cursor-pointer relative"
                                    id="drop-zone"
                                    style="min-height: 200px; display: flex; flex-direction: column; justify-content: center; align-items: center; {{ $karya->filepath ? 'background-image: url('.asset('storage/'.$karya->filepath).'); background-size: cover; background-position: center;' : 'background-color: #F8FAFC;' }}">
                                    <div id="dz-content" style="{{ $karya->filepath ? 'opacity: 0;' : '' }}">
                                        <div class="bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center mx-auto mb-3"
                                            style="width: 64px; height: 64px;">
                                            <i class="bi bi-image text-slate-400 fs-3"></i>
                                        </div>
                                        <span class="fw-medium text-slate-700 d-block mb-1">Klik untuk mengubah gambar</span>
                                        <span class="text-slate-500 small d-block">SVG, PNG, JPG atau GIF (Maks. 2MB)</span>
                                    </div>
                                    <input type="file" name="thumbnail" id="thumbnail"
                                        class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer"
                                        accept="image/*">
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="mb-4">
                                <label for="title"
                                    class="form-label fw-bold text-slate-700 tracking-wide small text-uppercase">Judul Karya
                                    <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control form-control-lg bg-slate-50 border-slate-200 shadow-none rounded-3 py-3 px-4 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition"
                                    id="title" name="title" value="{{ old('title', $karya->judul) }}" placeholder="Masukkan judul yang menarik..." required>
                            </div>

                            <!-- Content Editor -->
                            <div class="mb-5">
                                <label for="content"
                                    class="form-label fw-bold text-slate-700 tracking-wide small text-uppercase">Isi Tulisan
                                    <span class="text-danger">*</span></label>

                                <!-- Simple Toolbar Mockup -->
                                <div
                                    class="bg-slate-100 border border-bottom-0 border-slate-200 rounded-top-4 p-2 px-3 d-flex flex-wrap gap-1 text-slate-600 align-items-center">
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-white border-0 shadow-sm rounded-2 hover:bg-slate-50"
                                        title="Bold"><i class="bi bi-type-bold"></i></button>
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-transparent border-0 hover:bg-slate-200 rounded-2"
                                        title="Italic"><i class="bi bi-type-italic"></i></button>
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-transparent border-0 hover:bg-slate-200 rounded-2"
                                        title="Underline"><i class="bi bi-type-underline"></i></button>
                                    <div class="vr mx-2 bg-slate-300"></div>
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-transparent border-0 hover:bg-slate-200 rounded-2"
                                        title="Format Header"><i class="bi bi-type-h1"></i></button>
                                    <div class="vr mx-2 bg-slate-300"></div>
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-transparent border-0 hover:bg-slate-200 rounded-2"
                                        title="Align Left"><i class="bi bi-text-left"></i></button>
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-transparent border-0 hover:bg-slate-200 rounded-2"
                                        title="Align Center"><i class="bi bi-text-center"></i></button>
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-transparent border-0 hover:bg-slate-200 rounded-2"
                                        title="Align Right"><i class="bi bi-text-right"></i></button>
                                    <div class="vr mx-2 bg-slate-300"></div>
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-transparent border-0 hover:bg-slate-200 rounded-2"
                                        title="Bulleted List"><i class="bi bi-list-ul"></i></button>
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-transparent border-0 hover:bg-slate-200 rounded-2"
                                        title="Numbered List"><i class="bi bi-list-ol"></i></button>
                                    <div class="vr mx-2 bg-slate-300"></div>
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-transparent border-0 hover:bg-slate-200 rounded-2"
                                        title="Insert Link"><i class="bi bi-link-45deg"></i></button>
                                    <button type="button"
                                        class="btn btn-sm btn-light bg-transparent border-0 hover:bg-slate-200 rounded-2"
                                        title="Insert Quote"><i class="bi bi-chat-quote"></i></button>
                                </div>
                                <textarea
                                    class="form-control bg-slate-50 border-slate-200 shadow-none rounded-0 rounded-bottom-4 p-4 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition"
                                    id="content" name="content_karya" rows="18"
                                    placeholder="Lanjutkan kisahmu..." required
                                    style="resize: vertical; font-size: 1.05rem; line-height: 1.7;">{{ old('content_karya', $karya->content) }}</textarea>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top border-slate-100">
                                <div class="d-flex gap-3">
                                    <a href="{{ route('dashboard') }}"
                                        class="btn btn-light fw-bold px-4 py-2 rounded-pill text-slate-700 bg-slate-100 hover:bg-slate-200 border-0 transition">Batal</a>
                                    <button type="submit"
                                        class="btn btn-primary fw-bold px-5 py-2 rounded-pill d-flex align-items-center gap-2 shadow hover:shadow-lg transition transform hover:-translate-y-1"
                                        style="background-color: #4F46E5; border-color: #4F46E5;">
                                        Simpan Perubahan
                                        <i class="bi bi-save ms-1"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@stack('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropZone = document.getElementById('drop-zone');
        const dzContent = document.getElementById('dz-content');
        const fileInput = document.getElementById('thumbnail');

        fileInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    dropZone.style.backgroundImage = `url('${e.target.result}')`;
                    dropZone.style.backgroundSize = 'cover';
                    dropZone.style.backgroundPosition = 'center';

                    if(dzContent) {
                        dzContent.style.opacity = '0';
                    }
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
