@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'users'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">Изменить</a>

{{--        @if ($user->isWait())--}}
{{--            <form method="POST" action="{{ route('admin.users.verify', $user) }}" class="mr-1">--}}
{{--                @csrf--}}
{{--                <button class="btn btn-success">Подтвердить</button>--}}
{{--            </form>--}}
{{--        @endif--}}

        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <div class="d-flex flex-row mb-3">
{{--        <a href="{{ route('admin.users.balance.show', $user) }}" class="btn btn-secondary mr-1">Баланс</a>--}}
{{--        <a href="{{ route('admin.users.deposits.show', $user) }}" class="btn btn-secondary mr-1">Депозиты</a>--}}
{{--        <a href="{{ route('admin.users.referrals.show', $user) }}" class="btn btn-secondary mr-1">Партнеры</a>--}}
{{--        <a href="{{ route('admin.users.documents.show', $user) }}" class="btn btn-secondary mr-1">Документы</a>--}}
{{--        <a href="{{ route('admin.users.payments.show', $user) }}" class="btn btn-secondary mr-1">Платежи</a>--}}
{{--        <a href="{{ route('admin.users.activity.show', $user) }}" class="btn btn-secondary mr-1">История активности</a>--}}
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Имя</th><td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Фамилия</th><td>{{ $user->last_name }}</td>
        </tr>
        <tr>
            <th>Отчество</th><td>{{ $user->middle_name }}</td>
        </tr>
        <tr>
            <th>Эл. почта</th><td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Телефон</th><td>{{ $user->phone }}</td>
        </tr>
        <tr>
            <th>Статус</th>
            <td>{{ $user->getStatus() }}</td>
        </tr>
        <tr>
            <th>Роль</th>
            <td>{{ $user->getRole() }}</td>
        </tr>
        <tr>
            <th>Тип</th>
            <td>{{ $user->getType() }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
