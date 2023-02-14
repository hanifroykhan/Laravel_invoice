<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',

        ]);

        $post = new Product();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->price = $request->input('price');
        $post->save();

        return redirect('/indexProducts')->with('success', 'Data Product created successfully!');;
    }

    public function edit($id)
    {
        $editProduct = Product::find($id);
        return view('products.edit', compact('editProduct'));
    }

    public function update(Request $request, $id)
    {
        $editProduct = Product::find($id);
        $editProduct->title = $request->input('title');
        $editProduct->description = $request->input('description');
        $editProduct->price = $request->input('price');
        $editProduct->update();
        return redirect('/indexProducts')->with('status','Data Products Updated Successfully');
    }

    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect('/indexProducts')->with('status', 'Data Products Berhasil DiHapus');
    }

}
