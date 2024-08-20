<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\CreateShopRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function addProducts(User $user)
    {
        return view('products.add', compact('user'));
    }

    public function store(CreateProductRequest $request, User $user)
    {
        $userId = $user->id;
        $productData = $request->validated();
        $productData['user_id'] = $userId;
        $productData['on_sale'] = false;

        if ($request->hasFile('thumbnail'))
        {
            $productData['thumbnail'] = $productData['thumbnail']->store('thumbnails', 'public');
        }

        $product = Product::create($productData);

        if ($request->hasFile('images'))
        {
            foreach ($request['images'] as $image) {
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

    public function deletePhoto(Product $product)
    {
        if ($product->thumbnail)
        {
            Storage::disk('public')->delete($product->thumbnail);
        }
        $product->update([
            'thumbnail' => null
        ]);
    }

    public function destroy(Product $product)
    {
        if ($product->thumbnail)
        {
            Storage::disk('public')->delete($product->thumbnail);
        }

        $product->delete();
        return redirect()->route('user.products.show', Auth::id())->with('success', 'Товар удален');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request,  Product $product)
    {
        $productData = $request->validated();
        $productData['on_sale'] = false;

        if ($request->hasFile('photo'))
        {
            $productData['thumbnail'] = $productData['thumbnail']->store('thumbnails', 'public');

            if ($product->thumbnail)
            {
                Storage::disk('public')->delete($product->thumbnail);
            }
        }

        if ($request->hasFile('images'))
        {
            foreach ($request['images'] as $image) {
                $photoPath = $image->store('images', 'public');
                $product->photos()->create([
                    'photo' => $photoPath
                ]);
            }
        }

        $product->update($productData);

        return redirect()->route('user.products.show', $product->user_id)->with('success', 'Товар успешно обновлен');
    }
}
