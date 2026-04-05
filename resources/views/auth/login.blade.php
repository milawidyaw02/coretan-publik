@extends('layouts.app')
@section('title', 'Masuk - CoretanPublik')

<!-- Menyembunyikan sidebar di halaman Auth -->
@section('hide-sidebar', true)

@section('content')
    <div class="row justify-content-center align-items-center relative position-relative overflow-hidden" style="min-height: 85vh;">
        <!-- Animated Background Orbs -->
        <div class="position-absolute top-0 start-50 translate-middle-x rounded-circle bg-gradient-to-br from-indigo-300 to-purple-300 opacity-30 blur-3xl mix-blend-multiply" 
             style="width: 400px; height: 400px; z-index: -1; animation: float 10s infinite ease-in-out alternate;"></div>
        <div class="position-absolute bottom-0 start-25 translate-middle rounded-circle bg-gradient-to-br from-pink-300 to-rose-300 opacity-30 blur-3xl mix-blend-multiply" 
             style="width: 350px; height: 350px; z-index: -1; animation: float 12s infinite ease-in-out alternate-reverse;"></div>

        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 relative z-10 py-5">
            <div class="card border-0 shadow-2xl p-4 p-sm-5 rounded-4 bg-white/90 backdrop-blur-xl border border-white/50">
                <div class="card-body p-0">
                    
                    @if(session('success'))
                        <div class="alert alert-success border-0 border-start border-4 border-success shadow-sm py-3 px-4 mb-4 d-flex align-items-center gap-3" role="alert" id="alert-scs">
                            <i class="bi bi-check-circle-fill fs-5 text-success"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <div class="text-center mb-5">
                        <div class="bg-gradient-to-tr from-indigo-600 to-purple-600 text-white rounded-4 d-inline-flex align-items-center justify-content-center shadow-lg mb-4 transform hover:scale-105 transition"
                            style="width: 64px; height: 64px;">
                            <span class="fs-1 fw-bold tracking-tight">C</span>
                        </div>
                        <h2 class="h3 fw-bolder text-slate-900 tracking-tight mb-2">Selamat Datang Kembali</h2>
                        <p class="text-slate-500 fs-6">Masuk untuk melanjutkan menulis dan berbagi cerita Anda.</p>
                    </div>

                    <form action="{{ route('logicLogin') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="username" class="form-label fw-semibold text-slate-700 small mb-1">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-slate-200 text-slate-400 py-3 rounded-start-3"><i class="bi bi-person"></i></span>
                                <input type="text"
                                    class="form-control bg-white border-slate-200 border-start-0 py-3 px-2 shadow-none rounded-end-3 focus:ring-2 focus:ring-indigo-100 transition"
                                    id="username" placeholder="Masukkan username" required name="username">
                            </div>
                        </div>
                        
                        <div class="mb-5">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label fw-semibold text-slate-700 small mb-0">Password</label>
                                <a href="{{ route('forgotPassword') }}"
                                    class="small text-indigo-600 text-decoration-none fw-semibold hover:text-indigo-800 transition">Lupa password?</a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-slate-200 text-slate-400 py-3 rounded-start-3"><i class="bi bi-lock"></i></span>
                                <input type="password"
                                    class="form-control bg-white border-slate-200 border-start-0 border-end-0 py-3 px-2 shadow-none focus:ring-2 focus:ring-indigo-100 transition"
                                    id="password" placeholder="••••••••" required name="password">
                                <button class="btn bg-white border border-slate-200 border-start-0 text-slate-400 rounded-end-3 hover:text-slate-600 toggle-password px-3"
                                    type="button" data-target="password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit"
                            class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm hover:shadow-lg transition transform hover:-translate-y-1 mb-4 d-flex justify-content-center align-items-center gap-2 group"
                            style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); border: none;">
                            Masuk ke Dashboard
                            <i class="bi bi-box-arrow-in-right transition-transform group-hover:translate-x-1"></i>
                        </button>
                    </form>

                    <div class="text-center mt-2 border-top border-slate-100 pt-4">
                        <span class="text-slate-500">Belum punya akun?</span>
                        <a href="{{ route('register') }}"
                            class="fw-bold text-indigo-600 text-decoration-none ms-1 hover:text-indigo-800 hover:underline transition">Daftar sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animation Keyframes defined inline for the orbs -->
    <style>
        @keyframes float {
            0% { transform: translateY(0px) scale(1); }
            100% { transform: translateY(30px) scale(1.05); }
        }
        
        /* Ensures body scroll if necessary on mobile */
        @media (max-width: 576px) {
            .card {
                margin: 0 10px;
            }
        }
    </style>
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

    setTimeout(function () {
        let alert = document.getElementById('alert-scs');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000); // 3000ms = 3 detik
</script>