@extends('layouts.app')

@section('content')
<div class="show-advice">
    <div class="container">
        <div class="card">
            <h1 class="title">{{ $advice->title }}</h1>
            <div class="img-block">
<<<<<<< HEAD
                <img src="{{ $advice->imageUrl }}">
=======
                <img src="{{ Storage::disk('public')->url($advice->image->file) }}" alt="">
>>>>>>> e55586ec00efccd06087dd1187b4229134f3c848
            </div>
            <p class="content-text">
                {{ $advice->content }}
            </p>
            <div class="comments">
                <h3 class="title">Комментарии</h3>
<<<<<<< HEAD
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
=======
                @foreach($advice->comments as $comment)
                    @if($comment->anonymous)
                        <div class="comment-item">
                            <h5 class="author">Анонимный пользователь</h5>
                            <p class="text">
                                {{ $comment->text }}
                                <span class="mutted-text created-at">{{ $comment->created_at->format('H:i d-m-Y') }}</span></p>
                        </div>
                    @else
                        <div class="comment-item">
                            <h5 class="author">{{ $comment->user->getFullName() }}</h5>
                            <p class="text">
                                {{ $comment->text }}
                                <span class="mutted-text created-at">{{ $comment->created_at->format('H:i d-m-Y') }}</span></p>
                        </div>
                    @endif
                @endforeach
>>>>>>> e55586ec00efccd06087dd1187b4229134f3c848
            </div>
        </div>
    </div>
</div>
@endsection
