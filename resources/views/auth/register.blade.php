@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6">
                <form class="form mt-5" action="{{route('register')}}" method="post">
                    @csrf
                    <h3 class="text-center text-dark">Регистрация</h3>
                    @include('shared.success-message')
                    <div class="form-group mt-3">
                        <label for="email" class="text-dark">Email:</label><br>
                        <input type="email" name="email" id="email" class="form-control">
                        @error('email')
                        <span class="fs-6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="password" class="text-dark">Пароль:</label><br>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                        <span class="fs-6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="confirm-password" class="text-dark">Повтор пароля:</label><br>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        @error('password_confirmation')
                        <span class="fs-6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="remember-me" class="text-dark"></label><br>
                        <input type="submit" name="submit" class="btn btn-dark btn-md" value="Зарегистрироваться">
                    </div>
                    <div class="text-right mt-2">
                        <a href="/login" class="text-dark">Уже есть аккаунт? Войти здесь</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
