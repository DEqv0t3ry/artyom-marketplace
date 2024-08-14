<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark sticky-top bg-body-tertiary"
     data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-light" href="/"><span class="fas fa-brain me-1"> </span>{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                @auth()
                    <li class="nav-item">
                        <a class="nav-link" href="">Профиль</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Товары</a>
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
                <img style="width:45px" class="me-2 avatar-sm rounded-circle"
                     src="https://static.tildacdn.com/tild6338-3666-4133-a633-643664333838/photo.jpg" alt="Luigi Avatar">
                <form action="{{route('logout')}}" method="get">
                    @csrf
                    <button class="btn btn-danger btn-small">Выход</button>
                </form>
            </div>
        @endauth
    </div>
</nav>
