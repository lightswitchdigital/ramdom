@extends('layouts.app')

@section('content')
<div class="show-advice">
    <div class="container">
        <div class="card">
            <h1 class="title">{{ $advice->title }}</h1>
            <div class="img-block">
                <img src="{{ $advice->imageUrl }}">
            </div>
            <p class="content-text">
                {{ $advice->content }}
            </p>
            <div class="comments">
                <h3 class="title">Комментарии</h3>
                <div class="comment-item">
                    <h5 class="author">Матвей</h5>
                    <p class="text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quidem, similique mollitia nulla soluta deleniti, illum nesciunt vero quod ab impedit a. Quaerat veritatis placeat deserunt similique unde esse iste.    
                        <span class="mutted-text created-at">12:08 2021</span></p>
                </div>
                <div class="comment-item">
                    <h5 class="author">Матвей</h5>
                    <p class="text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quidem, similique mollitia nulla soluta deleniti, illum nesciunt vero quod ab impedit a. Quaerat veritatis placeat deserunt similique unde esse iste.    
                        <span class="mutted-text created-at">12:08 2021</span></p>
                </div>
                <div class="add-comments">
                    <h4>Добавить комментарий</h4>
                    <input type="checkbox" id="anonym" class="custom-check">
                    <label for="anonym">Анонимно</label>
                    <textarea placeholder="Сообщение"></textarea>
                    <button class="btn yellow-btn">Комментировать</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
