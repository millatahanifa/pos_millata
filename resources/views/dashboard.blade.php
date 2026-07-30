@extends('layouts.app')

@section('title', 'Dashboard - POS Millata')

@section('content')
<div class="container-fluid px-0">
    <div class="top-header d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h2 class="page-title fw-bold mb-1" style="color: var(--primary-dark); font-size: 1.65rem;">Ringkasan Hari Ini</h2>
            <div class="date-subtitle text-muted fs-6">
                <i class="bi bi-calendar3 me-1"></i>
                {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
            </div>
        </div>
        <div class="user-badge bg-white border rounded-pill px-3 py-2 shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-person-circle text-warning fs-5"></i>
            <span class="fw-bold" style="color: var(--primary-dark);">{{ ucfirst(Auth::user()->role->name ?? 'User') }} POS Millata</span>
        </div>
    </div>

    @can('view', App\Models\User::class)
        <div class="section-header fw-bold text-uppercase mb-3" style="font-size: 0.875rem; color: #92400e; letter-spacing: 0.05em;">
            <i class="bi bi-graph-up-arrow text-warning me-1"></i> Today's Sales
        </div>
        
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <div class="stat-card bg-white border rounded-4 p-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stat-label text-muted small fw-semibold mb-1">Total Penjualan Hari Ini</div>
                            <h3 class="stat-value fw-bold m-0" style="color: var(--primary-dark);">Rp {{ number_format($ringkasan['total_penjualan']) }}</h3>
                        </div>
                        <div class="stat-icon-wrapper bg-amber-soft p-3 rounded-3 fs-4" style="background-color: #fef3c7; color: #b45309;">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="stat-card bg-white border rounded-4 p-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stat-label text-muted small fw-semibold mb-1">Jumlah Transaksi</div>
                            <h3 class="stat-value fw-bold m-0" style="color: var(--primary-dark);">{{ number_format($ringkasan['total_transaksi']) }} Transaksi</h3>
                        </div>
                        <div class="stat-icon-wrapper p-3 rounded-3 fs-4" style="background-color: #ffe4e6; color: #e11d48;">
                            <i class="bi bi-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-header fw-bold text-uppercase mb-3" style="font-size: 0.875rem; color: #92400e; letter-spacing: 0.05em;">
            <i class="bi bi-wallet2 text-warning me-1"></i> Cash & Payment Status
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <div class="stat-card bg-white border rounded-4 p-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stat-label text-muted small fw-semibold mb-1">Pembayaran Tunai</div>
                            <h3 class="stat-value fw-bold m-0" style="color: var(--primary-dark);">Rp {{ number_format($ringkasan['total_cash']) }}</h3>
                        </div>
                        <div class="stat-icon-wrapper p-3 rounded-3 fs-4" style="background-color: #dcfce7; color: #15803d;">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="stat-card bg-white border rounded-4 p-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stat-label text-muted small fw-semibold mb-1">Pembayaran Non-Tunai</div>
                            <h3 class="stat-value fw-bold m-0" style="color: var(--primary-dark);">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h3>
                        </div>
                        <div class="stat-icon-wrapper p-3 rounded-3 fs-4" style="background-color: #e0f2fe; color: #0369a1;">
                            <i class="bi bi-qr-code-scan"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <div class="section-header fw-bold text-uppercase mb-3" style="font-size: 0.875rem; color: #92400e; letter-spacing: 0.05em;">
        <i class="bi bi-exclamation-triangle text-warning me-1"></i> Critical Inventory Status
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <div class="custom-table-card bg-white border rounded-4 p-4 shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-bold m-0 text-warning">
                        <i class="bi bi-box-seam me-1"></i> Stok Rendah
                    </h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
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
                                    <span class="badge bg-warning text-dark">{{ $produk->stok }} Pcs</span>
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
            <div class="custom-table-card bg-white border rounded-4 p-4 shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-bold m-0 text-danger">
                        <i class="bi bi-x-circle me-1"></i> Habis Stok
                    </h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
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
                                    <span class="badge bg-danger">Habis</span>
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

    <div class="section-header fw-bold text-uppercase mb-3" style="font-size: 0.875rem; color: #92400e; letter-spacing: 0.05em;">
        <i class="bi bi-star-fill text-warning me-1"></i> Best Seller Products
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="custom-table-card bg-white border rounded-4 p-4 shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Produk</th>
                                <th class="text-center">Sisa Stok</th>
                                <th class="text-end">Total Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkTerlaris as $index => $produk)
                            <tr>
                                <td class="fw-bold text-dark">
                                    <i class="bi bi-award-fill text-warning me-2"></i>{{ $produk->nama }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">{{ $produk->stok }} Pcs</span>
                                </td>
                                <td class="text-end fw-bold text-secondary">
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
</div>
@endsection