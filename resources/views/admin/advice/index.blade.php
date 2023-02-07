@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'advice'])

    <div class="my-3">
        <a href="{{ route('admin.advice.create') }}" class="btn btn-success">Добавить</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Текст</th>
            <th>Добавлен</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($advice as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="{{ route('admin.advice.show', $item) }}">{{ $item->title }}</a></td>
                <td>{!! $item->content !!}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
