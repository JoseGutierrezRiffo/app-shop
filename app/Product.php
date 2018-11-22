<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // $product -> category
    public function category()
    {
    	// un producto pertenece a una categoria.
    	return $this->belongsTo(Category::class);
    }

    // $product -> images
    public function images()
    {
    	// producto tiene muchas imagenes.
    	return $this->hasMany(ProductImage::class);
    }

}
