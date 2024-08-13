@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
            @include('shared.success-message')
            <hr>
            <div class="mt-3">
                <div class="mt-3">
                    @include('shared.product-card')
                    <button class="btn btn-dark mt-3">Оставить заявку</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
        </div>
    </div>
@endsection
