<div class="card">
    <div class="row g-0">
        <div class="col-md-4">
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @forelse($product->photos as $photo)
                        <div class="carousel-item active">
                            <img src="{{$photo->getPhotoUrl()}}" class="d-block w-100" alt="Фото 1">
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <img src="https://www.vilakovilje.rs/wp-content/uploads/2017/02/placeholder.jpg" class="d-block w-100" alt="Фото не обнаружено">
                        </div>
                    @endforelse
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$product->name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Цена: {{$product->price}} ₽ / {{$product->unit->name}}</h6>
                <p class="card-text">{{$product->main_description}}</p>
                <div class="d-flex align-items-center">
                    <img src="{{$product->user->shop->logo}}" alt="Логотип продавца" class="img-fluid me-3" style="max-width: 50px;">
                    <div>
                        <h6 class="mb-0">{{$product->user->shop->name}}</h6>
                        <p class="mb-0">Телефон: {{$product->user->shop->phone}}</p>
                        <p class="mb-0">Почта: {{$product->user->email}}</p>
                    </div>
                </div>
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#buyModal">Оставить заявку</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyModalLabel">Оформление заказа</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('orders.store', $product->id)}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя</label>
                        <input value="{{old('name')}}" name="name" type="text" class="form-control" id="name" required>
                        @error('name')
                        <span class="fs-6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Электронная почта</label>
                        <input value="{{old('email')}}" name="email" type="email" class="form-control" id="email" required>
                        @error('email')
                        <span class="fs-6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Номер телефона</label>
                        <input value="{{old('phone')}}" name="phone" type="tel" class="form-control" id="phone">
                        @error('phone')
                        <span class="fs-6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="count" class="form-label">Количество</label>
                        <input name="count" type="number" class="form-control" id="count" value="{{old('count')}}" min="1" required>
                        @error('count')
                        <span class="fs-6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Купить</button>
                </form>
            </div>
        </div>
    </div>
</div>
