@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'faq'])

    <div class="my-3">
        <a href="{{ route('admin.faq.create') }}" class="btn btn-success">Добавить</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Вопрос</th>
            <th>Ответ</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($faq as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="{{ route('admin.faq.show', $item) }}">{{ $item->question }}</a></td>
                <td>{{ $item->answer }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
