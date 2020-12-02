@extends('layouts.app')

@section('content')
    <project
        :project="{{ $project }}"
        :created-at="'{{ $created_at }}'"
        :create-order-link="'{{ route('projects.order', $project) }}'"
        :order-attributes="{{ $order_attributes }}"
        :is-authenticated="{{ json_encode($isAuthenticated) }}"
        :favorites-add-link="'{{ route('projects.favorites.add', $project) }}'"
        :favorites-remove-link="'{{ route('projects.favorites.remove', $project) }}'"
        :recommendations="{{ $recommendations }}"
    ></project>
@endsection
