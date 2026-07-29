<?php

namespace App\Policies;

use App\Models\Penjualan;
use App\Models\User;

class PenjualanPolicy
{
    /**
     * Semua user login boleh lihat daftar.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Semua user login boleh lihat detail.
     */
    public function view(User $user, Penjualan $penjualan): bool
    {
        return true;
    }

    /**
     * Hanya Admin yang boleh edit, dan HANYA untuk transaksi dengan status OPEN.
     * Kasir tidak boleh edit sama sekali.
     */
    public function update(User $user, Penjualan $penjualan): bool
    {
        if ($user->role->name === 'kasir') {
            return false;
        }

        return $user->role->name === 'admin' && $penjualan->status === 'OPEN';
    }

    /**
     * Hanya Admin yang boleh hapus, dan HANYA untuk transaksi dengan status OPEN.
     * Kasir tidak boleh hapus sama sekali.
     */
    public function delete(User $user, Penjualan $penjualan): bool
    {
        if ($user->role->name === 'kasir') {
            return false;
        }

        return $user->role->name === 'admin' && $penjualan->status === 'OPEN';
    }
}