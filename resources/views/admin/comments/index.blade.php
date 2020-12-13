@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'comments'])

    <div class="card mb-3">
        <div class="card-header">Фильтр</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-form-label">ID</label>
                            <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="user_id" class="col-form-label">ID пользователя</label>
                            <input id="user_id" class="form-control" name="user_id" value="{{ request('user_id') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="project_id" class="col-form-label">ID совета</label>
                            <input id="project_id" class="form-control" name="project_id" value="{{ request('project_id') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="active" class="col-form-label">Активен</label>
                            <select name="active" class="form-control" id="active">
                                <option value="0" {{ request('active') == 0? 'selected' : "" }}>Нет</option>
                                <option value="1" {{ request('active') == 1? 'selected' : "" }}>Да</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="anonymous" class="col-form-label">Анонимно</label>
                            <select name="anonymous" class="form-control" id="anonymous">
                                <option value="0" {{ request('anonymous') == 0? 'selected' : "" }}>Нет</option>
                                <option value="1" {{ request('anonymous') == 1? 'selected' : "" }}>Да</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary">Найти</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Совет</th>
            <th>Активен</th>
            <th>Анонимно</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>
                    @if($comment->user)
                        <a href="{{ route('admin.users.show', $comment->user) }}">
                            {{ $comment->user->getFullName() }}
                        </a>
                    @else
                        Анонимный пользователь
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.advice.show', $comment->commentable) }}">
                        {{ $comment->commentable->title }}
                    </a>
                </td>
                <td>
                    {{ $comment->active? 'Да' : 'Нет' }}
                </td>
                <td>
                    {{ $comment->anonymous? 'Да' : 'Нет' }}
                </td>
                <td>
                    @if(!$comment->active)
                        <form action="{{ route('admin.comments.activate', $comment) }}">
                            @csrf
                            <button class="btn btn-success">Активировать</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $comments->links() }}
@endsection
