<div class="card">
    @auth()
        @if($user->shop ?? false)
            <div class="card-header text-center bg-dark text-white">
                Профиль пользователя
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{$user->shop->getLogoUrl()}}" class="img-fluid rounded-circle mb-3" alt="Логотип компании" style="max-width: 150px;">
                    </div>
                    <div class="col-md-8">
                        <h4 class="card-title">{{$user->shop->name}}</h4>
                        <p class="card-text"><strong>ИНН: </strong>{{$user->shop->inn}}</p>
                        <p class="card-text"><strong>Адрес: </strong>{{$user->shop->address}}</p>
                        @if($user->shop->phone)
                            <p class="card-text"><strong>Телефон: </strong>{{$user->shop->phone}}</p>
                        @endif
                    </div>
                </div>
                @if(Auth::user()->role_id === 1)
                    <a href="{{route('admin.users.edit', $user->id)}}">
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editModal">Редактировать профиль</button>
                    </a>
                @endif
            </div>
        @else
            <div class="card-header text-center bg-dark text-white">
                Заполнение профиля
            </div>
            <div class="card-body">
                <form action="{{route('shop.store', Auth::id())}}" method="post" enctype="multipart/form-data">
                    @csrf
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
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="inn" class="form-label">ИНН</label>
                                <input type="text" class="form-control" id="inn" name="inn" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Адрес</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Телефон</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        @endif
    @endauth
</div>
