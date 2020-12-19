@extends('layouts.app')

@section('content')
    <div class="balance-block">
        <div class="container">
            <h1 class="title">Баланс</h1>
            <div class="row">
                <div class="col-md">
                    <div class="card mb-4">
                        <h4 class="card-header">Текущий баланс</h4>
                        <div class="card-body">
                            <h3 class="balance">{{ $user->balance }} р</h3>
                            <a
                            class="btn yellow-btn"
                            href="{{ route('profile.balance.add') }}"
                            >Пополнить баланс</a>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <h4 class="card-header">Текущий план</h4>
                        <div class="card-body">
                            <h3>Профессионал <span class="balance">{{ $user->subscription? $user->subscription->plan->price : '0' }} р</span></h3>
                            <a href="{{ route('profile.plans.index') }}" class="btn yellow-btn">Поменять план</a>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Статус</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($operations as $operation)
                    <tr>
                        <td>{{ $operation->id }}</td>
                        <td>{{ $operation->getStatus() }}</td>
                        <td>{{ $operation->amount }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            {{ $operations->links("pagination::bootstrap-4") }}
        </div>
    </div>
@endsection
