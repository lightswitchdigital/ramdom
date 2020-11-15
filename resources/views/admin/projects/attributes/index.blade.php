@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'projects'])

    <div class="my-3">
        <a href="{{ route('admin.projects.attributes.create') }}" class="btn btn-success">Создать</a>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Сортировка</th>
            <th>Название</th>
            <th>Тип</th>
            <th>Обязателен</th>
        </tr>
        </thead>
        <tbody>

        @forelse ($attributes as $attribute)
            <tr>
                <td>{{ $attribute->sort }}</td>
                <td>
                    <a href="{{ route('admin.projects.attributes.show', $attribute) }}">{{ $attribute->name }}</a>
                </td>
                <td>{{ $attribute->getType() }}</td>
                <td>{{ $attribute->required ? 'Yes' : '' }}</td>
            </tr>
        @empty
            <tr><td colspan="4">None</td></tr>
        @endforelse

        </tbody>
    </table>
@endsection
