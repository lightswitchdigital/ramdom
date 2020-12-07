@extends('layouts.app')

@section('content')
    <project
        :project="{{ $project }}"
        :created-at="'{{ $created_at }}'"
        :order-link="'{{ route('projects.order', $project) }}'"
        :buy-link="'{{ route('projects.buy', $project) }}'"
        :save-link="'{{ route('projects.modify.save', $project) }}'"
        :can-edit="{{ json_encode($canEdit) }}"
        :order-attributes="{{ $purchase_attributes }}"
        :is-authenticated="{{ json_encode($isAuthenticated) }}"
        :favorites-add-link="'{{ route('projects.favorites.add', $project) }}'"
        :favorites-remove-link="'{{ route('projects.favorites.remove', $project) }}'"
        :recommendations="{{ $recommendations }}"
    ></project>
@endsection
