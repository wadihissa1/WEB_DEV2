<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use SebastianBergmann\Template\Template;

class WebsiteController extends Controller
{
    public function getindex()
    {
        return view('index');
    }
    public function getaccount()
    {
        return view('account');
    }
    public function getcart()
    {
        return view('cart');
    }

    public function getproduct()
    {
        return view('product');
    }
    public function getproduct_details()
    {
        return view('product_details');
    }
    public function getprofile()
    {
        return view('profile');
    }
}
