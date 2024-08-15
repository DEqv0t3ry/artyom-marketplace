@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-9">
            <div class="mt-3">
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-header text-center bg-dark text-white">
                            Добавление нового товара
                        </div>
                        <div class="card-body">
                            <form action="{{route('products.store', $user->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Наименование товара</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="price" class="form-label">Цена</label>
                                        <input type="number" class="form-control" id="price" name="price" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="unit" class="form-label">Единица измерения</label>
                                        <select class="form-select" id="unit" name="unit">
                                            @forelse(\App\Models\Unit::all() as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Краткое описание (анонс)</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="2" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Основное описание</label>
                                    <textarea class="form-control" id="main_description" name="main_description" rows="5" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Фотография-анонс</label>
                                    <input class="form-control" type="file" id="photo" name="photo" accept=".jpg, .jpeg, .webp">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Основные фотографии (до 3 штук)</label>
                                    <input class="form-control mb-2" type="file" name="images[]" accept=".jpg, .jpeg, .webp">
                                    <input class="form-control mb-2" type="file" name="images[]" accept=".jpg, .jpeg, .webp">
                                    <input class="form-control mb-2" type="file" name="images[]" accept=".jpg, .jpeg, .webp">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
