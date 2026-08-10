@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

<div class="row g-4">
<div class="col-md-6">
    <div class="custom-card p-4" style="height: 75vh; display: flex; flex-direction: column; background: #fffaf5; border: 1px solid #f1e5d7; border-radius: 14px; box-shadow: 0 6px 18px rgba(58, 26, 5, 0.04);">
        <h5 class="fw-bold mb-3" style="color: var(--primary-dark, #3a1a05);">Daftar Produk</h5>
        
        <div class="mb-3">
            <form method="GET" action="">
                <div class="input-group">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control rounded-3 ps-3 py-2"
                        placeholder="Cari produk..."
                        style="border-color: #f1e5d7; background-color: #ffffff; font-size: 0.9rem;"
                        onkeyup="this.form.submit()">
                </div>
            </form>
        </div>

        <div class="table-responsive pe-2" style="overflow-y: auto; flex-grow: 1;">
            @foreach($products as $product)
            <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 mb-2 align-items-center p-2 rounded-3 bg-white" style="border: 1px solid #f1e5d7; box-shadow: 0 3px 10px rgba(58, 26, 5, 0.03);">
                @csrf
                <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="col-6 d-flex align-items-center gap-2">
                    <div class="rounded-3 overflow-hidden d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: #f7efe7; border: 1px solid #f1e5d7; flex-shrink: 0;">
                        @if(!empty($product->foto))
                            <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <span class="text-muted" style="font-size: 0.65rem;">Foto</span>
                        @endif
                    </div>
                    <div>
                        <div class="fw-semibold text-dark text-truncate" style="font-size: 0.9rem;">{{ $product->nama }}</div>
                        <small class="text-muted" style="font-size: 0.75rem;">
                            Rp {{ number_format($product->harga_jual, 0, ',', '.') }} | Stok: {{ $product->stok }}
                        </small>
                    </div>
                </div>

                <div class="col-3">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stok }}"
                        class="form-control form-control-sm text-center {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}"
                        style="border-radius: 8px; border-color: #f1e5d7;">
                </div>

                <div class="col-3">
                    <button type="submit" class="btn btn-sm text-white w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}" 
                        style="background: #3a1a05; border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                        Tambah
                    </button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="custom-card p-4" style="height: 75vh; display: flex; flex-direction: column; background: #fffaf5; border: 1px solid #f1e5d7; border-radius: 14px; box-shadow: 0 6px 18px rgba(58, 26, 5, 0.04);">
        <h5 class="fw-bold mb-3" style="color: var(--primary-dark, #3a1a05);">Keranjang Belanja</h5>

        <div class="table-responsive flex-grow-1 mb-3" style="overflow-y: auto;">
            <table class="table align-middle table-hover mb-0" style="font-size: 0.9rem;">
                <thead class="table-light text-uppercase fs-7 text-secondary">
                    <tr>
                        <th class="py-2">Produk</th>
                        <th class="py-2">Harga</th>
                        <th class="py-2" style="width: 70px;">Jumlah</th>
                        <th class="py-2">Subtotal</th>
                        <th class="py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sale->itemPenjualan as $item)
                    <tr>
                        <td class="fw-semibold">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-3 overflow-hidden d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: #f7efe7; border: 1px solid #f1e5d7; flex-shrink: 0;">
                                    @if(!empty($item->produk->foto))
                                        <img src="{{ asset('storage/' . $item->produk->foto) }}" alt="{{ $item->produk->nama ?? '-' }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <span class="text-muted" style="font-size: 0.65rem;">Foto</span>
                                    @endif
                                </div>
                                <span>{{ $item->produk->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td>
                            <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                @csrf @method('PUT')
                                <input type="number" name="quantity"
                                    value="{{ $item->kuantitas }}"
                                    min="1"
                                    class="form-control form-control-sm text-center"
                                    style="border-radius: 6px; border-color: #f1e5d7;"
                                    onchange="this.form.submit()">
                            </form>
                        </td>
                        <td class="fw-bold text-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm py-0 px-2" style="border-radius: 6px; font-size: 0.75rem;">Hapus</button>
                            </form>
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

        <div class="pt-3 border-top mt-auto" style="border-color: #f1e5d7 !important;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="fw-bold text-muted">Total Pembayaran:</span>
                <span class="fs-4 fw-bold" style="color: #78350f;">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span>
            </div>

            <form id="checkout-form-{{ $sale->id }}" method="POST" action="{{ route('penjualan.update', $sale->id) }}">
                @csrf
                @method('PUT')

                <select name="payment_method" class="form-select mb-3" style="border-radius: 10px; border-color: #f1e5d7; background-color: #ffffff;" required>
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="CASH" {{ $sale->metode_pembayaran == 'CASH' ? 'selected' : '' }}>Tunai (Cash)</option>
                    <option value="QRIS" {{ $sale->metode_pembayaran == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                </select>

                <button type="submit" class="btn text-white w-100 py-2 shadow-sm {{ $sale->status == 'COMPLETED' ? 'disabled' : '' }}" 
                    style="background: #10b981; border-radius: 10px; font-weight: 700;">
                    Selesaikan Transaksi (Checkout)
                </button>
            </form>

            <form id="cancel-sale-form-{{ $sale->id }}" action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="mt-2">
                @csrf
                @method('DELETE')

                <button type="button" onclick="confirmCancelSale({{ $sale->id }})" class="btn btn-outline-danger w-100 py-2 {{ $sale->status == 'COMPLETED' ? 'disabled' : '' }}" 
                    style="border-radius: 10px; font-weight: 600; font-size: 0.85rem;">
                    Batalkan Transaksi
                </button>
            </form>
        </div>
    </div>
</div>
</div>