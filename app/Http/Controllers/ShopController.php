<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(){
        $products = Product::where('status','ACTIVE')->orderByDesc('published_at')->paginate(12);
        return view('shop.index', compact('products'));
    }
    public function show(string $slug){
        $p = Product::where('slug',$slug)->where('status','ACTIVE')->firstOrFail();
        return view('shop.show', compact('p'));
    }
}
