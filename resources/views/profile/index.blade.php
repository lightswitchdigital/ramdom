@extends('layouts.app')

@section('content')
<div class="profile-block">
    <div class="container">
        <h1 class="title">Личный кабинет</h1>
        <div class="row">
            <div class="col-md-4">
                <ul class="menu">
                    <li>
                        <a href="#"><img src="/images/presets/shopping-bag.png"> Мои проекты</a>
                    </li>
                    <li>
                        <a href="#"><img src="/images/presets/heart.png">Понравившиеся проекты</a>
                    </li>
                    <li>
                        <a href="#"><img src="/images/presets/technics.png">Строительство</a>
                    </li>
                    <li>
                        <a href="#"><img src="/images/presets/price-tag.png">Акции и скидки</a>
                    </li>
                    <li>
                        <a href="#"><img src="/images/presets/settings.png">Настройки</a>
                    </li>
                    <li>
                        <a href="#"><img src="/images/presets/logout.png">Выйти</a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <div class="profile-info">
                    <div class="img">
                     <img src="/images/boss.png">   
                    </div>
                    <div class="info">
                        <h1>Имя</h1>
                        <h1>Фамилия</h1>
                        <p>www.ctroitel.com</p>
                        <p>г. Самара ул. Ново-Садовая 12</p>
                        <p>8 846 123 45 67</p>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
    
@endsection