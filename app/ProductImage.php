<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    // $productImage -> product
    public function product()
    {
    	// pertenece a un producto determinado.
    	return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute()
    {
    	// Condicion para cargar una imagen desde la url , sino , carga una imagen local.
    	if (substr($this->image, 0, 4) === "http") {
    		return $this->image;
    	}

    	return '/images/products/' . $this->image;
    }
}
