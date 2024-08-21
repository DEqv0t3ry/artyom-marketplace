<?php

namespace App\Services;

use App\Models\Product;

class CatalogService
{

    public function getProducts(string $search = null)
    {
        return Product::query()->latest()->where('on_sale', true)->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(5);
    }
}
