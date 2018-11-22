<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use file;

class ImageController extends Controller
{
    public function index($id)
    {
    	$product =  Product::find($id);
    	$images = $product->images;
    	return view ('admin.products.images.index')->with(compact('product' , 'images'));
    }

    public function store(Request $request, $id)
    {
    	// Guardar la imagen en nuestro proyecto
    	$file = $request->file('photo'); // Obtiene el archivo que se esta subiendo/enviando a traves de un campo como 'name=photo', y lo guarda en una variable '$file'.
    	$path = public_path() . '/images/products'; // es la ruta donde guardamos la imagen , dentro de public tendremos una carpeta images y dentro de images una carpeta products.
    	$fileName = uniqid() . $file->getClientOriginalName(); //asigna un id unico al nombre original , para no sobreescribirse.
    	$moved = $file->move($path, $fileName); // da la orden para que se guarde en la ruta '$path' con el nombre '$filename'.


    	// Crear un registro en la tabla product_images
    	if ($moved) {
    		$productImage = new ProductImage();
   		 	$productImage->image = $fileName;
    		//$ProductImage->featured = false; 
    		$productImage->product_id = $id;
    		$productImage->save(); // Insert	
    	}
   
    	return back();
    }

    public function destroy(request $request, $id)
    {
    	// eliminar el archivo
    	$productImage = ProductImage::find($request->image_id);
    	if (substr($productImage->image, 0, 4) !== "http") {
    		$deleted = true;
    		
    	} else {
    		$fulPath = public_path() . '/images/products/' . $productImage->image;
    		$deleted = file::delete($fulPath);
    	}

    	// eliminar el registro de la img en la bd
    	if ($deleted) {
    		$productImage->delete();
    	}

    	return back();
    }
}
