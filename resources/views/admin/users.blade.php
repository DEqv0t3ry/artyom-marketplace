@extends('layout.layout')
@section('content')
    <div class="container py-4">
        <div class="row">
            @include('shared.success-message')
            <div class="col-1">
            </div>
            <div class="col-12">
                <div class="container mt-5">
                    <div class="d-flex justify-content-between mb-3">
                        <h2>Пользователи системы (продавцы)</h2>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">Лого</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">ИНН</th>
                            <th scope="col">Адрес</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)

                            <tr>
                                <td><img src="{{$user->shop ? $user->shop->getLogoUrl() : 'https://via.placeholder.com/150'}}" class="img-thumbnail"
                                         alt="Изображение товара" style="max-width: 100px;"></td>
                                <td><a href="{{route('users.edit', $user->id)}}" class="text-decoration-none">
                                        {{$user->shop ? $user->shop->name : $user->email}}</a></td>
                                <td>{{$user->shop ? $user->shop->inn : ''}}</td>
                                <td>{{$user->shop ? $user->shop->address : ''}}</td>
                                <td>{{$user->shop ? $user->shop->phone : ''}}</td>
                                <form method="post" action="{{route('users.destroy', $user->id)}}" >
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
