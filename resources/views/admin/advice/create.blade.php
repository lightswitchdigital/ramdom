@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'advice'])

    <form method="POST" action="{{ route('admin.advice.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">Название</label>
            <input id="name" class="form-control @error('title') is-invalid @enderror" name="title"
                   value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="content" class="col-form-label">Текст</label>
            <textarea id="content" class="form-control @error('content') is-invalid @enderror texteditor"
                      name="content">{{ old('content') }}</textarea>
            @error('content')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="image" class="col-form-label">Картинка</label>
            <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">
            @error('image')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
        </div>
    </form>
@endsection
