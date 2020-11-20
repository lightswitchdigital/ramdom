@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'projects'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $project->id }}</td>
        </tr>
        <tr>
            <th>Название</th><td>{{ $project->title }}</td>
        </tr>
        <tr>
            <th>Slug</th><td>{{ $project->slug }}</td>
        </tr>
        <tr>
            <th>Стартовая цена</th><td>{{ $project->price }}</td>
        </tr>
        <tr>
            <th>Статус</th><td>{{ $project->getStatus() }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        @foreach ($attributes as $attribute)
            <tr>
                <th>{{ $attribute->name }}</th>
                <td>{{ $project->getValue($attribute->id) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
