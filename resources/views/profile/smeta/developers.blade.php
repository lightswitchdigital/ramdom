@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="{{ route('profile.smeta.index') }}" style="color: #888"><i class="fas fa-long-arrow-left"
                                                                               style="margin-right: 8px"></i>назад</a>
        </p>
        <h1>Выбрать застройщика</h1>
        <developers
            :developers="{{ $developers }}"
        ></developers>
    </div>
@endsection
