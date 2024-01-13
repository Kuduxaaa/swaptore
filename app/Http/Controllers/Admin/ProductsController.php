<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function show()
    {
        $products = Product::orderBy('id', 'desc')->paginate(50);

        return view('admin.pages.products.show', ['products' => $products]);
    }

    public function add()
    {
        return view('admin.pages.products.add', ['categories' => Categories::all()]);
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Categories::all();

        if (!$product)
        {
            return abort(404);
        }

        return view('admin.pages.products.add', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'category_id' => 'required|numeric',
            'discounted_price' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image_paths = [];
        foreach ($request->file('images') as $image) 
        {
            $path = $image->storeAs('public/uploads', uniqid().'.'.$image->getClientOriginalExtension());
            $image_paths[] = Storage::url($path);
        }
        
        Product::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'discounted_price' => $data['discounted_price'] ?? null,
            'images' => json_encode($image_paths)
        ]);

        return redirect(route('admin.products'))->with('message', 'Product successfully created'); 
    }

    public function edit_perform($id, Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'discounted_price' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'category_id' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    
        $product = Product::findOrFail($id);
    
        $new_data = [
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'discounted_price' => $data['discounted_price'] ?? null
        ];
    
        if ($request->hasFile('images')) 
        {
            $image_paths = [];
    
            foreach ($request->file('images') as $image) 
            {
                $path = $image->storeAs('public/uploads', uniqid().'.'.$image->getClientOriginalExtension());
                $image_paths[] = Storage::url($path);
            }
    
            $new_data['images'] = json_encode($image_paths);
        }
    
        $product->update($new_data);
    
        return redirect(route('admin.products'))->with('message', 'Product successfully edited');
    }
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect(route('admin.products'))->with('message', 'Product removed successfully');
    }

}
