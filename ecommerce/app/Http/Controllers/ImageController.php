<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('products', 'public');

        return response()->json(['path' => $path], 201);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        if (Storage::exists('public/' . $request->path)) {
            Storage::delete('public/' . $request->path);
            return response()->json(['message' => 'Image deleted'], 200);
        }

        return response()->json(['message' => 'Image not found'], 404);
    }
}

