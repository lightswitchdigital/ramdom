@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'users'])

    <div class="my-4">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">Создать</a>
    </div>


@endsection
