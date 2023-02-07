@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'users'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">Изменить</a>

        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mr-1">Удалить</button>
        </form>

        @if($user->passport_1 && $user->passport_2 && $user->snils && !$user->docs_verified)
            <form method="POST" action="{{ route('admin.users.verify-docs', $user) }}" class="mr-1">
                @csrf
                <button class="btn btn-success">Подтвердить документы</button>
            </form>
        @endif
    </div>

    <h3>Основные данные</h3>
    <table class="table table-bordered table-striped mt-3">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Имя</th>
            <td>{{ $user->name }}</td>
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
        @if($user->passport_1 && $user->passport_2 && $user->snils)
            <tr>
                <th>Паспорт 1</th>
                <td><a href="{{ Storage::disk('public')->url($user->passport_1) }}" download>Скачать</a></td>
            </tr>
            <tr>
                <th>Паспорт 2</th>
                <td><a href="{{ Storage::disk('public')->url($user->passport_2) }}" download>Скачать</a></td>
            </tr>
            <tr>
                <th>Снилс</th>
                <td><a href="{{ Storage::disk('public')->url($user->snils) }}" download>Скачать</a></td>
            </tr>
        @endif
        <tbody>
        </tbody>
    </table>


    <h3>Личные данные</h3>
    <table class="table table-bordered table-striped mt-4">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        @if($user->isDeveloper())
            <tr>
                <th>Название компании</th>
                <td>{{ $user->company_name }}</td>
            </tr>
            <tr>
                <th>Адрес компании</th>
                <td>{{ $user->company_address }}</td>
            </tr>
            <tr>
                <th>ИНН</th>
                <td>{{ $user->company_inn }}</td>
            </tr>
            <tr>
                <th>Расчетный счет</th>
                <td>{{ $user->company_account }}</td>
            </tr>
            <tr>
                <th>Расчетный счет</th>
                <td>{{ $user->company_account }}</td>
            </tr>
            <tr>
                <th>КПП</th>
                <td>{{ $user->company_kpp }}</td>
            </tr>
            <tr>
                <th>ОГРН</th>
                <td>{{ $user->company_ogrn }}</td>
            </tr>
            <tr>
                <th>К/С</th>
                <td>{{ $user->company_kc }}</td>
            </tr>
            <tr>
                <th>БИК</th>
                <td>{{ $user->company_bik }}</td>
            </tr>
            <tr>
                <th>Телефон компании (мессенджер)</th>
                <td>{{ $user->company_phone }}</td>
            </tr>
            <tr>
                <th>Сайт компании</th>
                <td>{{ $user->company_site }}</td>
            </tr>
            <tr>
                <th>Почта компании</th>
                <td>{{ $user->company_email }}</td>
            </tr>
        @else
            <tr>
                <th>Паспорт серия</th>
                <td>{{ $user->passport_serial }}</td>
            </tr>
            <tr>
                <th>Паспорт номер</th>
                <td>{{ $user->passport_code }}</td>
            </tr>
            <tr>
                <th>Паспорт кем выдан</th>
                <td>{{ $user->passport_issue }}</td>
            </tr>
            <tr>
                <th>Паспорт когда выдан</th>
                <td>{{ $user->passport_issue_date }}</td>
            </tr>
        @endif
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
