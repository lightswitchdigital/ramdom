@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'faq'])

    <form method="POST" action="{{ route('admin.faq.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="question" class="col-form-label">Вопрос</label>
            <input id="question" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" required>
            @error('question')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="answer" class="col-form-label">Ответ</label>
            <textarea id="answer" class="form-control @error('answer') is-invalid @enderror" name="answer" required>{{ old('answer') }}</textarea>
            @error('answer')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
        </div>
    </form>
@endsection
