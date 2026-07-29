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
            --sidebar-bg: #ffffff;
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

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR STYLING --- */
        .sidebar {
            width: 260px;
            min-width: 260px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--card-border);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.5rem 1.25rem;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid #f3e8d8;
            margin-bottom: 1.5rem;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #5c2406 0%, var(--primary-dark) 100%);
            color: #fef3c7;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: 0 4px 12px rgba(92, 36, 6, 0.2);
        }

        .brand-text {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            flex-grow: 1;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1rem;
            color: var(--primary-accent);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .nav-link-custom:hover {
            background-color: #fff7ed;
            color: var(--brand-warm);
            transform: translateX(3px);
        }

        .nav-link-custom.active {
            background: linear-gradient(135deg, #5c2406 0%, var(--primary-dark) 100%);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(60, 26, 5, 0.2);
        }

        .btn-logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.65rem 1rem;
            background-color: #fff1f2;
            color: #e11d48;
            border: 1px solid #fecdd3;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 700;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: #ffe4e6;
            color: #be123c;
        }

        /* --- MAIN CONTENT AREA --- */
        .main-content {
            margin-left: 260px;
            flex-grow: 1;
            padding: 2.25rem 2.5rem;
            width: calc(100% - 260px);
        }

        .main-content.full-width {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 0 !important;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid #f0e4d4;
        }

        .page-title {
            font-size: 1.65rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin: 0;
            letter-spacing: -0.03em;
        }

        .custom-card {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
        }

        @media (max-width: 991px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .main-content { margin-left: 0; width: 100%; padding: 1.25rem; }
            .app-layout { flex-direction: column; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="app-layout">
    @unless (request()->routeIs('login'))
        <aside class="sidebar">
            <div>
                <div class="sidebar-brand">
                    <div class="brand-icon">
                        <i class="bi bi-shop"></i>
                    </div>
                    <h1 class="brand-text">POS Millata</h1>
                </div>

                <nav class="sidebar-menu">
                    <a href="{{ route('dashboard') }}" class="nav-link-custom {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('produk.index') }}" class="nav-link-custom {{ Request::is('produk*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill"></i>
                        <span>Produk</span>
                    </a>
                    <a href="{{ route('penjualan.index') }}" class="nav-link-custom {{ Request::is('penjualan*') ? 'active' : '' }}">
                        <i class="bi bi-receipt"></i>
                        <span>Penjualan</span>
                    </a>

                    {{-- Menu Users hanya tampil jika yang login adalah admin --}}
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users') }}" class="nav-link-custom {{ Request::is('admin/users*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Users</span>
                    </a>
                    @endif
                </nav>
            </div>

            <div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>
    @endunless

    <main class="main-content {{ request()->routeIs('login') ? 'full-width' : '' }}">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>