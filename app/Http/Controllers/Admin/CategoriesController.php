<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show()
    {
        $categories = Categories::withCount('products')->get();

        return view('admin.pages.categories.show', ['categories' => $categories]);
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect(route('admin.categories'))->with('message', 'Category deleted successfully');
    }

    public function add (Request $request) 
    {
        $request->validate(['name' => 'required|string|max:255']);
        $name = $request->input('name');

        $category = Categories::where('name', $name)->first();

        if ($category)
        {
            return redirect()->back()->with('error', 'Category with this name already exists');
        }

        Categories::create(['name' => $name]);

        return redirect()->back()->with('message', 'Category created successfully!');
    }
}
