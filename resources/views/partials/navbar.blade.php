<!-- partials/navbar.blade.php -->
<nav class="navbar navbar-expand-lg fixed-top glassmorphism shadow-sm py-2 px-3">
    <div class="container-fluid">
        <!-- Toggler for Mobile Sidebar (Offcanvas Bootstrap) -->
        @if(!View::hasSection('hide-sidebar'))
            <button class="btn btn-light d-lg-none me-2 border-0 bg-slate-100 hover:bg-slate-200 transition" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                <i class="bi bi-list fs-4 text-slate-700"></i>
            </button>
        @endif

        <!-- Brand / Logo -->
        <a class="navbar-brand d-flex align-items-center fw-bold fs-4 tracking-tight" href="{{ url('/') }}">
            <div class="bg-indigo-600 text-white rounded-3 d-flex align-items-center justify-content-center me-2 shadow-sm"
                style="width: 38px; height: 38px;">
                C
            </div>
            <span class="text-slate-900">Coretan<span class="text-indigo-600">Publik</span></span>
        </a>

        <!-- Right Side Nav (Always visible icons & auth) -->
        <div class="d-flex align-items-center ms-auto gap-2 gap-sm-3">
            @auth
                <!-- Notification Bell -->
                <button type="button"
                    class="btn btn-link link-secondary p-2 position-relative text-decoration-none text-slate-500 hover:bg-slate-100 rounded-circle transition">
                    <i class="bi bi-bell fs-5"></i>
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle shadow-sm mt-1 ms-n1">
                        <span class="visually-hidden">Notifikasi Baru</span>
                    </span>
                </button>

                <!-- User Dropdown Profile (Bootstrap) -->
                <div class="dropdown">
                    <a href="#"
                        class="d-flex align-items-center text-decoration-none dropdown-toggle rounded-pill bg-slate-100 p-1 border-2 border-white shadow-sm transition hover:shadow-md"
                        id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'User' }}&background=4F46E5&color=fff&bold=true"
                            alt="User Profile" width="34" height="34" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-2 rounded-4 animate__animated animate__fadeIn animate__faster"
                        aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item py-2 fw-medium text-slate-700 hover:bg-slate-50 transition" href="#"><i
                                    class="bi bi-person me-2 text-slate-400"></i> Profil Saya</a></li>
                        <li><a class="dropdown-item py-2 fw-medium text-slate-700 hover:bg-slate-50 transition"
                                href="{{ route('dashboard') }}"><i class="bi bi-grid me-2 text-slate-400"></i> Dashboard</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-2">
                        </li>
                        <li><a class="dropdown-item py-2 fw-medium text-danger hover:bg-red-50 transition"
                                href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Keluar</a></li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>