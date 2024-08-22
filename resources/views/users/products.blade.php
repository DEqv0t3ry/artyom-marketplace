@extends('layout.layout')
@section('content')
    <div class="container py-4">
        <div class="row">
            @include('shared.success-message')
            <div class="col-3">
            </div>
            <div class="col-6">
                <div class="container mt-5">
                    <div class="d-flex justify-content-between mb-3">
                        <h2>Мои товары</h2>
                        <a href="{{route('products.add', $user->id)}}" class="btn btn-success">Добавить товар</a>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">Изображение</th>
                            <th scope="col">Название</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Ед. изм.</th>
                            <th scope="col">На продаже</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($user->products as $product)
                            <tr>
                                <td><img src="{{$product->getThumbnailUrl()}}" class="img-thumbnail" alt="Изображение товара" style="max-width: 100px;"></td>
                                <td><a href="{{route('products.edit', $product->id)}}" class="text-decoration-none">{{$product->name}}</a></td>
                                <td>{{$product->price}} ₽</td>
                                <td>{{$product->unit->name}}</td>
                                <td class="text-center">
                                    <input class="onSale" name="onSale" data-product-id="{{$product->id}}"
                                           @if($product->on_sale) checked @endif type="checkbox" >
                                </td>
                                <form method="post" action="{{route('products.destroy', ['product' => $product->id])}}" >
                                    @csrf
                                    @method('delete')
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm">Удалить</button>
                                    </td>
                                </form>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
