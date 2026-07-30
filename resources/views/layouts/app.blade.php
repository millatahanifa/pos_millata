<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS Millata')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --bg-body: #fdfbf7;
            --navbar-bg: #ffffff;
            --primary-dark: #3a1a05;
            --primary-accent: #78350f;
            --brand-warm: #d97706;
            --card-border: #f1e5d7;
            --card-shadow: 0 8px 20px -4px rgba(120, 53, 15, 0.05);
        }

        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-body) !important;
            color: var(--primary-dark);
            margin: 0;
            padding: 0;
        }

        /* --- NAVBAR ATAS STYLING --- */
        .navbar-custom {
            background: var(--navbar-bg);
            border-bottom: 1px solid var(--card-border);
            padding: 0.6rem 2rem;
            box-shadow: 0 4px 12px rgba(120, 53, 15, 0.02);
        }

        .brand-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #5c2406 0%, var(--primary-dark) 100%);
            color: #fef3c7;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            box-shadow: 0 4px 10px rgba(92, 36, 6, 0.2);
        }

        .brand-text {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin: 0;
            letter-spacing: -0.02em;
        }

        /* Mengatur ukuran tombol menu agar pendek dan rapi secara inline */
        .nav-link-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.85rem;
            color: var(--primary-accent);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            width: auto !important; /* Memastikan tidak memanjang penuh */
        }

        .nav-link-custom:hover {
            background-color: #fff7ed;
            color: var(--brand-warm);
        }

        .nav-link-custom.active {
            background: linear-gradient(135deg, #5c2406 0%, var(--primary-dark) 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(60, 26, 5, 0.2);
        }

        /* Tombol Keluar yang ringkas */
        .btn-logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.4rem 0.85rem;
            background-color: #fff1f2;
            color: #e11d48;
            border: 1px solid #fecdd3;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            transition: all 0.2s ease;
            cursor: pointer;
            width: auto;
        }

        .btn-logout:hover {
            background-color: #ffe4e6;
            color: #be123c;
        }

        /* --- MAIN CONTENT AREA --- */
        .main-content {
            padding: 2rem 2.5rem;
            width: 100%;
        }

        @media (max-width: 991px) {
            .main-content { padding: 1.25rem; }
            .nav-link-custom, .btn-logout { width: 100% !important; justify-content: flex-start; }
        }
    </style>
    @stack('styles')
</head>
<body>

@unless (request()->routeIs('login'))
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container-fluid px-0">
            <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center gap-2 m-0 text-decoration-none">
                <div class="brand-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <h1 class="brand-text">POS Millata</h1>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between mt-2 mt-lg-0" id="navbarNav">
                <ul class="navbar-nav align-lg-items-center gap-1 mx-lg-auto">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link-custom {{ Request::is('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('produk.index') }}" class="nav-link-custom {{ Request::is('produk*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam-fill"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penjualan.index') }}" class="nav-link-custom {{ Request::is('penjualan*') ? 'active' : '' }}">
                            <i class="bi bi-receipt"></i>
                            <span>Penjualan</span>
                        </a>
                    </li>

                    {{-- Menu Users HANYA MUNCUL untuk Admin --}}
                    @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role?->name === 'admin'))
                    <li class="nav-item">
                        <a href="{{ route('admin.users') }}" class="nav-link-custom {{ Request::is('admin/users*') ? 'active' : '' }}">
                            <i class="bi bi-people-fill"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    @endif
                </ul>

                <div class="d-flex align-items-center mt-2 mt-lg-0">
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
@endunless

<main class="main-content">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>