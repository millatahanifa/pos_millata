<style>
    .sidebar-custom {
        width: 280px;
        height: 100vh;
        position: sticky;
        top: 0;
        background-color: #ffffff;
        border-right: 1px solid #eee;
    }

    .brand-icon-custom {
        background-color: #5c3a21; /* Warna cokelat ala POS Millata */
        color: #ffffff;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .nav-link-custom {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        text-decoration: none;
        color: #555555;
        font-size: 15px;
        font-weight: 500;
        border-radius: 10px;
        transition: all 0.2s ease-in-out;
    }

    .nav-link-custom i {
        font-size: 18px;
        width: 20px;
        text-align: center;
    }

    .nav-link-custom:hover {
        background-color: #f8f5f2;
        color: #5c3a21;
    }

    /* Menu saat aktif (warna cokelat sesuai gambar) */
    .nav-link-custom.active {
        background-color: #5c3a21 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(92, 58, 33, 0.25);
    }

    .btn-logout-custom {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 12px;
        background-color: #fff5f5;
        color: #d32f2f;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        border-radius: 10px;
        border: 1px solid #ffebee;
        transition: all 0.2s;
        cursor: pointer;
    }

    .btn-logout-custom:hover {
        background-color: #ffebee;
    }
</style>

<div class="sidebar-custom d-flex flex-column flex-shrink-0 p-3">
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none px-2 py-1">
        <div class="brand-icon-custom me-3">
            <i class="fa-solid fa-store"></i>
        </div>
        <span class="fs-5 fw-bold text-dark">POS Millata</span>
    </a>
    
    <hr class="my-3 text-muted">

    <ul class="nav nav-pills flex-column mb-auto gap-2">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link-custom {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('produk.index') }}" class="nav-link-custom {{ Request::is('produk*') ? 'active' : '' }}">
                <i class="fa-solid fa-box"></i> Produk
            </a>
        </li>
        <li>
            <a href="{{ route('penjualan.index') }}" class="nav-link-custom {{ Request::is('penjualan*') ? 'active' : '' }}">
                <i class="fa-solid fa-receipt"></i> Penjualan
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users') }}" class="nav-link-custom {{ Request::is('admin/users*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Users
            </a>
        </li>
    </ul>

    <div class="sidebar-footer mt-auto pt-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout-custom">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </button>
        </form>
    </div>
</div>