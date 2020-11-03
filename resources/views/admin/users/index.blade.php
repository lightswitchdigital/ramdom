@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'users'])

    <div class="my-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success mr-2">Добавить пользователя</a>
    </div>

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
                            <label for="name" class="col-form-label">Имя</label>
                            <input id="name" class="form-control" name="name" value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="last_name" class="col-form-label">Фамилия</label>
                            <input id="last_name" class="form-control" name="last_name" value="{{ request('last_name') }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email" class="col-form-label">Эл. почта</label>
                            <input id="email" class="form-control" name="email" value="{{ request('email') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="status" class="col-form-label">Статус</label>
                            <select id="status" class="form-control" name="status">
                                <option value=""></option>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}"{{ $value === request('status') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="role" class="col-form-label">Роль</label>
                            <select id="role" class="form-control" name="role">
                                <option value=""></option>
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}"{{ $value === request('role') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
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
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Эл. почта</th>
            <th>Статус</th>
            <th>Роль</th>
            <th>Тип</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->getStatus() }}</td>
                <td>{{ $user->getRole() }}</td>
                <td>{{ $user->getType() }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $users->links() }}

@endsection
