<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products')); // listado.		
    }

    public function create()
    {
    	return view('admin.products.create'); // formulario de registro.
    }

    public function store(Request $request)
    {

        // validar
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',

            'description.required' => 'La descripcion corta es un campo obligatorio.',
            'description.max' => 'La descripcion corta solo admite hasta 200 caracteres.',

            'price.required' => 'Es obligatorio definir un precio para el producto.',
            'price.numeric' => 'Ingrese un precio valido.',
            'price.min' => 'No se admiten valores negativos.'
        ];

        $rules = [
            'name' => 'required|min:3', // obligatorio - minimo 3 letras
            'description' => 'required|max:200', // obligatorio - maximo 200 letras
            'price' => 'required|numeric|min:0', // obligatorio - solo numeros - no acepta negativos 
        ];

        $this->validate($request, $rules, $messages);

    	// registrar el nuevo producto en la bd.
        // dd($request->all());
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save(); // Insert a la table de productos
 
        return redirect('/admin/products');
    }


    public function edit($id)
    {

        //return "Mostrar aqui formulario de edicion para el producto con id $id ";
        $product = Product::find($id); // buscar producto base a id   
        return view('admin.products.edit')->with(compact('product')); // form de edicion
    }

    public function update(Request $request, $id)
    {
        
        // validar
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',

            'description.required' => 'La descripcion corta es un campo obligatorio.',
            'description.max' => 'La descripcion corta solo admite hasta 200 caracteres.',

            'price.required' => 'Es obligatorio definir un precio para el producto.',
            'price.numeric' => 'Ingrese un precio valido.',
            'price.min' => 'No se admiten valores negativos.'
        ];

        $rules = [
            'name' => 'required|min:3', // obligatorio - minimo 3 letras
            'description' => 'required|max:200', // obligatorio - maximo 200 letras
            'price' => 'required|numeric|min:0', // obligatorio - solo numeros - no acepta negativos 
        ];

        $this->validate($request, $rules, $messages);
        
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');

        $product->save(); 
        return redirect('/admin/products'); //UPDATE
    }

    public function destroy($id)
    {
        ProductImage::where('product_id', $id)->delete();// eliminar imagen 

        $product = Product::find($id);
        $product->delete(); // delete 
        
        return back();
    }
}
