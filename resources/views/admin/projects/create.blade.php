@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'projects'])

    <form action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">
                Общие сведения
            </div>
            <div class="card-body pb-2">

                <div class="form-group">
                    <label for="title" class="col-form-label">Название</label>
                    <input id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">Текст</label>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="10" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">Цена</label>
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
                    @error('price')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="images" class="col-form-label">Картинки</label>
                    <input id="images" type="file" multiple class="form-control-file @error('images') is-invalid @enderror" name="images[]">
                    @error('images')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Характеристики
            </div>
            <div class="card-body pb-2">
                @foreach ($attributes as $attribute)

                    <div class="form-group">
                        <label for=attribute_{{ $attribute->id }}" class="col-form-label">{{ $attribute->name }}</label>

                        @if ($attribute->isSelect())

                            <select id="attribute_{{ $attribute->id }}" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]">
                                @if(!$attribute->required)
                                    <option value=""></option>
                                @endif

                                @foreach ($attribute->variants as $variant)
                                    <option value="{{ $variant }}"{{ $variant == old('attributes.' . $attribute->id) ? ' selected' : '' }}>
                                        {{ $variant }}
                                    </option>
                                @endforeach
                            </select>

                        @elseif ($attribute->isNumber())

                            <input id="attribute_{{ $attribute->id }}" type="number" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]" value="{{ old('attributes.' . $attribute->id) }}">

                        @else

                            <input id="attribute_{{ $attribute->id }}" type="text" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]" value="{{ old('attributes.' . $attribute->id) }}">

                        @endif

                        @if ($errors->has('parent'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('attributes.' . $attribute->id) }}</strong></span>
                        @endif
                    </div>

                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Сведения для редактора
            </div>
            <div class="card-body pb-2">
                @foreach($editor_attributes as $attribute)
                    @switch($attribute->type ?? 'integer')
                        @case('select')
                        <div class="form-group my-4">
                            <label for="{{ $attribute->name }}">{{ $attribute->label ?? '' }} - {{ $attribute->id }}</label>
                            <select class="form-control" name="editor_attributes[{{ $attribute->name }}]" id="{{ $attribute->name }}">
                                @foreach($attribute->variants as $variant)
                                    <option value="{{ $variant }}" {{ ($attribute->def ?? '')  == $variant? 'selected' : '' }}>{{ $variant }}</option>
                                @endforeach
                            </select>
                        </div>
                        @break
                        @case('number')
                        <div class="form-group my-4">
                            <label for="{{ $attribute->name }}">{{ $attribute->label ?? '' }}</label>
                            <input class="form-control" type="text" name="editor_attributes[{{ $attribute->name }}]" value="{{ $attribute->def ?? '' }}">
                        </div>
                        @break
                    @endswitch
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Создать</button>
        </div>

    </form>
@endsection
