<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
{{-- <div class="modal fade region-modal" id="regionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Выберите регион</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush">
            @foreach(\App\Models\Region::all() as $region)
                <li class="list-group-item">
                    <a href="?region={{ $region->slug }}">{{ $region->name }}</a>
                </li>
            @endforeach
        </ul>
      </div>
    </div>
  </div>
</div> --}}
<regions-modal></regions-modal>
    <div id="app">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img alt="Рамдом" src="{{ asset('/images/logo.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <button type="button" class="region-toggle mr-auto " data-toggle="modal" data-target="#regionModal">
                        Самара
                    </button>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto mr-4">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('projects.index') }}">Проекты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('faq') }}">Вопрос-Ответ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('advice.index') }}">Советы по строительству</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Войти</a>
                            </li>
                        @else

                            <li class="nav-item dropdown">
                                <notifications></notifications>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle user-btn" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right user-settings" aria-labelledby="navbarDropdown">

                                    <a href="{{ route('profile.projects.index') }}" class="dropdown-item">Мои проекты</a>
                                    @if(Auth::user()->isDeveloper())
                                        <a href="{{ route('profile.building.index') }}" class="dropdown-item">Строительство</a>
                                    @endif
                                    <a href="{{ route('profile.balance.index') }}" class="dropdown-item">Баланс</a>
                                    <a href="{{ route('profile.plans.index') }}" class="dropdown-item">Планы</a>
                                    <a href="{{ route('profile.favorites.index') }}" class="dropdown-item">Избранное</a>
                                    <a href="{{ route('profile.discounts.index') }}" class="dropdown-item">Акции и скидки</a>
                                    <a href="{{ route('profile.settings.index') }}" class="dropdown-item">Настройки</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выйти
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 content">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>
            </div>
            @include('layouts.common.partials')

            @yield('content')
        </main>

        <footer style="background: #353535; color: #fff">
           <div class="navbar navbar-expand-lg">
                <div class="container" style="min-height: 250px">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('/images/logo-light.png') }}">
                    </a>
                    <ul class="mr-auto"></ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('projects.index') }}">Проекты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Стать партнёром</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Политика и конфиденциальность</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container" style="position: relative">
                <div class="social">
                    <ul>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-vk"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
                <a target="_blank" href="https://lightswitch.digital" class="btn btn-kink text-light" style="position: absolute; bottom: 30px; right: 30px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 106 20">
                        <path fill="#fff" d="M3.4 11.92V1H.2v14h8.2v-3.08h-5zm7.81-7.8c.98 0 1.8-.82 1.8-1.8 0-.98-.82-1.8-1.8-1.8-.98 0-1.8.82-1.8 1.8 0 .98.82 1.8 1.8 1.8zM9.71 15h3V5h-3v10zM22.244 5v1.02c-.66-.82-1.62-1.3-2.92-1.3-2.84 0-4.92 2.32-4.92 5.08 0 2.76 2.08 5.08 4.92 5.08 1.3 0 2.26-.48 2.92-1.3v.92c0 1.42-.86 2.14-2.26 2.14-1.32 0-1.9-.56-2.28-1.26l-2.56 1.48c.92 1.64 2.66 2.42 4.74 2.42 2.66 0 5.28-1.42 5.28-4.78V5h-2.92zm-2.42 7.12c-1.42 0-2.42-.94-2.42-2.32s1-2.32 2.42-2.32 2.42.94 2.42 2.32-1 2.32-2.42 2.32zm13.4-7.4c-1.32 0-2.32.48-2.86 1.22V1h-3v14h3V9.54c0-1.42.76-2.06 1.86-2.06.96 0 1.74.58 1.74 1.82V15h3V8.86c0-2.7-1.72-4.14-3.74-4.14zm11.66 3.16V5h-2.06V2.2l-3 .9V5h-1.6v2.88h1.6v3.54c0 2.8 1.14 3.98 5.06 3.58v-2.72c-1.32.08-2.06 0-2.06-.86V7.88h2.06zm6.7 7.4c3.04 0 5.2-1.6 5.2-4.3 0-2.96-2.38-3.7-4.5-4.34-2.18-.66-2.52-1.1-2.52-1.74 0-.56.5-1.06 1.5-1.06 1.28 0 1.94.62 2.42 1.62l2.7-1.58c-1.02-2.06-2.82-3.16-5.12-3.16-2.42 0-4.7 1.56-4.7 4.26 0 2.68 2.04 3.68 4.12 4.26 2.1.58 2.9.92 2.9 1.78 0 .54-.38 1.14-1.9 1.14-1.58 0-2.44-.78-2.94-1.94l-2.76 1.6c.78 2.06 2.66 3.46 5.6 3.46zM68.892 5l-1.44 5.36L65.893 5h-2.8l-1.56 5.36L60.093 5h-3.2l3.2 10h2.8l1.6-5.34 1.6 5.34h2.8l3.2-10h-3.2zm5.89-.88c.98 0 1.8-.82 1.8-1.8 0-.98-.82-1.8-1.8-1.8-.98 0-1.8.82-1.8 1.8 0 .98.82 1.8 1.8 1.8zM73.284 15h3V5h-3v10zM84.34 7.88V5h-2.06V2.2l-3 .9V5h-1.6v2.88h1.6v3.54c0 2.8 1.14 3.98 5.06 3.58v-2.72c-1.32.08-2.06 0-2.06-.86V7.88h2.06zm6.303 7.4c1.96 0 3.66-1.02 4.52-2.58l-2.62-1.5c-.32.7-1.06 1.12-1.94 1.12-1.3 0-2.26-.94-2.26-2.32s.96-2.32 2.26-2.32c.88 0 1.6.42 1.94 1.12l2.62-1.52c-.86-1.54-2.58-2.56-4.52-2.56-3.04 0-5.3 2.3-5.3 5.28 0 2.98 2.26 5.28 5.3 5.28zM102.23 4.72c-1.32 0-2.32.48-2.86 1.22V1h-3v14h3V9.54c0-1.42.76-2.06 1.86-2.06.96 0 1.74.58 1.74 1.82V15h3V8.86c0-2.7-1.72-4.14-3.74-4.14z"/>
                    </svg>
                </a>
            </div>

        </footer>
    </div>
</body>
</html>
