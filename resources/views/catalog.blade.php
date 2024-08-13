@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-3">

        </div>
        <div class="col-6">
            <p class="text-center fs-4 my-3">Каталог товаров</p>
            <hr>
            <div class="mt-3">
                @forelse($products as $product)
                    <div class="mt-3">
                        @include('shared.product-card')
                    </div>
                @empty
                    <p class="text-center my-3">Ничего не найдено</p>
                @endforelse
                <div class="mt-3">
                </div>
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
        </div>
    </div>
@endsection
