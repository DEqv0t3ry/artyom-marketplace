@extends('layout.layout')
@section('content')
    <div class="container py-4">
        <div class="row">
            @include('shared.success-message')
            <div class="col-2">
            </div>
            <div class="col-9">
                <div class="container mt-5">
                    <div class="d-flex justify-content-between mb-3">
                        <h2>Заявки</h2>
                        <div>
                            <label for="sort" class="form-label me-2">Сортировать:</label>
                            <form action="{{route('orders.index', $user->id)}}" method="get">
                                <select value="{{ request('sort', '') }}" name="sort"
                                        class="form-select d-inline-block w-auto" id="sort" name="sort">
                                    <option @if(request('sort') == 'date') selected @endif value="date">По дате</option>
                                    <option @if(request('sort') == 'unprocessed') selected @endif value="unprocessed">По необработанным</option>
                                </select>
                                <button type="submit" class="btn btn-dark">Сортировать</button>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">Название товара</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Имя заказчика</th>
                            <th scope="col">Телефон заказчика</th>
                            <th scope="col">Почта заказчика</th>
                            <th scope="col">Дата заказа</th>
                            <th scope="col">Обработано</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{$order->product->name}}</td>
                                    <td>{{$order->count}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->email}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td class="text-center">
                                        <input class="processed" name="processed" data-order-id="{{$order->id}}"
                                               @if($order->processed) checked @endif type="checkbox">
                                    </td>
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
