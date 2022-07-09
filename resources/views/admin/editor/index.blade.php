@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'editor'])

    <div class="my-3">
        <a href="{{ route('admin.editor.attributes.index') }}" class="btn btn-primary">Атрибуты</a>
    </div>
@endsection
