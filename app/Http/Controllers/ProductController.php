<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $showingProduct = true;

        return view('products.show', compact('product'));
    }

    public function products_add(User $user)
    {
        return view('products.add', compact('user'));
    }

    public function store(User $user)
    {
        if (request()->hasFile('photo'))
        {
            $thumbnailPath = request('photo')->store('thumbnails', 'public');
        }

        $product = Product::create([
            'name' => request('name'),
            'short_description' => request('short_description'),
            'main_description' => request('main_description'),
            'price' => request('price'),
            'photo' => $thumbnailPath ?? null,
            'unit_id' => request('unit'),
            'user_id' => $user->id,
            'on_sale' => false,
        ]);

        if (request('images'))
        {
            foreach (request('images') as $image) {
                $photoPath = $image->store('images', 'public');
                $product->photos()->create([
                    'photo' => $photoPath
                ]);
            }
        }

        return redirect()->route('user.products.show', $user->id);
    }

    public function changeStatus(Request $request, Product $product)
    {
        $request->validate([
            'status' => 'required|bool'
        ]);
        $product->update([
            'on_sale' => $request->get('status') ? 1 : 0
        ]);

        return $product;
    }
}
