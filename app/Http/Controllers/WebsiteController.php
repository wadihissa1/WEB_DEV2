<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use SebastianBergmann\Template\Template;

class WebsiteController extends Controller
{
    //show home view
    public function getindex()
    {
        $randomProducts = Product::inRandomOrder()->simplepaginate(5);


        return view('index', [
            'userStore' => Store::latest()->simplepaginate(5),
            'randomProducts' => $randomProducts
        ]);
    }

    //show account view
    public function getaccount()
    {
        return view('account');
    }

    //show cart view
    public function getcart()
    {
        return view('cartblade');
    }

    //
    public function getproduct($id)
    {
        $user = User::find($id);
        $randomProducts = Product::inRandomOrder()->simplepaginate(5);


        // Return the product view
        return view('product', [
            'userId' => $user,
            'randomProducts' => $randomProducts,
        ]);
    }

    //show product detail view
    public function getproduct_details($id)
    {
        $product = Product::find($id);
        $categoryId = $product->category_id;
        $relatedProducts = Product::where('category_id', $categoryId)
            ->where('id', '!=', $id) // Exclude the current product
            ->simplepaginate(8); // Adjust the pagination limit as needed

        // Retrieve store information associated with the product
        $store = $product->store;
        return view('product_details', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'store' => $store,
        ]);
    }

    //show profile view
    public function getprofile()
    {
        return view('profile');
    }
}
