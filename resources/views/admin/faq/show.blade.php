@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'faq'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.faq.edit', $faq) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.faq.destroy', $faq) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $faq->id }}</td>
        </tr>
        <tr>
            <th>Вопрос</th><td>{{ $faq->question }}</td>
        </tr>
        <tr>
            <th>Ответ</th><td>{{ $faq->answer }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
