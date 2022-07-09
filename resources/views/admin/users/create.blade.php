@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'users'])

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">Имя</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name" class="col-form-label">Фамилия</label>
            <input id="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
            @error('last_name')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name" class="col-form-label">Отчество</label>
            <input id="last_name" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" required>
            @error('middle_name')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone" class="col-form-label">Телефон</label>
            <input id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="col-form-label">Эл. почта</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label">Пароль</label>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>
            @error('password')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="role" class="col-form-label">Роль</label>
            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                @foreach ($roles as $value => $label)
                    <option value="{{ $value }}"{{ $value === old('role') ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('role')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="status" class="col-form-label">Статус</label>
            <select id="status" class="form-control @error('status') is-invalid @enderror" name="role">
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}"{{ $value === old('status') ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('status')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="type" class="col-form-label">Тип</label>
            <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
                @foreach ($types as $value => $label)
                    <option value="{{ $value }}"{{ $value === old('type') ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('type')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
        </div>
    </form>
@endsection
