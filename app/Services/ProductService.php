<?php

namespace App\Services;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function createProduct(CreateProductRequest $request, User $user)
    {
        $productData = $request->validated();
        $productData['user_id'] = $user->id;
        $productData['on_sale'] = false;

        $request->hasFile('thumbnail') ?
            $productData['thumbnail'] = $productData['thumbnail']->store('thumbnails', 'public')
            : null;

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
    }

    public function updateProduct(UpdateProductRequest $request,  Product $product)
    {
        $productData = $request->validated();
        $productData['on_sale'] = false;

        if ($request->hasFile('thumbnail'))
        {
            $productData['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');

            $product->thumbnail ? Storage::disk('public')->delete($product->thumbnail) : null;
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
    }

    public function deleteProduct(Product $product)
    {
        $this->deleteThumbnail($product);

        foreach ($product->photos as $photo) {
            Storage::disk('public')->delete($photo->photo);
        }

        $product->delete();
    }

    public function deleteThumbnail(Product $product)
    {
        $product->thumbnail ? Storage::disk('public')->delete($product->thumbnail) : null;

        $product->update([
            'thumbnail' => null
        ]);
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
