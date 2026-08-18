@extends('layouts.app')

@section('title', 'Rekap Bulanan Penjualan - POS Millata')

@section('content')
<div class="top-header d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
    <div>
        <h1 class="page-title fw-bold mb-1" style="color: var(--primary-dark, #3a1a05); font-size: 1.65rem;">Rekapitulasi Penjualan</h1>
        <div class="date-subtitle text-muted fs-6">
            <i class="bi bi-file-earmark-bar-graph-fill me-1"></i> Analisis omzet bulanan dan tren transaksi harian toko
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; background: #ffffff; border: 1px solid #f1e5d7 !important;">
            <div class="card-body p-3 d-flex flex-column justify-content-between">
                <h6 class="fw-bold text-dark mb-2" style="font-size: 0.85rem; color: #3a1a05 !important;">
                    <i class="bi bi-funnel-fill text-warning me-1"></i> Filter Laporan
                </h6>
                <form action="{{ route('admin.penjualan.rekap') }}" method="GET" class="row g-2 align-items-end">
                    <div class="col-sm-5">
                        <label for="bulan" class="form-label text-secondary mb-1" style="font-size: 0.65rem; text-transform: uppercase; font-weight: 700;">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select form-select-sm bg-light shadow-none" style="border-radius: 8px; border-color: #f1e5d7; font-size: 0.8rem;">
                            @foreach([
                                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                            ] as $key => $namaBulan)
                                <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>{{ $namaBulan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="tahun" class="form-label text-secondary mb-1" style="font-size: 0.65rem; text-transform: uppercase; font-weight: 700;">Tahun</label>
                        <select name="tahun" id="tahun" class="form-select form-select-sm bg-light shadow-none" style="border-radius: 8px; border-color: #f1e5d7; font-size: 0.8rem;">
                            @for($t = date('Y'); $t >= date('Y') - 3; $t--)
                                <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-sm w-100 text-white fw-bold shadow-sm py-1.5 d-flex align-items-center justify-content-center gap-1" style="background: linear-gradient(135deg, #d97706 0%, #b45309 100%); border-radius: 8px; font-size: 0.8rem;">
                            <i class="bi bi-filter-circle-fill"></i> <span class="d-none d-sm-inline">Cari</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="row g-2 h-100">
            <div class="col-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border-left: 4px solid #d97706 !important;">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center h-100">
                        <div>
                            <span class="d-block text-uppercase fw-bold text-warning-emphasis mb-1" style="font-size: 0.65rem;">Total Pendapatan</span>
                            <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.15rem;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h5>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: rgba(217, 119, 6, 0.15); width: 42px; height: 42px;">
                            <i class="bi bi-wallet2 text-warning fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-left: 4px solid #22c55e !important;">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center h-100">
                        <div>
                            <span class="d-block text-uppercase fw-bold text-success-emphasis mb-1" style="font-size: 0.65rem;">Total Transaksi Berhasil</span>
                            <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.15rem;">{{ $totalTransaksi }} <span class="fw-normal text-muted" style="font-size: 0.8rem;">Transaksi</span></h5>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: rgba(34, 197, 94, 0.15); width: 42px; height: 42px;">
                            <i class="bi bi-cart-check-fill text-success fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: #ffffff; border: 1px solid #f1e5d7 !important;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem; color: #3a1a05 !important;">
                        <i class="bi bi-graph-up text-warning me-1"></i> Grafik Tren Pendapatan Harian
                    </h6>
                    <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.65rem;">Statistik Bulan Berjalan</span>
                </div>
                <div style="position: relative; height: 350px; width: 100%;">
                    <canvas id="grafikHarian"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikHarian').getContext('2d');
    
    const gradient = ctx.createLinearGradient(0, 0, 0, 350);
    gradient.addColorStop(0, 'rgba(217, 119, 6, 0.85)');
    gradient.addColorStop(1, 'rgba(245, 158, 11, 0.25)');

    const grafikHarian = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($grafikHari) !!},
            datasets: [{
                label: 'Omzet Harian (Rp)',
                data: {!! json_encode($grafikPendapatan) !!},
                backgroundColor: gradient,
                borderColor: '#b45309',
                borderWidth: 1.2,
                borderRadius: 6,
                barPercentage: 0.65
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10 } }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3e8dc' },
                    ticks: {
                        font: { size: 10 },
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endpush