<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="@yield('meta-desc', 'Первый в России сервис с возможностью рассчёта стоимости домов и коттеджей, подбором строительных компаний для для постройки дома. Сайт позволяет быстро и просто составлять сметы на деревянные дома (каркасные, из бруса, бревенчатые), дома из СИП-панелей, кирпичные дома (в том числе из газо- и пенобетона). Можно задать все основные параметры дома, редактировать прайс-лист, а также формировать несколько видов смет (например, чтобы предоставить клиенту). Программа позволяет быстро и довольно точно посчитать стоимость предстоящего строительства, в том числе материалы, работы, транспортные расходы (доставка, разгрузка), стоимость спецтехники, и даже непредвиденные затраты.')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta-title', 'ИПК РБК')</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/svg">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.rawgit.com/enyo/dropzone/master/dist/dropzone.css">
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="modal fade region-modal" id="regionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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
                    {{--                       @foreach($regions_list as $region)--}}
                    {{--                           <li class="list-group-item">--}}
                    {{--                               <a href="?region={{ $region->slug }}">{{ $region->name }}</a>--}}
                    {{--                           </li>--}}
                    {{--                       @endforeach--}}
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img title="ИПК РБК" alt="РБК" src="{{ asset('/images/logo.svg') }}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                {{--                    <button type="button" class="region-toggle mr-auto " data-toggle="modal" data-target="#regionModal">--}}
                {{--                        {{ $current_region_name }}--}}
                {{--                    </button>--}}
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto mr-4">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="/">Калькулятор</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faq') }}">Вопросы/ответы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('advice.index') }}">Наши услуги</a>
                    </li>
                    {{--                        <li class="nav-item">--}}
                    {{--                            <a class="nav-link" href="{{ route('discounts') }}">Акции и скидки</a>--}}
                    {{--                        </li>--}}
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Войти</a>
                        </li>
                    @else
                        <li class="nav-item dropdown notification">
                            <notifications></notifications>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle user-btn" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right user-settings"
                                 aria-labelledby="navbarDropdown">

                                <a href="{{ route('profile.index') }}" class="dropdown-item">Личный кабинет</a>
                                {{--                                    <a href="{{ route('profile.balance.index') }}" class="dropdown-item">Баланс</a>--}}
                                {{--                                    <a href="{{ route('profile.settings.index') }}" class="dropdown-item">Настройки</a>--}}

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
{{--            <div class="container">--}}
{{--                <nav aria-label="breadcrumb">--}}
{{--                    <ol class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                        <li class="breadcrumb-item"><a href="#">Library</a></li>--}}
{{--                        <li class="breadcrumb-item active" aria-current="page">Data</li>--}}
            {{--                    </ol>--}}
            {{--                </nav>--}}
            {{--            </div>--}}
            @include('layouts.common.partials')

            @yield('content')
        </main>

    <footer>
        <div class="footer-wrapper">
            <div class="sigma_footer-middle" id="contacts">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="sigma_footer-widget">
                                <div class="sigma_footer-logo mb-4">
                                    <span style="font-size: large; color:#fff;">ИНВЕСТИЦИОННЫЙ ПОТРЕБИТЕЛЬСКИЙ КООПЕРАТИВ "РБК"</span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="sigma_footer-widget">
                                <h5 class="widget-title mb-0">Наши контакты</h5>
                                <p class="mb-0"><a href="mailto:admin@rbc.work">{{ $settings['footer_email'] }}</a></p>
                                <br>
                                <div class="social-connect ">
                                    <h6>Мы в социальных сетях</h6>
                                    <div class="social justify-content-start p-0">
                                        <ul class="sigma_social-icons justify-content-start">
                                            <li style="margin-left: 0"><a target="_blank"
                                                                          href="{{ $settings['footer_vk'] }}"><i
                                                        class="fab fa-vk"></i></a></li>
                                            <li><a target="_blank" href="{{ $settings['footer_fb'] }}"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                            <li><a target="_blank" href="{{ $settings['footer_ok'] }}"><i
                                                        class="fab fa-odnoklassniki"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="sigma_footer-widget">
                                <p class="widget-title">Не является публичной офертой</p>
                                <p class="mb-0">ИНН 5024206190</p>
                                <p class="mt-3 mb-0"></p>
                                <p class="mt-3 mb-0">ОГРН 1205000063487</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="sigma_footer-widget">
                                <div class="sigma-call mt-4">
                                    <span>Для звонков по России</span>
                                    <span>звоните в рабочее время МСК</span>
                                    <a href="tel:{{ $settings['footer_phone'] }}" style="color: #fff; font-size: 24px">
                                        <h5>{{ $settings['footer_phone'] }}</h5></a>
                                    <div class="social justify-content-start p-0">
                                        <ul class="sigma_social-icons justify-content-start">
                                            <li style="margin-left: 0"><a target="_blank"
                                                                          href="{{ $settings['footer_viber'] }}"><i
                                                        class="fab fa-viber"></i></a></li>
                                            <li><a target="_blank" href="{{ $settings['footer_wa'] }}"><i
                                                        class="fab fa-whatsapp"></i></a></li>
                                            <li><a target="_blank" href="{{ $settings['footer_tg'] }}"><i
                                                        class="fab fa-telegram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments)
        };
        m[i].l = 1 * new Date();
        for (var j = 0; j < document.scripts.length; j++) {
            if (document.scripts[j].src === r) {
                return;
            }
        }
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(91864807, "init", {
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true,
        webvisor: true
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/91864807" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
