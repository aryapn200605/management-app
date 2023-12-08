<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductContorller extends Controller
{
    public function index()
    {
        $datas = ProductModel::all();

        return view('admin.products.index', compact('datas'));
    }
    
    public function findAllProduct(Request $request)
    {
        $datas = ProductModel::all();

        return response()->json($datas, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $product = new ProductModel();
        $product->name = $request->input('name');
        $product->price = preg_replace('/[^0-9]/', '', $request->input('price'));
        $product->sellable = 1;

        $product->save();

        return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $product = ProductModel::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
    
        $product = ProductModel::findOrFail($id);
    
        // Update data produk
        $product->update([
            'name' => $request->input('name'),
            'price' => preg_replace('/[^0-9]/', '', $request->input('price')),
        ]);
    
        return redirect()->route('products')->with('success', 'Produk berhasil diperbarui');    
    }

    public function destroy(string $id)
    {
        $product = ProductModel::find($id);

        if ($product) {
            $product->delete();
            return redirect()->route('products')->with('success', 'Produk berhasil dihapus');
        } else {
            return redirect()->route('products')->with('danger', 'Produk tidak ditemukan');
        }
    }
}
