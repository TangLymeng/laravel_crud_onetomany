<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect('admin/category')->with('success', 'Category created successfully.');
    }
    public function destroy($category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->delete();
        return redirect('admin/category')->with('success', 'Category deleted successfully.');
    }
}


