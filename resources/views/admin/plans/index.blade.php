@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'plans'])

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Интервал</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($plans as $plan)
            <tr>
                <td>{{ $plan->id }}</td>
                <td><a href="{{ route('admin.plans.show', $plan) }}">{{ $plan->name }}</a></td>
                <td>{{ $plan->price }}</td>
                <td>{{ $plan->getInterval() }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
