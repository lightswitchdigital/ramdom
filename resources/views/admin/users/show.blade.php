@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'users'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">Изменить</a>

        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
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

    {{--    <div class="card">--}}
    {{--        <div class="card-header">--}}
    {{--            Пополнения баланса--}}
    {{--        </div>--}}
    {{--        <div class="card-body">--}}
    {{--            <table class="table table-bordered table-striped">--}}
    {{--                <thead>--}}
    {{--                <tr>--}}
    {{--                    <th>ID</th>--}}
    {{--                    <th>Сумма</th>--}}
    {{--                    <th>Статус</th>--}}
    {{--                    <th></th>--}}
    {{--                </tr>--}}
    {{--                </thead>--}}
    {{--                <tbody>--}}

    {{--                @foreach ($payments as $payment)--}}
    {{--                    <tr>--}}
    {{--                        <td>{{ $payment->id }}</td>--}}
    {{--                        <td>{{ $payment->amount }}</td>--}}
    {{--                        <td>{{ $payment->getStatus() }}</td>--}}
    {{--                        <td>--}}
    {{--                            <form action="" method="POST">--}}
    {{--                                @csrf--}}
    {{--                                <button class="btn btn-success">Подтвердить</button>--}}
    {{--                            </form>--}}
    {{--                        </td>--}}
    {{--                    </tr>--}}
    {{--                @endforeach--}}

    {{--                </tbody>--}}
    {{--            </table>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
