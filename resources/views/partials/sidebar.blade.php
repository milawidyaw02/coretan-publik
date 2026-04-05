<!-- partials/sidebar.blade.php -->
<!-- Offcanvas wrapper: Fixed Sidebar di Desktop, Offcanvas Drawer di Mobile -->
<div class="offcanvas-lg offcanvas-start sidebar-wrapper shadow-sm" tabindex="-1" id="sidebarOffcanvas"
    aria-labelledby="sidebarOffcanvasLabel">

    <!-- Header Sidebar (Hanya terlihat di Mobile) -->
    <div class="offcanvas-header border-bottom d-lg-none bg-slate-50">
        <div class="d-flex align-items-center fw-bold fs-5 tracking-tight text-slate-900">
            <div class="bg-indigo-600 text-white rounded d-flex align-items-center justify-content-center me-2"
                style="width: 30px; height: 30px;">C</div>
            Menu Navigasi
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarOffcanvas"
            aria-label="Close"></button>
    </div>

    <!-- Body Sidebar -->
    <div class="offcanvas-body d-flex flex-column h-100 p-3 bg-white">
        <ul class="nav nav-pills flex-column mb-auto gap-1">
            @auth
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link d-flex align-items-center rounded-3 transition py-2 px-3 {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-700 hover:bg-slate-50' }}">
                        <i
                            class="bi bi-house-door me-3 fs-5 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                        <span class="fw-medium">Dashboard</span>
                    </a>
                </li>
                @if(Auth::check() && Auth::user()->role === 'user')
                    <li class="mt-4 mb-2 px-3">
                        <span class="text-xs fw-bolder text-slate-400 text-uppercase tracking-widest"
                            style="letter-spacing: 1px;">Karya Saya</span>
                    </li>

                    <li>
                        <a href="{{ route('posts.list') }}"
                            class="nav-link d-flex align-items-center rounded-3 fw-semibold border border-indigo-100 py-2 px-3 transition hover:bg-indigo-100 {{ request()->routeIs('posts.list') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-700' }}">
                            <i
                                class="bi bi-pen me-3 fs-5 {{ request()->routeIs('posts.list') ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                            Buat Tulisan Baru
                        </a>
                    </li>

                    @php
                        $pendingCount = \App\Models\PostModel::where('id_user', Auth::id())->where('post_status', 'pending')->count();
                    @endphp
                    <li>
                        <a href="{{ route('posts.review') }}"
                            class="nav-link text-slate-700 d-flex align-items-center rounded-3 hover:bg-amber-50 hover:text-amber-700 transition mt-1 py-2 px-3 {{ request()->routeIs('posts.review') ? 'bg-amber-50 text-amber-700 fw-bold' : '' }}">
                            <i class="bi bi-hourglass-split me-3 fs-5 {{ request()->routeIs('posts.review') ? 'text-amber-600' : 'text-slate-400' }}"></i>
                            <span class="fw-medium flex-grow-1">Menunggu Review</span>
                            @if($pendingCount > 0)
                                <span class="badge bg-warning text-dark rounded-pill ms-2 shadow-sm">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('posts.published') }}"
                            class="nav-link text-slate-700 d-flex align-items-center rounded-3 hover:bg-emerald-50 hover:text-emerald-700 transition mt-1 py-2 px-3 {{ request()->routeIs('posts.published') ? 'bg-emerald-50 text-emerald-700 fw-bold' : '' }}">
                            <i class="bi bi-check-circle me-3 fs-5 {{ request()->routeIs('posts.published') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span class="fw-medium">Terpublikasi</span>
                        </a>
                    </li>

                    <!-- Hak Akses Admin -->
                @else
                    <li class="mt-4 mb-2 px-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger rounded-circle me-2" style="width: 6px; height: 6px;"></div>
                            <span class="text-xs fw-bolder text-slate-400 text-uppercase tracking-widest"
                                style="letter-spacing: 1px;">Panel Admin</span>
                        </div>
                    </li>

                    @php
                        $adminPendingCount = \App\Models\PostModel::where('post_status', 'pending')->count();
                    @endphp

                    <li>
                        <a href="{{ route('admin.approval.index') }}"
                            class="nav-link d-flex align-items-center rounded-3 transition py-2 px-3 {{ request()->routeIs('admin.*') ? 'bg-danger-subtle text-danger fw-bold' : 'text-slate-700 hover:bg-danger-subtle hover:text-danger' }}">
                            <i class="bi bi-clipboard-check me-3 fs-5 {{ request()->routeIs('admin.*') ? 'text-danger' : 'text-slate-400' }}"></i>
                            <span class="fw-medium flex-grow-1">Persetujuan Tulisan</span>
                            @if($adminPendingCount > 0)
                                <span class="badge bg-danger rounded-pill shadow-sm">{{ $adminPendingCount }} Baru</span>
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="#"
                            class="nav-link text-slate-700 d-flex align-items-center rounded-3 hover:bg-slate-100 transition mt-1 py-2 px-3">
                            <i class="bi bi-people me-3 fs-5 text-slate-400"></i>
                            <span class="fw-medium">Manajemen User</span>
                        </a>
                    </li>
                @endif
            @endauth
        </ul>

        <!-- Info Penulis Aktif di Bawah -->
        @auth
            <hr class="text-slate-200 mt-auto mb-3">
            <div
                class="d-flex align-items-center p-3 rounded-4 bg-slate-50 border border-slate-100 shadow-sm transition hover:shadow-md">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'User' }}&background=4F46E5&color=fff&bold=true"
                    alt="" width="45" height="45" class="rounded-circle me-3 border border-2 border-white shadow-sm">
                <div class="overflow-hidden">
                    <strong
                        class="d-block text-slate-900 text-truncate text-sm tracking-tight">{{ Auth::user()->name ?? 'Penulis Hebat' }}</strong>
                    <span
                        class="text-slate-500 text-xs text-truncate d-block fw-medium">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Penulis Aktif' }}</span>
                </div>
            </div>
        @endauth

    </div>
</div>