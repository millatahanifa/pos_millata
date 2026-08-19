<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        if ($keyword) {
            $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();
        } else {
            $products = Produk::latest()->paginate(10)->withQueryString();
        }

        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Produk::class);

        return view('produk.create');
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id(),
            'nama'       => $dataReq['nama'] ?? '',
            'harga_beli' => $dataReq['harga_beli'] ?? 0,
            'harga_jual' => $dataReq['harga_jual'] ?? 0,
            'stok'       => $dataReq['stok'] ?? 0,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Product created successfully.');
    }

    public function show(Produk $produk)
    {
        $this->authorize('view', $produk);

        $product = $produk;

        return view('produk.show', compact('product'));
    }

    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        $product = $produk;

        return view('produk.edit', compact('product'));
    }

    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $dataReq = $request->validated();

        $data = [
            'nama'       => $dataReq['nama'] ?? $produk->nama,
            'harga_beli' => $dataReq['harga_beli'] ?? $produk->harga_beli,
            'harga_jual' => $dataReq['harga_jual'] ?? $produk->harga_jual,
            'stok'       => $dataReq['stok'] ?? $produk->stok,
        ];

        if ($request->hasFile('foto')) {
            if (
                $produk->foto &&
                Storage::disk('public')->exists($produk->foto)
            ) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        try {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $produk->delete();

            return redirect()->route('produk.index')->with('success', 'Product deleted successfully.');
            
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->route('produk.index')->with('error', 'Produk tidak dapat dihapus karena sudah pernah digunakan dalam transaksi penjualan!');
            }
            
            throw $e;
        }
    }
}