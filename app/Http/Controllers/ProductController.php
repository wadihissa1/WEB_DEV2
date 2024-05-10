<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;

class ProductController extends Controller
{
    public function create($storeId)
    {
        $store = Store::findOrFail($storeId);
        $categories = Category::all();
        return view('createproduct', compact('store', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id', // Ensure store_id is present and valid
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('product_images');

        // Create product
        $product = new Product();
        $product->store_id = $request->store_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->image = $imagePath;
        $product->save();

        return redirect()->back()->with('success', 'Product created successfully.');
    }




    //shows product details blade
    public function show($id)
{
    $products = Product::findOrFail($id);

    return view('product_details', ['product' => $products]);
}





    //show all products
        public function StoresDetails(){
        $store = auth()->user();
        $storeProducts = Product::where('store_id', $store->id)->get();
        $storeProduct = Product::all();
        return view('viewstore', [
            'store' => $store,
            'products' => $storeProducts
        ]);
    }

    public function viewProducts($storeId)
    {
        $store = Store::findOrFail($storeId);
        $products = $store->products()->get();

        return view('viewproducts', compact('store', 'products'));
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $store = $product->store;
        $categories = Category::all();

        return view('editproduct', compact('product', 'store', 'categories'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Allow empty image on update
        'category_id' => 'required|exists:categories,id',
        'store_id' => 'required|exists:stores,id', // Ensure store_id is present and valid
    ]);

    $product = Product::findOrFail($id);

    // Update product fields
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->category_id = $request->category_id;

    // Check if image is provided
    if ($request->hasFile('image')) {
        // Delete old image if exists
        Storage::delete($product->image);

        // Upload new image
        $imagePath = $request->file('image')->store('product_images');
        $product->image = $imagePath;
    }

    $product->save();

    return redirect()->route('viewstore', ['store' => $product->store_id])->with('success', 'Product updated successfully.');
}


public function destroy(Product $product)
{
    $store_id = $product->store_id;
    $product->delete();

    return redirect()->route('viewstore', ['store' => $store_id])->with('success', 'Product deleted successfully.');
}

public function index(){
    return view("viewproducts");
}
}
