@extends('layouts.app')

@section('content')
<div class="show-advice">
    <div class="container">
        <div class="card">
            <h1 class="title">{{ $advice->title }}</h1>
            <div class="img-block">
                <img src="{{ Storage::disk('public')->url($advice->image->file) }}" alt="">
            </div>
            <p class="content-text">
                {{ $advice->content }}
            </p>
        </div>
    </div>
</div>
@endsection
