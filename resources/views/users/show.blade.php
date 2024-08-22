@extends('layout.layout')
@section('content')
    <div class="container py-4">
        <div class="row">
            @include('shared.success-message')
            <div class="col-3">
            </div>
            <div class="col-6">
                @include('shared.user-card')
            </div>
        </div>
    </div>
@endsection
