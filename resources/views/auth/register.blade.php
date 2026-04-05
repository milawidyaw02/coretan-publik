@extends('layouts.app')
@section('title', 'Daftar - CoretanPublik')

<!-- Menyembunyikan sidebar di halaman Auth -->
@section('hide-sidebar', true)

@section('content')

    <div class="row justify-content-center align-items-center py-4" style="min-height: 85vh;">
        <div class="col-12 col-xl-10">
            <!-- Main Card Container -->
            <div class="card border-0 shadow-2xl rounded-4 overflow-hidden bg-white">
                <div class="row g-0">
                    
                    <!-- Left Side - Visual Banner (Hidden on Mobile, Visible on lg and up) -->
                    <div class="col-lg-5 d-none d-lg-flex bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 text-white p-5 flex-column position-relative overflow-hidden">
                        <!-- Decorative shapes -->
                        <div class="position-absolute top-0 start-0 translate-middle rounded-circle bg-white opacity-10 blur-2xl" style="width: 300px; height: 300px;"></div>
                        <div class="position-absolute bottom-0 end-0 translate-middle-x rounded-circle bg-white opacity-10 blur-2xl" style="width: 250px; height: 250px;"></div>
                        
                        <div class="position-relative z-10 mb-auto">
                            <div class="bg-white/20 backdrop-blur-md text-white rounded-4 d-inline-flex align-items-center justify-content-center shadow-lg mb-4 border border-white/20" style="width: 60px; height: 60px;">
                                <span class="fs-2 fw-bold">C</span>
                            </div>
                            <h2 class="display-6 fw-bold tracking-tight mb-3">Kembangkan Potensi Menulismu</h2>
                            <p class="fs-5 opacity-90 fw-light">Bergabunglah dengan ribuan kreator lain yang membagikan ide, cerita, dan inspirasi.</p>
                        </div>
                    </div>

                    <!-- Right Side - Registration Form -->
                    <div class="col-12 col-lg-7 p-4 p-md-5 position-relative">
                        <!-- Mobile only header -->
                        <div class="d-lg-none text-center mb-4 pt-2">
                            <div class="bg-gradient-to-tr from-indigo-600 to-purple-600 text-white rounded-4 d-inline-flex align-items-center justify-content-center shadow-sm mb-3" style="width: 56px; height: 56px;">
                                <span class="fs-2 fw-bold">C</span>
                            </div>
                            <h2 class="h3 fw-bolder text-slate-900 tracking-tight">Daftar Akun</h2>
                            <p class="text-slate-500 small">Mulai perjalanan menulismu bersama kami hari ini.</p>
                        </div>

                        <!-- Form Status Alert -->
                        @if(session('error'))
                            <div class="alert alert-danger border-0 border-start border-4 border-danger shadow-sm py-3 px-4 mb-4 d-flex align-items-center gap-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill fs-5 text-danger"></i>
                                <div>{{ session('error') }}</div>
                            </div>
                        @endif

                        <form action="{{ route('logicRegister') }}" method="POST" class="needs-validation">
                            @csrf
                            
                            <!-- Desktop only form title -->
                            <h3 class="d-none d-lg-block h4 fw-bolder text-slate-800 mb-4 pb-2">Buat Akun Baru</h3>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold text-slate-700 small mb-1">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-slate-50 border-slate-200 text-slate-400 py-2.5 rounded-start-3"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control bg-slate-50 border-slate-200 border-start-0 py-2.5 shadow-none focus:ring-2 focus:ring-indigo-100 transition rounded-end-3"
                                            id="name" placeholder="Budi Santoso" required name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="username" class="form-label fw-semibold text-slate-700 small mb-1">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-slate-50 border-slate-200 text-slate-400 py-2.5 rounded-start-3"><i class="bi bi-at"></i></span>
                                        <input type="text" class="form-control bg-slate-50 border-slate-200 border-start-0 py-2.5 shadow-none focus:ring-2 focus:ring-indigo-100 transition rounded-end-3"
                                            id="username" placeholder="budisantoso" required name="username" value="{{ old('username') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold text-slate-700 small mb-1">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-slate-50 border-slate-200 text-slate-400 py-2.5 rounded-start-3"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control bg-slate-50 border-slate-200 border-start-0 py-2.5 shadow-none focus:ring-2 focus:ring-indigo-100 transition rounded-end-3"
                                        id="email" placeholder="nama@email.com" required name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-semibold text-slate-700 small mb-1">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-slate-50 border-slate-200 text-slate-400 py-2.5 rounded-start-3"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control bg-slate-50 border-slate-200 border-start-0 border-end-0 py-2.5 shadow-none focus:ring-2 focus:ring-indigo-100 transition"
                                            id="password" placeholder="Min. 8 karakter" required name="password">
                                        <button class="btn bg-slate-50 border border-slate-200 border-start-0 text-slate-400 rounded-end-3 hover:text-slate-600 toggle-password px-3"
                                            type="button" data-target="password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="confirm-password" class="form-label fw-semibold text-slate-700 small mb-1">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-slate-50 border-slate-200 text-slate-400 py-2.5 rounded-start-3"><i class="bi bi-shield-check"></i></span>
                                        <input type="password" class="form-control bg-slate-50 border-slate-200 border-start-0 border-end-0 py-2.5 shadow-none focus:ring-2 focus:ring-indigo-100 transition"
                                            id="confirm-password" placeholder="Ulangi password" required name="konfirmasi_password">
                                        <button class="btn bg-slate-50 border border-slate-200 border-start-0 text-slate-400 rounded-end-3 hover:text-slate-600 toggle-password px-3"
                                            type="button" data-target="confirm-password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm hover:shadow-lg transition transform hover:-translate-y-1 mb-4 position-relative overflow-hidden group" style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); border: none;">
                                <span class="position-relative z-10 d-flex justify-content-center align-items-center gap-2">
                                    Daftar Akun Sekarang
                                    <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                                </span>
                            </button>

                            <div class="text-center text-slate-500 text-md">
                                Sudah memiliki akun? 
                                <a href="{{ route('login') }}" class="fw-bold text-indigo-600 text-decoration-none ms-1 hover:text-indigo-800 hover:underline transition">Masuk di sini</a>
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
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
    });
</script>