@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'plans'])

    <form method="POST" action="{{ route('admin.plans.update', $plan) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="col-form-label">Название</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $plan->name) }}" required>
            @error('name')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="price" class="col-form-label">Цена</label>
            <input id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $plan->price) }}" required>
            @error('price')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="interval" class="col-form-label">Интервал</label>
            <select id="interval" class="form-control @error('interval') is-invalid @enderror" name="interval">
                @foreach ($intervals as $value => $label)
                    <option value="{{ $value }}"{{ $value === old('interval', $plan->interval) ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('interval')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
        </div>
    </form>
@endsection
