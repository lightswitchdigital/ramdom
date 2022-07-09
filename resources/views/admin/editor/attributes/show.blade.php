@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'editor'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.editor.attributes.edit', $attribute) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.editor.attributes.destroy', $attribute) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $attribute->id }}</td>
        </tr>
        <tr>
            <th>Название</th><td>{{ $attribute->name }}</td>
        </tr>
        <tr>
            <th>Тип</th><td>{{ $attribute->getType() }}</td>
        </tr>
        <tr>
            <th>Варианты</th><td>{!! implode("<br>", $attribute->variants) !!}</td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
