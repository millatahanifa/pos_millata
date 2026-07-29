@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4">
{{-- ==================== KOLOM KIRI: PRODUK ==================== --}}
<div class="col-md-6">
    <div class="custom-card p-4" style="height: 75vh; display: flex; flex-direction: column;">
        <h5 class="fw-bold mb-3" style="color: var(--primary-dark, #3a1a05);">Daftar Produk</h5>
        
        <div class="mb-3">
            <form method="GET" action="">
                <div class="input-group">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control rounded-pill ps-3 py-2"
                        placeholder="Cari produk..."
                        style="border-color: #f1e5d7; background-color: #fdfbf7; font-size: 0.9rem;"
                        onkeyup="this.form.submit()">
                </div>
            </form>
        </div>

        <div class="table-responsive pe-2" style="overflow-y: auto; flex-grow: 1;">
            @foreach($products as $product)
            <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 mb-2 align-items-center p-2 rounded-3 border bg-white shadow-sm" style="border-color: #f8efe5 !important;">
                @csrf
                <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="col-6">
                    <div class="fw-semibold text-dark text-truncate" style="font-size: 0.9rem;">{{ $product->nama }}</div>
                    <small class="text-muted" style="font-size: 0.75rem;">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</small>
                </div>

                <div class="col-3">
                    <input type="number" name="quantity" value="1" min="1"
                        class="form-control form-control-sm text-center {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}"
                        style="border-radius: 8px; border-color: #f1e5d7;">
                </div>

                <div class="col-3">
                    <button type="submit" class="btn btn-sm text-white w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}" 
                        style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>

{{-- ==================== KOLOM KANAN: KERANJANG ==================== --}}
<div class="col-md-6">
    <div class="custom-card p-4" style="height: 75vh; display: flex; flex-direction: column;">
        <h5 class="fw-bold mb-3" style="color: var(--primary-dark, #3a1a05);">Keranjang Belanja</h5>

        <div class="table-responsive flex-grow-1 mb-3" style="overflow-y: auto;">
            <table class="table align-middle table-hover mb-0" style="font-size: 0.9rem;">
                <thead class="table-light text-uppercase fs-7 text-secondary">
                    <tr>
                        <th class="py-2">Produk</th>
                        <th class="py-2">Harga</th>
                        <th class="py-2" style="width: 70px;">Qty</th>
                        <th class="py-2">Subtotal</th>
                        <th class="py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sale->itemPenjualan as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->produk->nama }}</td>
                        <td>Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                        <td>
                            <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                @csrf @method('PUT')
                                <input type="number" name="quantity"
                                    value="{{ $item->kuantitas }}"
                                    class="form-control form-control-sm text-center"
                                    style="border-radius: 6px;"
                                    onchange="this.form.submit()">
                            </form>
                        </td>
                        <td class="fw-bold text-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @can('delete', $item)
                            <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm py-0 px-2" style="border-radius: 6px; font-size: 0.75rem;">Hapus</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Keranjang masih kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer Total & Aksi Checkout --}}
        <div class="pt-3 border-top mt-auto" style="border-color: #faf0e6 !important;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="fw-bold text-muted">Total Pembayaran:</span>
                <span class="fs-4 fw-bold" style="color: #78350f;">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span>
            </div>

            <form method="POST"
                action="{{ route('penjualan.update', $sale->id) }}"
                onsubmit="return confirm('Yakin ingin checkout?')">
                @csrf
                @method('PUT')

                <select name="payment_method" class="form-select mb-3" style="border-radius: 10px; border-color: #f1e5d7; background-color: #fdfbf7;" required>
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="CASH" {{ $sale->metode_pembayaran == 'CASH' ? 'selected' : '' }}>Cash</option>
                    <option value="QRIS" {{ $sale->metode_pembayaran == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                </select>

                <button class="btn text-white w-100 py-2 shadow-sm {{ $sale->status == 'COMPLETED' ? 'disabled' : '' }}" 
                    style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 10px; font-weight: 700;">
                    <i class="bi bi-check-circle-fill me-1"></i> Selesaikan Transaksi (Checkout)
                </button>
            </form>

            @can('delete',$sale)
            <form action="{{ route('penjualan.destroy', $sale->id) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin membatalkan transaksi?')" class="mt-2">
                @csrf
                @method('DELETE')

                <button class="btn btn-outline-danger w-100 py-2 {{ $sale->status == 'COMPLETED' ? 'disabled' : '' }}" 
                    style="border-radius: 10px; font-weight: 600; font-size: 0.85rem;">
                    Batalkan Transaksi
                </button>
            </form>
            @endcan
        </div>
    </div>
</div>
</div>