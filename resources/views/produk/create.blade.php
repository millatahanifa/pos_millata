@extends('layouts.app')

@section('title', 'Tambah Produk - POS Millata')

@section('content')
<div class="top-header d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h1 class="page-title fw-bold mb-1" style="color: var(--primary-dark, #3a1a05); font-size: 1.65rem;">Tambah Produk</h1>
        <div class="date-subtitle text-muted fs-6">
            <i class="bi bi-box-seam me-1"></i> Tambahkan data produk baru ke inventaris
        </div>
    </div>
</div>

<div class="container-fluid px-0 d-flex flex-column justify-content-center" style="min-height: calc(100vh - 180px);">
    <div class="row justify-content-center w-100 m-0">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <div class="custom-card p-4">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    @include('produk._form')
                    
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top" style="border-color: #faf0e6 !important;">
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 8px; font-weight: 600;">Batal</a>
                        <button type="submit" class="btn text-white px-4 py-2" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); border-radius: 8px; font-weight: 700; border: none; box-shadow: 0 4px 10px rgba(3, 105, 161, 0.2);">
                            <i class="bi bi-plus-circle-fill me-1"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection