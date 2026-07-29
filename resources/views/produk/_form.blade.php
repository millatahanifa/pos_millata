{{-- Bagian Foto (Tampil di atas secara rapi & simetris) --}}
<div class="row mb-4 pb-3 border-bottom align-items-center" style="border-color: #f1e5d7 !important;">
    @if (!empty($product->foto))
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <label class="form-label fw-bold small text-muted d-block mb-2">
                <i class="bi bi-image me-1"></i> Foto Produk Saat Ini
            </label>
            <div class="d-inline-block p-1 rounded-4 shadow-sm bg-white" style="border: 1px solid #f1e5d7;">
                <img src="{{ asset('storage/' . $product->foto) }}"
                    class="rounded-4"
                    style="width: 110px; height: 110px; object-fit: cover;">
            </div>
        </div>
    @endif

    <div class="{{ !empty($product->foto) ? 'col-md-6' : 'col-md-12' }}">
        <label class="form-label fw-semibold" style="color: var(--primary-dark); font-size: 0.875rem;">
            <i class="bi bi-upload me-1 text-warning"></i> Upload / Ganti Foto
        </label>
        <div class="input-group">
            <input type="file"
                name="foto"
                onchange="previewImage(this)"
                class="form-control @error('foto') is-invalid @enderror"
                style="border-color: #f1e5d7; padding: 0.6rem 1rem; border-radius: 12px; background-color: #fdfbf7; font-size: 0.85rem;">
        </div>
        @error('foto')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
        
        {{-- Preview kecil jika foto baru dipilih --}}
        <div id="preview-container" class="mt-2" style="display: none;">
            <span class="small text-muted d-block mb-1">Preview Foto Baru:</span>
            <img id="preview" class="rounded-3 shadow-sm" style="width: 80px; height: 80px; object-fit: cover; border: 1px solid #f1e5d7;">
        </div>
    </div>
</div>

{{-- Bagian Form Teks ke Bawah Secara Rapi --}}
<div class="mb-3">
    <label class="form-label fw-semibold" style="color: var(--primary-dark); font-size: 0.875rem;">
        <i class="bi bi-box-seam me-1 text-warning"></i> Nama Produk
    </label>
    <input type="text" name="nama"
        class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $product->nama ?? '') }}"
        placeholder="Contoh: Roti Manis Cokelat"
        style="border-color: #f1e5d7; padding: 0.65rem 1rem; border-radius: 12px; background-color: #fdfbf7;">
    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold" style="color: var(--primary-dark); font-size: 0.875rem;">
            <i class="bi bi-tag me-1 text-warning"></i> Harga Beli
        </label>
        <div class="input-group">
            <span class="input-group-text" style="background-color: #faf5ee; border-color: #f1e5d7; border-radius: 12px 0 0 12px; color: var(--primary-dark); font-weight: 600; font-size: 0.85rem;">Rp</span>
            <input type="number" name="harga_beli"
                class="form-control @error('harga_beli') is-invalid @enderror"
                value="{{ old('harga_beli', $product->harga_beli ?? '') }}"
                placeholder="15000"
                style="border-color: #f1e5d7; padding: 0.65rem 1rem; border-radius: 0 12px 12px 0; background-color: #fdfbf7;">
        </div>
        @error('harga_beli')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold" style="color: var(--primary-dark); font-size: 0.875rem;">
            <i class="bi bi-tags me-1 text-warning"></i> Harga Jual
        </label>
        <div class="input-group">
            <span class="input-group-text" style="background-color: #faf5ee; border-color: #f1e5d7; border-radius: 12px 0 0 12px; color: var(--primary-dark); font-weight: 600; font-size: 0.85rem;">Rp</span>
            <input type="number" name="harga_jual"
                class="form-control @error('harga_jual') is-invalid @enderror"
                value="{{ old('harga_jual', $product->harga_jual ?? '') }}"
                placeholder="20000"
                style="border-color: #f1e5d7; padding: 0.65rem 1rem; border-radius: 0 12px 12px 0; background-color: #fdfbf7;">
        </div>
        @error('harga_jual')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-semibold" style="color: var(--primary-dark); font-size: 0.875rem;">
        <i class="bi bi-stack me-1 text-warning"></i> Stok Produk
    </label>
    <input type="number" name="stok"
        class="form-control @error('stok') is-invalid @enderror"
        value="{{ old('stok', $product->stok ?? '') }}"
        placeholder="Jumlah stok"
        style="border-color: #f1e5d7; padding: 0.65rem 1rem; border-radius: 12px; background-color: #fdfbf7;">
    @error('stok')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<style>
    .form-control:focus {
        border-color: var(--brand-warm) !important;
        box-shadow: 0 0 0 0.25rem rgba(217, 119, 6, 0.15) !important;
    }
</style>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const container = document.getElementById('preview-container');
    const file = input.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
    }
}
</script>