<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($product_id, $product_name)
    {
        $product = Product::where('id', $product_id)->first();

        if (!$product)
        {
            return abort(404);
        }

        return view('home.single-product', compact('product'));
    }

    public function show_with_id($product_id)
    {
        $product = Product::where('id', $product_id)->first();

        if (!$product)
        {
            return abort(404);
        }

        return redirect(route('product', ['product_id' => $product->id, 'product_name' => Str::slug($product->title)]));
    }

    public function search(Request $request)
    {
        $request->validate(['query' => 'required|string']);
        $query = $request->input('query');

        $products = Product::where('title', 'like', '%' . $query . '%')->paginate(50);
        $products_count = Product::count();

        return view('home.index', compact('products', 'products_count'));
    }

    public function categories($cid)
    {
        $category = Categories::where('id', $cid)->first();

        if (!$category)
        {
            return abort(404);
        }

        $products = Product::where('category_id', $category->id)->paginate(50);
        $products_count = Product::count();

        return view('home.index', compact('products', 'products_count'));
    }
}
