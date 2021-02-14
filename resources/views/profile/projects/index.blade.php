@extends('layouts.app')

@section('content')
    <div class="favorites-block">

        <div class="container">
            <h1 class="title mb-5">Мои проекты</h1>
            <my-projects :projects-link="'{{ route('profile.projects.get-projects') }}'"></my-projects>
        </div>
    </div>
@endsection
