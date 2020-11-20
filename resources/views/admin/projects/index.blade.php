@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'projects'])

    <div class="my-3">
        <a href="{{ route('admin.projects.attributes.index') }}" class="btn btn-primary">Атрибуты</a>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-success">Создать</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Создан</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td><a href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a></td>
                <td>{{ $project->price }}</td>
                <td>{{ $project->created_at->format('d-m-Y') }}</td>
                <td>{{ $project->getStatus() }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
