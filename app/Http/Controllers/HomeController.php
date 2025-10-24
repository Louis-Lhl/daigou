<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the public landing page with featured products.
     */
    public function __invoke(): View
    {
        $products = Product::where('status', 'ACTIVE')
            ->orderByDesc('published_at')
            ->take(6)
            ->get();

        return view('home.index', compact('products'));
    }
}
