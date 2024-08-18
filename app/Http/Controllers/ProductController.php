<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\CreateShopRequest;
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
        $showingProduct = true;

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

        if ($request->hasFile('photo'))
        {
            $productData['photo'] = $productData['photo']->store('thumbnails', 'public');
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

    public function destroy(User $user, Product $product)
    {
        if($user->id !== $product->user_id) {
            abort(403);
        }

        if ($product->photo)
        {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
        return redirect()->route('user.products.show', auth()->id())->with('success', 'Товар удален');
    }

    public function edit(Product $product)
    {
        if(Auth::id() !== $product->user_id) {
            abort(403);
        }
        return view('products.edit', compact('product'));
    }

    public function update(Product $product)
    {
        $validated = request()->validate([
            'name' => 'required',
            'short_description' => 'required',
            'main_description' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'photo' => 'image',
            'images.*' => 'image'
        ]);

        if(Auth::id() !== $product->user_id) {
            abort(403);
        }

        if (request()->hasFile('photo'))
        {
            $validated['photo'] = request('photo')->store('thumbnails', 'public');

            if ($product->photo)
            {
                Storage::disk('public')->delete($product->photo);
            }
        }
        else {
            unset($validated['photo']);
        }

        if (request('images'))
        {
            $originalImages = $product->photos()->get();
            $count = 0;
            foreach (request('images') as $image) {
                $photoPath = $image->store('images', 'public');
                if ($originalImages[$count]) {
                    $product->photos()->update([
                        'photo' => $photoPath
                    ]);
                    $count++;
                }
                else{
                    $product->photos()->create([
                        'photo' => $photoPath
                    ]);
                }
            }
        }

        $product->update($validated);

        return redirect()->route('user.products.show', $product->user_id)->with('success', 'Товар успешно обновлен');
    }
}
