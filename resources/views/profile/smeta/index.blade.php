@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="{{ route('profile.index') }}" style="color: #888"><i class="fas fa-long-arrow-left"
                                                                         style="margin-right: 8px"></i>назад</a></p>
        <h1>Ввод данных</h1>
        <smeta
            :save-editor-data-link="'{{ route('profile.smeta.index') }}'"
            @if($saveFile)
                :save-file="{{ $saveFile }}"
            @endif
            :json-url="'{{ Auth::user()->isDeveloper()? asset('/internal/mappings.json') : asset('/internal/mappings_cut.json') }}'"
            :smeta-download-link="'{{ route('profile.smeta.download-docs') }}'"
            :is-developer="{{ json_encode(Auth::user()->isDeveloper()) }}"
        ></smeta>
    </div>
@endsection
