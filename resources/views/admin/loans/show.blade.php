@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'loans'])
    {{--    <div class="d-flex flex-row mb-3">--}}

    {{--        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mr-1">--}}
    {{--            @csrf--}}
    {{--            @method('DELETE')--}}
    {{--            <button class="btn btn-danger">Удалить</button>--}}
    {{--        </form>--}}
    {{--    </div>--}}

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $loan->id }}</td>
        </tr>
        <tr>
            <th>Имя</th>
            <td>
                <a href="{{ route('admin.users.show', $loan->user) }}">{{ $loan->user->name }}</a>
            </td>
        </tr>
        <tr>
            <th>Сумма</th>
            <td>{{ $loan->amount }}</td>
        </tr>
        <tr>
            <th>Стоимость дома</th>
            <td>{{ $loan->building_price }}</td>
        </tr>
        <tr>
            <th>Сообщение</th>
            <td>{{ $loan->message }}</td>
        </tr>
        <tr>
            <th>Паспорт 1</th>
            <td>
                <a download href="{{ Storage::disk('public')->url($loan->passport_1 ?: $loan->user->passport_1) }}">Скачать</a>
            </td>
        </tr>
        <tr>
            <th>Паспорт 2</th>
            <td>
                <a download href="{{ Storage::disk('public')->url($loan->passport_2 ?: $loan->user->passport_2) }}">Скачать</a>
            </td>
        </tr>
        <tr>
            <th>СНИЛС</th>
            <td>
                <a download href="{{ Storage::disk('public')->url($loan->user->snils) }}">Скачать</a>
            </td>
        </tr>
        <tr>
            <th>Документы на участок</th>
            <td>
                <a download href="{{ Storage::disk('public')->url($loan->place) }}">Скачать</a>
            </td>
        </tr>
        <tr>
            <th>План дома</th>
            <td>
                <a download href="{{ Storage::disk('public')->url($loan->floor_plan) }}">Скачать</a>
            </td>
        </tr>
        <tr>
            <th>Смета</th>
            <td>
                <a download href="{{ Storage::disk('public')->url($loan->smeta) }}">Скачать</a>
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
