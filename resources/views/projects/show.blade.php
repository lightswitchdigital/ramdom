@extends('layouts.app')

@section('content')
    <project
        :project="{{ $project }}"
        :created-at="'{{ $created_at }}'"
        :buy-link="'{{ route('projects.buy', $project) }}'"
        :save-link="'{{ route('projects.modify.save', $project) }}'"
        @if($saveFile)
        :save-file="{{ $saveFile }}"
        @endif
        :can-edit="{{ json_encode($canEdit) }}"
        :purchase-attributes="{{ $purchase_attributes }}"
        :is-authenticated="{{ json_encode($isAuthenticated) }}"
        :favorites-add-link="'{{ route('projects.favorites.add', $project) }}'"
        :favorites-remove-link="'{{ route('projects.favorites.remove', $project) }}'"
        :recommendations="{{ $recommendations }}"
        :json-url="'{{ asset('/internal/mappings.json') }}'"
        :calculate-route="'{{ route('api.editor.calculate') }}'"
    ></project>
@endsection
