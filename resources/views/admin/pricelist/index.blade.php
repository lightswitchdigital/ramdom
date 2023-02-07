@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'pricelist'])
    <div class="container">
        <h1>Прайс лист</h1>
        <pricelist
            :save-url="'{{ route('admin.pricelist.save') }}'"
            @if($saveFile)
                :save-file="{{ json_encode($saveFile) }}"
            @endif
        ></pricelist>
    </div>
@endsection
