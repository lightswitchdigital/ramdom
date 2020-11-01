@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'projects'])

    <div class="my-4">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-success">Создать</a>
    </div>
@endsection
