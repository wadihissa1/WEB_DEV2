<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use SebastianBergmann\Template\Template;

class WebsiteController extends Controller
{
    //show home view
    public function getindex()
    {
        return view('index', [
            'userStore' => Store::latest()->simplepaginate(4)
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
        return view('cart');
    }

    //
    public function getproduct($id)
    {
        $user = User::find($id);

        // Return the product view
        return view('product', ['userId' => $user]);
    }

    //show product detail view
    public function getproduct_details()
    {
        return view('product_details');
    }

    //show profile view
    public function getprofile()
    {
        return view('profile');
    }
}
