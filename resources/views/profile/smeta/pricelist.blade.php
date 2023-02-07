@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="{{ route('profile.index') }}" style="color: #888"><i class="fas fa-long-arrow-left"
                                                                         style="margin-right: 8px"></i>назад</a></p>
        <h1>Прайс лист</h1>
        <pricelist
            :save-url="'{{ route('profile.smeta.pricelist') }}'"
            @if($saveFile)
                :save-file="{{ $saveFile }}"
            @endif
        ></pricelist>
    </div>
@endsection
