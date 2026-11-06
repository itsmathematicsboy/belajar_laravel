<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\ProductImage;

class Product extends Model
{
    protected $fillable = ['category_id', 'image', 'name', 'slug', 'price', 'price_art_cartoon', 'price_art_paper',
    'price_art_hvs', 'price_art_dof', 'price_art_glossy', 'cutting_price', 'brief_description', 'description'];

    // many to one
    public function category(){
        //
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}
