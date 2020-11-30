@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'payments'])

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $payment->id }}</td>
        </tr>
        <tr>
            <th>Сумма</th><td>{{ $payment->amount }}</td>
        </tr>
        <tr>
            <th>Статус</th>
            <td>{{ $payment->getStatus() }}</td>
        </tr>
        <tr>
            <th>Шлюз</th>
            <td>{{ $payment->getGateway() }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
