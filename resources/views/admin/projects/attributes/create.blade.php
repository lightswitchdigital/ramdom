@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'projects'])

    <form method="POST" action="{{ route('admin.projects.attributes.store') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">Название</label>
            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="sort" class="col-form-label">Сортировка</label>
            <input id="sort" type="text" class="form-control{{ $errors->has('sort') ? ' is-invalid' : '' }}" name="sort" value="{{ old('sort') }}" required>
            @if ($errors->has('sort'))
                <span class="invalid-feedback"><strong>{{ $errors->first('sort') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="type" class="col-form-label">Тип</label>
            <select id="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                @foreach ($types as $type => $label)
                    <option value="{{ $type }}"{{ $type == old('type') ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach;
            </select>
            @if ($errors->has('type'))
                <span class="invalid-feedback"><strong>{{ $errors->first('type') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="variants" class="col-form-label">Варианты</label>
            <textarea id="variants" type="text" class="form-control{{ $errors->has('sort') ? ' is-invalid' : '' }}" name="variants">{{ old('variants') }}</textarea>
            @if ($errors->has('variants'))
                <span class="invalid-feedback"><strong>{{ $errors->first('variants') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection
