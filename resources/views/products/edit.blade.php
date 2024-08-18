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
                            Изменение информации о товаре
                        </div>
                        <div class="card-body">
                            <form action="{{route('products.update', $product->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Наименование товара</label>
                                    <input type="text" value="{{old('name') ? old('name') : $product->name}}" class="form-control" id="name" name="name" required>
                                    @error('name')
                                    <span class="fs-6 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="price" class="form-label">Цена</label>
                                        <input type="number" value="{{old('price') ? old('price') : $product->price}}"
                                               class="form-control" id="price" name="price" required>
                                        @error('price')
                                        <span class="fs-6 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="unit" class="form-label">Единица измерения</label>
                                        <select class="form-select" id="unit" name="unit">
                                            @forelse(\App\Models\Unit::all() as $unit)
                                                <option @if($product->unit_id == $unit->id) selected @endif value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('unit')
                                        <span class="fs-6 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Краткое описание (анонс)</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="2" required>{{$product->short_description}}</textarea>
                                    @error('short_description')
                                    <span class="fs-6 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Основное описание</label>
                                    <textarea class="form-control" id="main_description" name="main_description" rows="5" required>{{$product->main_description}}</textarea>
                                    @error('main_description')
                                    <span class="fs-6 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <hr>
                                    <label for="thumbnail" class="form-label">Фотография-анонс</label>
                                    @if($product->photo)
                                        <div id="product-photo-hide" class="mb-2">
                                            <img src="{{$product->getThumbnailUrl()}}" class="img-thumbnail"
                                                 alt="Изображение товара" style="max-width: 200px;">
                                            <div>
                                                <button  type="button"
                                                         onclick="deletePhoto({{$product->id}})"
                                                         class="btn btn-danger">Удалить фото</button>
                                            </div>
                                        </div>
                                        <input style="display: none" class="form-control mt-3" type="file" id="product-photo-show" name="photo" accept=".jpg, .jpeg, .webp">
                                    @else
                                        <input class="form-control mt-3" type="file" id="photo" name="photo" accept=".jpg, .jpeg, .webp">
                                    @endif
                                    @error('photo')
                                    <span class="fs-6 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <hr>
                                    <label class="form-label">Основные фотографии (до 3 штук)</label>
                                    @forelse($product->photos as $photo)
                                        <div id="product-photo-{{$photo->id}}-delete" class="mb-2">
                                            <img  src="{{$photo->getPhotoUrl()}}" class="img-thumbnail"
                                                  alt="Изображение товара" style="max-width: 200px;">
                                            <div>
                                                <button  type="button"
                                                         onclick="deleteImages({{$photo->id}})"
                                                         class="btn btn-danger">Удалить фото</button>
                                            </div>
                                        </div>
                                        <input id="product-photo-{{$photo->id}}-add" style="display: none" class="form-control mt-3 mb-3" type="file" name="images[]" accept=".jpg, .jpeg, .webp">
                                    @empty
                                        <input class="form-control mt-3 mb-3" type="file" name="images[]" accept=".jpg, .jpeg, .webp">
                                        <input class="form-control mt-3 mb-3" type="file" name="images[]" accept=".jpg, .jpeg, .webp">
                                        <input class="form-control mt-3 mb-3" type="file" name="images[]" accept=".jpg, .jpeg, .webp">
                                    @endforelse
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
