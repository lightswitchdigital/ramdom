@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'plans'])

    <div class="my-3">
        <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-primary">Редактировать</a>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $plan->id }}</td>
        </tr>
        <tr>
            <th>Название</th><td>{{ $plan->name }}</td>
        </tr>
        <tr>
            <th>Цена</th><td>{{ $plan->price }}</td>
        </tr>
        <tr>
            <th>Интервал</th><td>{{ $plan->getInterval() }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>

    <br>

    <h4>Пользователи, купившие эту подписку</h4>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Активна</th>
            <th>Начинается</th>
            <th>Заканчивается</th>
            <th>Отменена</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($subscriptions as $subscription)
            <tr>
                <td>
                    <a href="{{ route('admin.users.show', $subscription->user) }}">
                        {{ $subscription->user->getFullName() }}
                    </a>
                </td>
                <td>
                    {{ $subscription->active? 'Да' : 'Нет' }}
                </td>
                <td>
                    {{ $subscription->starts_at->format('d-m-Y') }}
                </td>
                <td>
                    {{ $subscription->ends_at->format('d-m-Y') }}
                </td>
                <td>
                    {{ $subscription->canceled_at? $subscription->canceled_at->format('d-m-Y') : '' }}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $subscriptions->links() }}
@endsection
