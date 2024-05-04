<?php
 
namespace App\Http\Controllers;
 
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
 
        return redirect()->route('viewstore', ['store' => $request->store_id])->with('success', 'Product created successfully.');
    }
 
    //show all products
    public function StoresDetails(){
        $store = auth()->user();
        $storeProducts = Product::where('store_id', $store->id)->latest()->paginate(6);
   
        return view('viewstore', [
            'store' => $store,
            'products' => $storeProducts
        ]);
    }
 
}