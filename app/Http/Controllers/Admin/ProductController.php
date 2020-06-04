<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{

    public function index()
    {
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products'));//listado
    }
    public function create()
    {
        $categories = category::orderBy('name')->get();
    	return view('admin.products.create')->with(compact('categories'));//formulario de registro
    }
    public function store(Request $request )
    {
    	//validar datos
    	$messages = [
    		'name.required' => 'Ingrese un nombre',
    		'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
    		'description.required' => 'Ingrese una descripción',
    		'description.max' => 'Máximo 200 caracteres para el campo descripción',
    		'price.required' => 'Ingrese un precio',
    		'price.numeric' => 'Ingrese un precio válido',
    		'price.min' => 'No se admiten valores negativos',
    		'stock.required' => 'Ingrese un stock',
    		'stock.numeric' => 'Ingrese un stock válido',
    	];
    	$rules = [
    		'name' => 'required|min:3',
    		'description' => 'required|max:200',
    		'price' => 'required|numeric|min:0',
    		'stock' => 'required|numeric',
    	];
    	$this->validate($request, $rules, $messages);

    	//registrar el producto bd
    	//dd($request->all());
    	$product = new Product();
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->long_description = $request->input('long_description');
    	$product->stock = $request->input('stock');
        $product->category_id = $request->category_id;
    	$product->save();//insert

    	return redirect('/admin/products');
    }

    public function edit($id)
    {
    	//return "Mostrar aqui con id $id";
        $categories = Category::orderBy('name')->get();
    	$product = Product::find($id);
    	return view('admin.products.edit')->with(compact('product','categories'));;
    }

    public function update(Request $request, $id)
    {
    	//validar datos
    	$messages = [
    		'name.required' => 'Ingrese un nombre',
    		'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
    		'description.required' => 'Ingrese una descripción',
    		'description.max' => 'Máximo 200 caracteres para el campo descripción',
    		'price.required' => 'Ingrese un precio',
    		'price.numeric' => 'Ingrese un precio válido',
    		'price.min' => 'No se admiten valores negativos',
    		'stock.required' => 'Ingrese un stock',
    		'stock.numeric' => 'Ingrese un stock válido',
    	];
    	$rules = [
    		'name' => 'required|min:3',
    		'description' => 'required|max:200',
    		'price' => 'required|numeric|min:0',
    		'stock' => 'required|numeric',
    	];
    	$this->validate($request, $rules, $messages);

    	//registrar el producto bd
    	//dd($request->all());
    	$product = Product::find($id);
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->stock = $request->input('stock');
    	$product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;
    	$product->save();//update

    	return redirect('/admin/products');
    }

    public function destroy($id)
    {
    	
    	$product = Product::find($id);
    	$product->delete();//delete

    	return back();
    }
}
