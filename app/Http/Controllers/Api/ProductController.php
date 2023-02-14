<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->paginate(10);
        return [
            "status" => 1,
            "data" => $product
        ];
    }

    public function show(Product $product)
    {
        return [
            "status" => 1,
            "data" => $product
        ];
    }
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product = Product::create($request->all());
        return [
            "status" => 1,
            "data" => $product,
            "message" => "data created successfully"
        ];
    }
    public function update(Request $request, Product $product)
    {
       
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product->update($request->all());
        return [
            "status" => 1,
            "data" => $product,
            "message" => "data updated succesfully"
        ];
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return [
            "status" => 1,
            "data" => $product,
            "message" => "data deleted successfully"
        ];

    }
}