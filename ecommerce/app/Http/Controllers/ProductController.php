<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::with('category')->get();

    // Agregar la URL completa para la imagen
    $products->map(function ($product) {
        $product->image = $product->image ? asset('storage/' . $product->image) : null;
        return $product;
    });

    return response()->json($products);
}


    public function showBySlug($slug)
    {
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        return response()->json($product);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|unique:products',
        'description' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $validated['image'] = $imagePath;
    }

    $product = Product::create($validated);

    return response()->json($product, 201);
}


    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|unique:products,name,' . $product->id,
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.']);
    }

    public function search($name)
    {
        // Busca productos cuyo nombre coincida parcialmente con el parámetro
        $products = Product::where('name', 'LIKE', "%{$name}%")->with('category')->get();

        // Verifica si hay resultados
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found.'], 404);
        }

        return response()->json($products, 200);
    }
}




