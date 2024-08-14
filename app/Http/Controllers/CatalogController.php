<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc');

        if(request('search')) {
            $products->where('name', 'like', '%' . request('search') . '%') // поиск по имени товара
            ->orWhereHas('user.shop', fn($query) => $query->where('name', 'like', '%' . request('search') . '%')); // поиск по названию продавца
        }

        return view('catalog',
        [
            'products' => $products->paginate(5),
        ]);
    }
}
