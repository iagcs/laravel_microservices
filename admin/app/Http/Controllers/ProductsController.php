<?php

namespace App\Http\Controllers;

use App\Jobs\ProductCreated;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    
    public function index()
    {
        return Product::all();
    }

    public function show($index)
    {
        dd(auth()->id);
        return Product::find($index);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'image' => 'required'
        ]);

        $product = Product::create([
            'title' => $request->title,
            'image' => $request->image
        ]);

        return response($product, Response::HTTP_CREATED);
    }

    public function update($index, Request $request)
    {
        $product = Product::find($index)->update([
            'title' => $request->title,
            'image' => $request->image
        ]);

        return response($product, Response::HTTP_ACCEPTED);
    }

    public function destroy($index)
    {
        Product::destroy($index);
    
        return response(null, Response::HTTP_NO_CONTENT);
    }

}
