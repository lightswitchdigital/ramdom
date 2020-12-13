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
<div class="modal fade region-modal" id="regionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>
    <div id="app">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('/images/logo.png') }}">
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
                                <a id="navbarDropdownMessage" 
                                class="nav-link dropdown-toggle" 
                                href="#" role="button" 
                                data-toggle="dropdown" 
                                aria-haspopup="true" 
                                aria-expanded="false">
                                    <i class="fas fa-bell"></i>
                                </a>
                                <messages></messages>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

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

            @include('layouts.common.partials')

            @yield('content')
        </main>

        <footer style="background: #353535; color: #fff;">
           <div class="navbar navbar-expand-lg">
                <div class="container">
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
            <div class="container">
                <div class="social">
                    <ul>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-vk"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>

        </footer>
    </div>
</body>
</html>
