<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeOrderStatusRequest;
use App\Http\Requests\ChangeProductStatusRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\CreateShopRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Unit;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct(
        private readonly ProductService $productService
    ){
    }

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
        $this->productService->createProduct($request, $user);

        return redirect()->route('user.products.show', $user->id);
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request,  Product $product)
    {
        $this->productService->updateProduct($request, $product);

        return redirect()->route('user.products.show', $product->user_id)->with('success', 'Товар успешно обновлен');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return redirect()->route('user.products.show', Auth::id())->with('success', 'Товар удален');
    }

    public function deleteThumbnail(Product $product)
    {
        $this->productService->deleteThumbnail($product);
    }

    public function changeStatus(ChangeProductStatusRequest $request, Product $product)
    {
        return $this->productService->changeStatus($request, $product);
    }
}
