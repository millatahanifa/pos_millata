<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            ->with('user')
            ->when($user->role && optional($user->role)->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    public function create()
    {
        // 1. Buat transaksi baru dengan status OPEN dan total 0
        $sale = Penjualan::create([
            'user_id'           => auth()->id(),
            'status'            => 'OPEN',
            'metode_pembayaran' => 'CASH',
            'total_pembayaran'  => 0
        ]);

        // 2. Langsung arahkan ke halaman POS dengan membawa ID transaksi yang baru dibuat
        return redirect()->route('penjualan.pos', $sale->id);
    }

    // Halaman POS tempat kasir memilih produk & melihat keranjang
    public function pos($id)
    {
        $sale = Penjualan::with('itemPenjualan.produk')->findOrFail($id);
        $products = Produk::all();

        return view('penjualan.create', compact('sale', 'products'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load('itemPenjualan.produk', 'user');
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit($id)
    {
        return redirect()->route('penjualan.pos', $id);
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS'
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('error', 'Transaksi sudah diproses');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('error', 'Keranjang masih kosong');
        }

        DB::transaction(function () use ($penjualan, $request) {
            $total = $penjualan->itemPenjualan()->sum('subtotal');

            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran'  => $total,
                'status'            => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }

    public function destroy(Penjualan $penjualan)
    {
        if ($penjualan->status !== 'OPEN') {
            return redirect()->route('penjualan.index')->with('error', 'Transaksi sudah selesai tidak bisa dihapus');
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                if ($item->produk) {
                    $item->produk->increment('stok', $item->kuantitas);
                }
            }
            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}