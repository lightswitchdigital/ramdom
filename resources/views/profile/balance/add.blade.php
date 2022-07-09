@extends('layouts.app')

@section('content')
    <add-balance
        :link="'{{ route('profile.balance.add.check') }}'"
    ></add-balance>
@endsection
