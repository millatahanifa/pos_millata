<nav class="navbar navbar-expand-lg bg-body-tertiary px-4 shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('dashboard') }}" style="color: var(--primary-dark);">
            <div class="d-inline-flex align-items-center justify-content-center bg-warning-subtle p-2 rounded-circle me-2" style="width: 35px; height: 35px;">
                <i class="bi bi-cake2 text-warning"></i>
            </div>
            Bubu Bakery
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">Beranda</a>
                </li>

                @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role?->name === 'admin'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/users') ? 'active fw-bold' : '' }}" href="{{ route('admin.users') }}">Pengguna</a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('produk') ? 'active fw-bold' : '' }}" href="{{ route('produk.index') }}">Produk</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('penjualan') ? 'active fw-bold' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
                </li>

                @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('admin.penjualan.rekap') }}" class="nav-link-custom {{ Request::is('admin/penjualan/rekap*') ? 'active' : '' }}">
                         <i class="bi bi-graph-up-arrow me-2"></i> Rekap Bulanan
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active fw-bold' : '' }}" href="{{ route('about') }}">Tentang Aplikasi</a>
                </li>
            </ul>

            <form class="d-flex" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger px-4" style="border-radius: 10px;">Keluar</button>
            </form>
        </div>
    </div>
</nav>