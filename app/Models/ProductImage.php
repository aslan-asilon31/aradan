<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
        'title',
        'color',
        'description',
        'slug',
    ];

    public function productpivots()
    {
        return $this->hasMany(ProductPivot::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
