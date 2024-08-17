@extends('layout.layout')
@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header text-center bg-dark text-white">
                Редактирование пользователя
            </div>
            <div class="card-body">
                <form action="{{route('admin.users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                <label for="logo" class="form-label">Логотип компании</label>
                                <input class="form-control" type="file" id="logo" name="logo" accept=".jpg, .jpeg, .webp" max="2097152">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Наименование продавца</label>
                                <input type="text" value="{{$user->shop->name}}" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="inn" class="form-label">ИНН</label>
                                <input type="text" value="{{$user->shop->inn}}" class="form-control" id="inn" name="inn" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Адрес</label>
                                <input type="text" value="{{$user->shop->address}}" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Телефон</label>
                                <input type="tel" value="{{$user->shop->phone}}" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Почта</label>
                                <input type="email" value="{{$user->email}}" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
