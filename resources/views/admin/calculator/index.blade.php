@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'calculator'])

    <form action="{{ route('admin.calculator.update') }}" method="POST" class="card">
        @csrf

        <div class="card-body">
            <h2>Данные для калькулятора</h2>
            <div class="form-group mt-3">
                <label for="rate">Процент</label>
                <input type="text" id="rate" name="rate" class="form-control" value="{{ $rate }}">
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </div>

    </form>
@endsection
