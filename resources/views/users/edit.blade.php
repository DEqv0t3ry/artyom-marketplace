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
                                @if($user->shop)
                                    @if($user->shop->logo)
                                        <div id="logo-{{$user->shop->id}}-delete" class="mb-2">
                                            <img src="{{$user->shop->getLogoUrl()}}" class="img-thumbnail"
                                                 alt="Изображение товара" style="max-width: 200px;">
                                            <div>
                                                <button  type="button"
                                                         onclick="deleteLogo({{$user->shop->id}})"
                                                         class="btn btn-danger">Удалить фото</button>
                                            </div>
                                        </div>
                                        <input style="display: none" class="form-control mt-3" type="file" id="logo-{{$user->shop->id}}-add" name="logo" accept=".jpg, .jpeg, .webp">
                                    @else
                                        <input class="form-control mt-3" type="file" id="logo" name="logo" accept=".jpg, .jpeg, .webp">
                                    @endif
                                @else
                                    <input class="form-control mt-3" type="file" id="logo" name="logo" accept=".jpg, .jpeg, .webp">
                                @endif
                                @error('logo')
                                <span class="fs-6 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Наименование продавца</label>
                                <input type="text" value="{{$user->shop ? old('name') ? old('name') : $user->shop->name : old('name')}}"
                                       class="form-control" id="name" name="name" required>
                                @error('name')
                                <span class="fs-6 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inn" class="form-label">ИНН</label>
                                <input type="text" value="{{$user->shop ? old('inn') ? old('inn') : $user->shop->inn : old('inn')}}"
                                       class="form-control" id="inn" name="inn" required>
                                @error('inn')
                                <span class="fs-6 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Адрес</label>
                                <input type="text" value="{{$user->shop ? old('address') ? old('address') : $user->shop->address : old('address')}}"
                                       class="form-control" id="address" name="address" required>
                                @error('address')
                                <span class="fs-6 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Телефон</label>
                                <input type="tel" value="{{$user->shop ?  old('phone') ? old('phone') : $user->shop->phone : old('phone')}}"
                                       class="form-control" id="phone" name="phone">
                                @error('phone')
                                <span class="fs-6 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Почта</label>
                                <input type="email" value="{{old('email') ? old('email') :  $user->email}}"
                                       class="form-control" id="email" name="email">
                                @error('email')
                                <span class="fs-6 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                <span class="fs-6 text-danger">{{ $message }}</span>
                                @enderror
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
