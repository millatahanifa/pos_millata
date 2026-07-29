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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Menggunakan nama tabel 'penjualan' dan 'produk' sesuai database kamu
            'penjualan_id' => 'required|exists:penjualan,id',
            'product_id'   => 'required|exists:produk,id',
            'quantity'     => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request) {

            $sale = Penjualan::where('id', $request->penjualan_id)
                ->where('status', 'OPEN')
                ->firstOrFail();

            $product = Produk::lockForUpdate()->findOrFail($request->product_id);

            // 🔒 Cek stok
            if ($product->stok < $request->quantity) {
                throw ValidationException::withMessages([
                    'product_id' => 'Stok produk tidak mencukupi.'
                ]);
            }

            // 🔻 Kurangi stok
            $product->decrement('stok', $request->quantity);

            // + Update / Insert item penjualan
            $item = ItemPenjualan::where('penjualan_id', $sale->id)
                ->where('produk_id', $product->id)
                ->lockForUpdate()
                ->first();

            if ($item) {
                // UPDATE
                $item->kuantitas += $request->quantity;
            } else {
                // CREATE
                $item = new ItemPenjualan([
                    'penjualan_id' => $sale->id,
                    'produk_id' => $product->id,
                    'kuantitas' => $request->quantity,
                    'harga_satuan' => $product->harga_jual,
                ]);
            }

            // Hitung subtotal SETELAH kuantitas fix
            $item->subtotal = $item->kuantitas * $item->harga_satuan;
            $item->save();

            // 💰 TOTAL PEMBAYARAN
            $sale->total_pembayaran = $sale->itemPenjualan()->sum('subtotal');
            $sale->save();
        });

        return back()->with('success', 'Item berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request, $itempenjualan) {

            $produk = $itempenjualan->produk()->lockForUpdate()->first();

            $selisih = $request->quantity - $itempenjualan->kuantitas;

            // 🔒 Jika qty bertambah -> kurangi stok
            if ($selisih > 0) {
                if ($produk->stok < $selisih) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Stok tidak mencukupi untuk penambahan kuantitas.'
                    ]);
                }
                $produk->decrement('stok', $selisih);
            }

            // 🔒 Jika qty berkurang -> kembalikan stok
            if ($selisih < 0) {
                $produk->increment('stok', abs($selisih));
            }

            // 🔄 Update item
            $itempenjualan->update([
                'kuantitas' => $request->quantity,
                'subtotal' => $request->quantity * $itempenjualan->harga_satuan
            ]);

            // 🔄 Update total penjualan
            $itempenjualan->penjualan->update([
                'total_pembayaran' => $itempenjualan->penjualan->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back()->with('success', 'Item berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemPenjualan $itempenjualan)
    {
        $this->authorize('delete', $itempenjualan);

        DB::transaction(function () use ($itempenjualan) {

            $produk = $itempenjualan->produk;
            $sale   = $itempenjualan->penjualan;

            // 🔵 Kembalikan stok
            if ($produk) {
                $produk->increment('stok', $itempenjualan->kuantitas);
            }

            // ❌ Hapus item
            $itempenjualan->delete();

            // 🔄 Update total penjualan
            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back()->with('success', 'Item berhasil dihapus');
    }
}