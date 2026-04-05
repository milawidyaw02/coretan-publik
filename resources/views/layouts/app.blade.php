<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CoretanPublik - Bagikan Karyamu')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS (Dimuat setelah Bootstrap agar utility Tailwind bisa override jika perlu) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc; 
        }
        
        /* Glassmorphism Effect */
        .glassmorphism {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
        }
        
        /* Layout CSS */
        .main-content { min-height: 80vh; transition: all 0.3s ease-in-out; }
        
        /* Sidebar Styling for Desktop */
        @media (min-width: 992px) {
            .sidebar-wrapper { 
                width: 280px; 
                position: fixed; 
                top: 76px; /* Height of navbar */
                bottom: 0; 
                left: 0; 
                z-index: 100; 
                border-right: 1px solid #e2e8f0; 
                background: #fff; 
                overflow-y: auto;
            }
            .content-wrapper { 
                margin-left: 280px; 
                padding-top: 76px; 
            }
            .content-wrapper.no-sidebar { 
                margin-left: 0; 
            }
        }
        
        /* Mobile padding adjustment */
        @media (max-width: 991.98px) {
            .content-wrapper { padding-top: 76px; }
        }
        
        /* Utilitas Custom Hover Card */
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important; 
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Fix Tailwind & Bootstrap Line Height Clash on text utilities */
        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
    </style>
</head>
<body class="text-slate-800 antialiased">

    <!-- Memanggil Navbar (Menggunakan Bootstrap Navbar kelas dicampur Tailwind) -->
    @include('partials.navbar')

    <!-- Memanggil Sidebar (Bootstrap Offcanvas) -->
    @if(!View::hasSection('hide-sidebar'))
        @yield('sidebar', View::make('partials.sidebar'))
    @endif

    <!-- Main Content Wrapper -->
    <main class="content-wrapper {{ View::hasSection('hide-sidebar') ? 'no-sidebar' : '' }}">
        <div class="container-fluid px-4 py-4 py-md-5 px-lg-5">
            
            <!-- Page Header (jika digunakan) -->
            @hasSection('header')
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                    <h1 class="h3 fw-bolder text-slate-900 mb-0 tracking-tight">@yield('header')</h1>
                    <div>@yield('header-actions')</div>
                </div>
            @endif
            
            <!-- Konten Utama Halaman -->
            <div class="main-content">
                @yield('content')
            </div>
            
            <!-- Footer -->
            <footer class="mt-5 pt-4 pb-3 text-center text-slate-500 small border-top border-slate-200">
                &copy; {{ date('Y') }} CoretanPublik. Dibangun dengan Bootstrap & TailwindCSS.
            </footer>
        </div>
    </main>

    <!-- Bootstrap 5 JS Bundle (Penting untuk Navbar Toggler, Dropdown, dan Sidebar Offcanvas!) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Script Kustom jika diperlukan -->
    @stack('scripts')
</body>
</html>
