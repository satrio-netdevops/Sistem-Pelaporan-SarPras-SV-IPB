<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; 

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'quantity',
        'image_path',
        'barcode', 
    ];
    
    // Auto-generate barcode if creating new product
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->barcode)) {
                // Generate random 12-digit number
                $product->barcode = str_pad(mt_rand(1, 999999999999), 12, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relationship: Product belongs to one Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}