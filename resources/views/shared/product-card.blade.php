<a href="{{route('products.show', $product->id)}}" class="text-decoration-none text-dark">
    <div class="card mb-3 card-hover" style="max-width: 700px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{$product->photo}}" class="img-fluid rounded-start" alt="Изображение товара">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <p class="card-text">{{$product->short_description}}</p>
                    <p class="card-text"><strong>Цена: {{$product->price}} ₽ / {{$product->unit}}</strong></p>
                </div>
            </div>
        </div>
    </div>
</a>
