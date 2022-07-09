@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'advice'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.advice.edit', $advice) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.advice.destroy', $advice) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $advice->id }}</td>
        </tr>
        <tr>
            <th>Название</th><td>{{ $advice->title }}</td>
        </tr>
        <tr>
            <th>Текст</th><td>{{ $advice->content }}</td>
        </tr>
        <tr>
            <th>Картинка</th>
            <td>
                <img width="350px" src="{{ Storage::disk('public')->url($advice->image->file) }}" alt="">
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
