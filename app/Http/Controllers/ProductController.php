<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //show all products
    public function StoresDetails(){
        $store = auth()->user();
        $storeProducts = Product::where('store_id', $store->id)->latest()->simplepaginate(6);
    
        return view('viewstore', [
            'store' => $store,
            'products' => $storeProducts
        ]);
    }

    

    //show create item

public function CreateItem(){
    return view('CreateItem');
}



    //Store items into DB
public function store(Request $request){
    $Store = auth()->user();
    $formItems = $request->validate([
        'store_id' => $Store->id,
        'category_id' => 'required',
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'quantity' => 'required',
    ]);

    $formItems['user_id']= auth()->id();
    Product::create($formItems);

    return redirect('StoresDetails')->with('message', 'Product Created!');
}
}
