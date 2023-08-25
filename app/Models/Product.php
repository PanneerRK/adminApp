<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'prod_name',
        'prod_brand',
        'prod_price',
        'prod_tax',
        'prod_description',
        'prod_image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
