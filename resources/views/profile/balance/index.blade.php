@extends('layouts.app')

@section('content')
    <div class="balance-block">
        <div class="container">
            <h1 class="title">Баланс</h1>

            <div class="card mb-4 w-50">
                <h4 class="card-header">Текущий баланс</h4>
                <div class="card-body">
                    <h3 class="balance">{{ $user->balance }} р</h3>
                    <a
                        class="btn yellow-btn"
                        href="#"
                    >Пополнить баланс</a>
                </div>
            </div>

            <div class="balance-history--wrapper">
                <h3 class="title">История баланса</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Тип</th>
                        <th>Статус</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->getType() }}</td>
                            <td>{{ $payment->getStatus() }}</td>
                            <td>{{ $payment->amount }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
