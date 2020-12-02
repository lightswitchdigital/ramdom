@extends('layouts.app')

@section('content')
    <project
        :project="{{ $project }}"
        :images="{{ $images }}"
        :created-at="'{{ $created_at }}'"
        :values="{{ $values }}"
        :create-order-link="'{{ route('projects.order', $project) }}'"
        :order-attributes="{{ $order_attributes }}"
        :is-authenticated="{{ json_encode($isAuthenticated) }}"
        :is-in-favorites="{{ json_encode($isInFavorites) }}"
        :favorites-add-link="'{{ route('projects.favorites.add', $project) }}'"
        :favorites-remove-link="'{{ route('projects.favorites.remove', $project) }}'"
        :recommendations-link="'{{ route('api.projects.recommendations', $project) }}'"
    ></project>
@endsection
