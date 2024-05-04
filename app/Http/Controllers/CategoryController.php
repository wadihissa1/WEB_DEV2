<?php
 
namespace App\Http\Controllers;
use App\Models\StoreRequest;
use App\Models\Store;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
 
class CategoryController extends Controller
{
    public function create()
    {
        return view('category');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);
 
        // Create the category
        Category::create([
            'name' => $request->input('name'),
        ]);
 
        return redirect()->route('admin.index')->with('success', 'Category created successfully.');
    }
    public function viewCategories()
{
    $categories = Category::all();
    return view('viewcategories', ['categories' => $categories]);
}
 
}