@extends('layouts.app')

@section('content')
<div class="show-advice">
    <div class="container">
        <div class="card">
            <h1 class="title">{{ $advice->title }}</h1>
            <div class="img-block">
                <img src="{{ Storage::disk('public')->url($advice->image->file) }}" alt="">
            </div>
            <p class="content-text">
                {{ $advice->content }}
            </p>
            <div class="comments">
                <h3 class="title">Комментарии</h3>
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
