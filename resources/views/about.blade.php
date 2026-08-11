@extends('layouts.app')

@section('title', 'Tentang Aplikasi - Bubu Bakery')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="row g-4 justify-content-center align-items-center w-100">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm text-center p-4" style="border-radius: 1.5rem; background: #ffffff;">
                <div class="mb-3">
                    <img src="{{ asset('img/aku.png') }}" class="rounded-circle shadow-sm border border-4 border-white" 
                         style="width: 150px; height: 150px; object-fit: cover;" alt="Foto Pembuat" 
                         onerror="this.src='https://via.placeholder.com/150?text=Foto+Kamu'">
                </div>
                
                <h4 class="fw-bold mb-1" style="color: var(--primary-dark);">Millata Hanifah</h4>
                <p class="text-muted small mb-3">Fullstack Web Developer</p>
                
                <div class="text-start bg-light p-3" style="border-radius: 1rem; font-size: 0.85rem;">
                    <div class="mb-2"><strong>Kelas:</strong> XII PPLG 1</div>
                    <div class="mb-2"><strong>Projek:</strong> Ujian Kompetensi Keahlian (UKK)</div>
                    <div class="mb-2"><strong>Email:</strong> millatahanifah9@gmail.com</div>
                    <div class="mb-0">
                        <strong>Instagram:</strong> 
                        <a href="https://www.instagram.com/mltahnifh/" target="_blank" class="text-decoration-none fw-bold" style="color: var(--primary-dark);">
                            <i class="bi bi-instagram text-danger me-1"></i> @mltahnifh
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 1.5rem; background: #ffffff;">
                <h3 class="fw-bold mb-3" style="color: var(--primary-dark);">
                    <i class="bi bi-info-circle-fill me-2" style="color: var(--brand-warm);"></i> Tentang Aplikasi Bubu Bakery
                </h3>
                <p class="text-muted">
                    <strong>Bubu Bakery</strong> adalah aplikasi berbasis web yang dirancang khusus untuk mempermudah pencatatan data produk roti, manajemen stok barang secara akurat, serta memantau laporan rekapitulasi penjualan harian toko secara terstruktur.
                </p>

                <hr class="my-4" style="opacity: 0.1;">

                <h5 class="fw-bold mb-3 text-dark">
                    <i class="bi bi-cpu me-2" style="color: var(--brand-warm);"></i> Spesifikasi & Versi
                </h5>

                <div class="table-responsive mb-4">
                    <table class="table table-borderless align-middle mb-0" style="font-size: 0.95rem;">
                        <tbody>
                            <tr>
                                <td class="fw-bold text-secondary ps-0" style="width: 35%;">Framework</td>
                                <td class="text-dark">: Laravel</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-secondary ps-0">Bahasa Pemrograman</td>
                                <td class="text-dark">: PHP</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-secondary ps-0">Database</td>
                                <td class="text-dark">: MariaDB / MySQL</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-secondary ps-0">Text Editor</td>
                                <td class="text-dark">: Visual Studio Code</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-3 border border-warning-subtle" style="background: #fffbeb; border-radius: 1rem;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold text-dark">Versi Aplikasi</span>
                            <div class="small text-muted">Status: Stable Release</div>
                        </div>
                        <span class="badge bg-warning text-dark fs-6 px-3 py-2" style="border-radius: 10px;">v1.0.0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection