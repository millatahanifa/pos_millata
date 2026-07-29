<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - POS Millata</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        /* Top Bar Header */
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

        .date-subtitle {
            color: #8c715f;
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 0.25rem;
        }

        .user-badge {
            background: #ffffff;
            border: 1px solid var(--card-border);
            padding: 0.55rem 1.1rem;
            border-radius: 30px;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--primary-dark);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        /* Section Headings */
        .section-header {
            font-size: 0.875rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #92400e;
            margin-top: 1.75rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Stats Card Styling */
        .stat-card {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 1.35rem 1.5rem;
            box-shadow: var(--card-shadow);
            transition: all 0.25s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 28px -5px rgba(120, 53, 15, 0.08);
            border-color: #fcd34d;
        }

        .stat-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #78350f;
            margin-bottom: 0.4rem;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .stat-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        /* Custom Icon Colors */
        .bg-amber-soft { background-color: #fef3c7; color: #b45309; }
        .bg-rose-soft { background-color: #ffe4e6; color: #e11d48; }
        .bg-emerald-soft { background-color: #dcfce7; color: #15803d; }
        .bg-sky-soft { background-color: #e0f2fe; color: #0369a1; }

        /* Tables Styling */
        .custom-table-card {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 1.35rem;
            box-shadow: var(--card-shadow);
            height: 100%;
        }

        .table-custom {
            margin: 0;
        }

        .table-custom thead th {
            background-color: #faf5ee;
            color: var(--primary-accent);
            font-size: 0.775rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            border-bottom: 1px solid var(--card-border);
            padding: 0.8rem 1rem;
        }

        .table-custom tbody td {
            padding: 0.9rem 1rem;
            font-size: 0.875rem;
            color: var(--primary-dark);
            vertical-align: middle;
            border-bottom: 1px solid #FAF0E6;
        }

        .badge-status {
            padding: 0.35em 0.75em;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 8px;
        }

        .badge-warning-soft { background: #fef3c7; color: #b45309; }
        .badge-danger-soft { background: #ffe4e6; color: #e11d48; }
        .badge-success-soft { background: #dcfce7; color: #15803d; }

        @media (max-width: 991px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 1.25rem;
            }
            .app-layout { flex-direction: column; }
        }
    </style>
</head>
<body>

<div class="app-layout">

    <aside class="sidebar">
        <div>
            <div class="sidebar-brand">
                <div class="brand-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <h1 class="brand-text">POS Millata</h1>
            </div>

            <nav class="sidebar-menu">
                <a href="/dashboard" class="nav-link-custom {{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/produk" class="nav-link-custom {{ Request::is('produk*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Produk</span>
                </a>
                <a href="/penjualan" class="nav-link-custom {{ Request::is('penjualan*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i>
                    <span>Penjualan</span>
                </a>
                @can('view', App\Models\User::class)
                <a href="{{ route('admin.users') }}" class="nav-link-custom {{ Request::is('admin/users*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Users</span>
                </a>
                @endcan
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

    <main class="main-content">
        
        <div class="top-header">
            <div>
                <h2 class="page-title">Ringkasan Hari Ini</h2>
                <div class="date-subtitle">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
                </div>
            </div>
            <div class="user-badge">
                <i class="bi bi-person-circle text-warning fs-5"></i>
                <span>{{ ucfirst(Auth::user()->role->name ?? 'User') }} POS Millata</span>
            </div>
        </div>

        @can('view', App\Models\User::class)
            <div class="section-header">
                <i class="bi bi-graph-up-arrow text-warning"></i> Today's Sales
            </div>
            
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-label">Total Penjualan Hari Ini</div>
                                <h3 class="stat-value">Rp {{ number_format($ringkasan['total_penjualan']) }}</h3>
                            </div>
                            <div class="stat-icon-wrapper bg-amber-soft">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-label">Jumlah Transaksi</div>
                                <h3 class="stat-value">{{ number_format($ringkasan['total_transaksi']) }} Transaksi</h3>
                            </div>
                            <div class="stat-icon-wrapper bg-rose-soft">
                                <i class="bi bi-receipt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-header">
                <i class="bi bi-wallet2 text-warning"></i> Cash & Payment Status
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-label">Pembayaran Tunai</div>
                                <h3 class="stat-value">Rp {{ number_format($ringkasan['total_cash']) }}</h3>
                            </div>
                            <div class="stat-icon-wrapper bg-emerald-soft">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-label">Pembayaran Non-Tunai</div>
                                <h3 class="stat-value">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h3>
                            </div>
                            <div class="stat-icon-wrapper bg-sky-soft">
                                <i class="bi bi-qr-code-scan"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        <div class="section-header">
            <i class="bi bi-exclamation-triangle text-warning"></i> Critical Inventory Status
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-lg-6">
                <div class="custom-table-card">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bold m-0" style="color: var(--primary-accent);">
                            <i class="bi bi-box-seam me-1 text-warning"></i> Stok Rendah
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th class="text-end">Sisa Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokRendah as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                    <td class="fw-semibold">{{ $produk->nama }}</td>
                                    <td class="text-end">
                                        <span class="badge badge-status badge-warning-soft">{{ $produk->stok }} Pcs</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-4">
                                        <i class="bi bi-check-circle text-success fs-5 d-block mb-1"></i>
                                        Seluruh produk berada dalam kondisi stok aman.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(method_exists($produkStokRendah, 'links'))
                        <div class="mt-3">{{ $produkStokRendah->links() }}</div>
                    @endif
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="custom-table-card">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bold m-0" style="color: #e11d48;">
                            <i class="bi bi-x-circle me-1"></i> Habis Stok
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th class="text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokHabis as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                    <td class="fw-semibold">{{ $produk->nama }}</td>
                                    <td class="text-end">
                                        <span class="badge badge-status badge-danger-soft">Habis</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-4">
                                        <i class="bi bi-check-circle text-success fs-5 d-block mb-1"></i>
                                        Tidak ada produk yang habis.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(method_exists($produkStokHabis, 'links'))
                        <div class="mt-3">{{ $produkStokHabis->links() }}</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="section-header">
            <i class="bi bi-star-fill text-warning"></i> Best Seller Products
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="custom-table-card">
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th class="text-center">Sisa Stok</th>
                                    <th class="text-end">Total Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkTerlaris as $index => $produk)
                                <tr>
                                    <td class="fw-bold" style="color: var(--primary-dark);">
                                        <i class="bi bi-award-fill text-warning me-2"></i>{{ $produk->nama }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-status badge-success-soft">{{ $produk->stok }} Pcs</span>
                                    </td>
                                    <td class="text-end fw-bold" style="color: var(--primary-accent);">
                                        {{ number_format($produk->total_terjual) }} Pcs
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-4">
                                        Belum ada transaksi terlaris hari ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>