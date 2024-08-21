<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CatalogService;
use Illuminate\Http\Request;
use function Laravel\Prompts\search;

class CatalogController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService,
    )
    {
    }
    public function index(Request $request)
    {
        return view('catalog',
        [
            'products' => $this->catalogService->getProducts($request->get('search',null)),
        ]);
    }
}
