<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ItemPenjualanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualan,id',
            'product_id'   => 'required|exists:produk,id',
            'quantity'     => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request) {
            $sale = Penjualan::where('id', $request->penjualan_id)
                ->where('status', 'OPEN')
                ->firstOrFail();

            $product = Produk::lockForUpdate()->findOrFail($request->product_id);

            if ($product->stok < $request->quantity) {
                throw ValidationException::withMessages([
                    'product_id' => 'Stok produk tidak mencukupi.'
                ]);
            }

            $product->decrement('stok', $request->quantity);

            $item = ItemPenjualan::where('penjualan_id', $sale->id)
                ->where('produk_id', $product->id)
                ->lockForUpdate()
                ->first();

            if ($item) {
                $item->kuantitas += $request->quantity;
                $item->subtotal = $item->kuantitas * $item->harga_satuan;
                $item->save();
            } else {
                ItemPenjualan::create([
                    'penjualan_id' => $sale->id,
                    'produk_id'    => $product->id,
                    'kuantitas'    => $request->quantity,
                    'harga_satuan' => $product->harga_jual,
                    'subtotal'     => $request->quantity * $product->harga_jual,
                ]);
            }

            $sale->total_pembayaran = $sale->itemPenjualan()->sum('subtotal');
            $sale->save();
        });

        // 🎯 Redirect ke halaman POS transaksi aktif ini
        return redirect()->route('penjualan.pos', $request->penjualan_id)
                         ->with('success', 'Item berhasil ditambahkan');
    }

    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $penjualanId = $itempenjualan->penjualan_id;

        DB::transaction(function () use ($request, $itempenjualan) {
            $produk = $itempenjualan->produk()->lockForUpdate()->first();
            $selisih = $request->quantity - $itempenjualan->kuantitas;

            if ($selisih > 0) {
                if ($produk->stok < $selisih) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Stok tidak mencukupi.'
                    ]);
                }
                $produk->decrement('stok', $selisih);
            }

            if ($selisih < 0) {
                $produk->increment('stok', abs($selisih));
            }

            $itempenjualan->update([
                'kuantitas' => $request->quantity,
                'subtotal'  => $request->quantity * $itempenjualan->harga_satuan
            ]);

            $itempenjualan->penjualan->update([
                'total_pembayaran' => $itempenjualan->penjualan->itemPenjualan()->sum('subtotal')
            ]);
        });

        return redirect()->route('penjualan.pos', $penjualanId)
                         ->with('success', 'Item berhasil diperbarui');
    }

    public function destroy(ItemPenjualan $itempenjualan)
    {
        $penjualanId = $itempenjualan->penjualan_id;

        DB::transaction(function () use ($itempenjualan) {
            $produk = $itempenjualan->produk;
            $sale   = $itempenjualan->penjualan;

            if ($produk) {
                $produk->increment('stok', $itempenjualan->kuantitas);
            }

            $itempenjualan->delete();

            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return redirect()->route('penjualan.pos', $penjualanId)
                         ->with('success', 'Item berhasil dihapus');
    }
}