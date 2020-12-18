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
                            class="btn"
                            href="balance/add"
                            >Пополнить баланс</a>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <h4 class="card-header">Текущий план</h4>
                        <div class="card-body">
                            <h3 class="balance">Профессионал</h3>
                            <h3 class="balance">{{ $user->subscription? $user->subscription->plan->price : '0' }} р</h3>
                            <a href="{{ route('profile.plans.index') }}" class="btn">Поменять план</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
