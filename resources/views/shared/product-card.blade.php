<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2"
                     src="{{$product->image}}" alt="Mario Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="">{{$product->name}}</a></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
            <p class="fs-6 fw-light text-muted">
                {{$product->short_description}}
            </p>
        <div class="d-flex justify-content-between">
            <div>
                <span class="fs-6 fw-light text-muted">
                    <span class="fas fa-rouble"> </span>
                    {{$product->price}} </span>
            </div>
        </div>
    </div>
</div>
