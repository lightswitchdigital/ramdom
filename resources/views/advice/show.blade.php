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

                    <form action="{{ route('advice.comment', $advice) }}" method="POST">
                        @csrf

                        @auth
                            <div class="form-group">
                                <input type="checkbox" id="anonymous" name="anonymous" class="custom-check">
                                <label for="anonymous">Анонимно</label>
                            </div>
                        @else
                            <small>Комментарий будет оставлен анонимно.</small>
                        @endauth
                        <div class="form-group">
                            <textarea placeholder="Сообщение" name="text">{{ old('text') }}</textarea>
                            @error('text')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! captcha_img('math') !!}
                            <br>
                            <label for="captcha">Решите пример с картинки</label>
                            <br>
                            <input type="text" name="captcha" id="captcha">
                            @error('captcha')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <button class="btn yellow-btn">Комментировать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
