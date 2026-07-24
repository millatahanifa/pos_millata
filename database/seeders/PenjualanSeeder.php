<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penjualan;
use App\Models\ItemPenjualan;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Db::transaction(function () {

            Penjualan::factory()
                ->count(10)
                ->create()
                ->each(function ($penjualan) {

                    $itemPenjualan = ItemPenjualan::factory()
                        ->count(rand(1, 5))
                        ->make([
                            'penjualan_id' => $penjualan->id,
                        ]);

                    $total = $itemPenjualan->sum('subtotal');

                    $penjualan->itemPenjualan()->saveMany($itemPenjualan);

                    $penjualan->update([
                        'total_pembayaran' => $total,
                    ]);

                    
                });
        });
    }
}
