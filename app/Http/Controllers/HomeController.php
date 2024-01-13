<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(50);
        $products_count = Product::count();

        return view('home.index', compact('products', 'products_count'));
    }
}
