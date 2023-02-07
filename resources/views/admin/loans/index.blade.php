@extends('layouts.admin')

@section('content')
    @include('layouts.common.partials')

    @include('admin._nav', ['route' => 'loans'])

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Сумма</th>
            <th>Сообщение</th>
            <th>Создано</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($loans as $loan)
            <tr>
                <td><a href="{{ route('admin.loans.show', $loan) }}">{{ $loan->id }}</a></td>
                <td><a href="{{ route('admin.users.show', $loan->user) }}">{{ $loan->user->name }}</a></td>
                <td>{{ $loan->amount }}</td>
                <td>{{ $loan->text }}</td>
                <td>{{ $loan->created_at?->format('d-m-Y') }}</td>
                <td>{{ $loan->getStatus() }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
