<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%')
                      ->orWhere('description', 'like', '%' . $request->q . '%')
                      ->orWhere('sku', 'like', '%' . $request->q . '%');
            })
            ->paginate(10);

        return view('dashboard.products.index', [
            'products' => $products,
            'q' => $request->q
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:50|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()
                ->with('errorMessage', 'Validasi Error, Silahkan lengkapi data terlebih dahulu');
        }

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image_url = $request->image_url;
        $product->is_active = $request->is_active ?? true;

        $product->save();

        return redirect()->route('products.index')
            ->with('successMessage', 'Produk berhasil disimpan');
    }

    /**
     * Display the specified product.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('dashboard.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('dashboard.products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'sku' => 'required|string|max:50|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()
                ->with('errorMessage', 'Validasi Error, Silahkan lengkapi data terlebih dahulu');
        }

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image_url = $request->image_url;
        $product->is_active = $request->is_active ?? true;

        $product->save();

        return redirect()->route('products.index')
            ->with('successMessage', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('successMessage', 'Produk berhasil dihapus');
    }
}
