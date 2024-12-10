<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'slug', 'image'];

    // Generar el slug automáticamente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    // Relación con Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}



