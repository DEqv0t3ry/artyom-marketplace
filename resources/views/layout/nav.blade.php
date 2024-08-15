<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark sticky-top bg-body-tertiary"
     data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-light" href=
            @guest "/" @endguest @auth "{{route('users.show', Auth::id())}}" @endauth><span class="fas fa-brain me-1"> </span>{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                @auth()
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users.show', Auth::id())}}">Профиль</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.products.show', Auth::id())}}">Товары</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Заявки</a>
                    </li>
                @endauth
            </ul>
        </div>
        @guest
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('login')}}">Вход</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">Регистрация</a>
                </li>
            </ul>
        @endguest
        @auth()
            <div class="d-flex align-items-center">
                @if(Auth::user()->shop)
                    <img style="width:45px" class="me-2 avatar-sm rounded-circle"
                         src="{{Auth::user()->shop->getLogoUrl()}}" alt="Luigi Avatar">
                @endif
                <form action="{{route('logout')}}" method="get">
                    @csrf
                    <button class="btn btn-danger btn-small">Выход</button>
                </form>
            </div>
        @endauth
    </div>
</nav>
