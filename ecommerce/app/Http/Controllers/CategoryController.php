<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Devuelve todas las categorías en formato JSON
    public function index()
    {
        $categories = Category::all(); // Obtiene todas las categorías

        return response()->json($categories); // Devuelve las categorías como JSON
    }



    // Devuelve una categoría específica por slug con sus productos
    public function showBySlug($slug)
    {
        $category = Category::where('slug', $slug)->with('products')->firstOrFail();
        return response()->json($category);
    }

    // Crea una nueva categoría
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories',
            'description' => 'required',
            'priority' => 'required|integer',
        ]);

        // Crea la categoría y genera el slug automáticamente
        $category = Category::create($validated);
        return response()->json($category, 201); // Código HTTP 201: Creado
    }

    // Actualiza una categoría existente
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'description' => 'required',
            'priority' => 'required|integer',
        ]);

        $category->update($validated);
        return response()->json($category);
    }

    // Elimina una categoría
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully.']);
    }

    // Devuelve los productos de una categoría específica por slug
    public function getProducts($slug)
    {
        $category = Category::where('slug', $slug)->with('products')->firstOrFail();
        return response()->json($category->products);
    }

    public function search($name)
    {
    // Busca categorías cuyo nombre coincida parcialmente con el parámetro
        $categories = Category::where('name', 'LIKE', "%{$name}%")->get();

    // Verifica si hay resultados
        if ($categories->isEmpty()) {
            return response()->json(['message' => 'No categories found.'], 404);
        }

        return response()->json($categories, 200);
    }
}



