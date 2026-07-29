<?php

namespace App\Providers;

use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\ItemPenjualan;
use App\Policies\ItemPenjualanPolicy;
use App\Models\User;
use App\Policies\DashboardPolicy;
use App\Policies\PenjualanPolicy;
use App\Policies\ProdukPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => DashboardPolicy::class,
        Produk::class => ProdukPolicy::class,
        Penjualan::class => PenjualanPolicy::class,
        ItemPenjualan::class => ItemPenjualanPolicy::class
    ]; 

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mendaftarkan Policies (jika pakai fitur Gate/Policy bawaan)
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }

        // Mengatur agar pagination menggunakan tampilan Bootstrap 5
        Paginator::useBootstrapFive();
    }
}