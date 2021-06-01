<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products= Product::latest()->limit(6)->get();
        return view('home', [
        'products' =>$products,
            ]);
    }
}
