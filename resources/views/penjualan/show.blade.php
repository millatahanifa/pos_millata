@extends('layouts.app')

@section('title', 'Detail Penjualan - Bubu Bakery')

@section('content')
<div class="top-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
    <div>
        <h1 class="page-title fw-bold mb-1" style="color: var(--primary-dark, #3a1a05); font-size: 1.65rem;">Detail Penjualan</h1>
        <div class="date-subtitle text-muted fs-6">
            <i class="bi bi-info-circle me-1"></i> Informasi lengkap transaksi dan daftar item produk
        </div>
    </div>
    <div>
        <a href="{{ route('penjualan.index') }}" class="btn d-inline-flex align-items-center gap-2" style="background: #faf5ee; color: #78350f; border: 1px solid #f1e5d7; font-weight: 700; border-radius: 10px; padding: 0.5rem 1rem;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="custom-card p-3 p-md-4 bg-white rounded-4 shadow-sm mb-4" style="border: 1px solid #f1e5d7;">
    <h5 class="fw-bold mb-3" style="color: #78350f; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.5px;">Informasi Transaksi</h5>
    
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <tbody>
                <tr>
                    <td class="fw-bold text-muted" style="width: 200px; padding: 0.6rem 0; font-size: 0.875rem; white-space: nowrap;">Tanggal Transaksi</td>
                    <td style="width: 20px; padding: 0.6rem 0;">:</td>
                    <td class="fw-semibold text-dark" style="padding: 0.6rem 0; font-size: 0.875rem;">
                        {{ $penjualan->created_at ? $penjualan->created_at->translatedFormat('d-m-Y H:i:s') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted" style="padding: 0.6rem 0; font-size: 0.875rem; white-space: nowrap;">Kasir</td>
                    <td style="padding: 0.6rem 0;">:</td>
                    <td class="fw-semibold text-dark" style="padding: 0.6rem 0; font-size: 0.875rem;">
                        {{ $penjualan->user?->name ?? 'Kasir Tidak Ditemukan' }}
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted" style="padding: 0.6rem 0; font-size: 0.875rem; white-space: nowrap;">Metode Pembayaran</td>
                    <td style="padding: 0.6rem 0;">:</td>
                    <td class="fw-semibold text-dark" style="padding: 0.6rem 0; font-size: 0.875rem;">
                        {{ $penjualan->metode_pembayaran }}
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted" style="padding: 0.6rem 0; font-size: 0.875rem; white-space: nowrap;">Status</td>
                    <td style="padding: 0.6rem 0;">:</td>
                    <td style="padding: 0.6rem 0; font-size: 0.875rem;">
                        <span class="badge" style="background-color: #fef3c7; color: #b45309; font-weight: 700; padding: 0.35em 0.75em; border-radius: 8px; font-size: 0.75rem;">
                            {{ $penjualan->status === 'COMPLETED' ? 'SELESAI' : 'BELUM SELESAI' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted" style="padding: 0.6rem 0; font-size: 0.875rem; white-space: nowrap;">Total Pembayaran</td>
                    <td style="padding: 0.6rem 0;">:</td>
                    <td class="fw-bold text-dark" style="padding: 0.6rem 0; font-size: 0.95rem; color: #0284c7 !important;">
                        Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="custom-card p-3 p-md-4 bg-white rounded-4 shadow-sm" style="border: 1px solid #f1e5d7;">
    <h5 class="fw-bold mb-3" style="color: #78350f; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.5px;">Item Produk</h5>

    <div class="table-responsive">
        <table class="table align-middle" style="margin: 0; width: 100%;">
            <thead>
                <tr style="background-color: #faf5ee;">
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">No</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7;">Produk</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">Harga Satuan</th>
                    <th scope="col" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">Jumlah</th>
                    <th scope="col" class="text-end" style="color: #78350f; font-size: 0.775rem; font-weight: 800; text-transform: uppercase; padding: 0.8rem 0.75rem; border-bottom: 1px solid #f1e5d7; white-space: nowrap;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualan->itemPenjualan as $item)
                <tr>
                    <td class="fw-bold" style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">{{ $loop->iteration }}</td>
                    <td class="fw-semibold" style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6;" title="{{ $item->produk?->nama ?? 'Produk Dihapus' }}">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-3 overflow-hidden d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #f7efe7; border: 1px solid #f1e5d7; flex-shrink: 0;">
                                @if(!empty($item->produk?->foto))
                                    <img src="{{ asset('storage/' . $item->produk->foto) }}" alt="{{ $item->produk->nama ?? 'Produk' }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <span class="text-muted" style="font-size: 0.65rem;">Foto</span>
                                @endif
                            </div>
                            <span>{{ $item->produk?->nama ?? 'Produk Dihapus' }}</span>
                        </div>
                    </td>
                    <td style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">
                        Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                    </td>
                    <td style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">
                        <span class="badge" style="background-color: #fef3c7; color: #b45309; font-weight: 700; padding: 0.35em 0.75em; border-radius: 8px; font-size: 0.75rem;">
                            {{ $item->kuantitas }}
                        </span>
                    </td>
                    <td class="text-end fw-bold" style="padding: 0.85rem 0.75rem; font-size: 0.85rem; color: #3a1a05; border-bottom: 1px solid #FAF0E6; white-space: nowrap;">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-box-seam fs-3 d-block mb-2"></i>
                        Tidak ada item produk pada transaksi ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection