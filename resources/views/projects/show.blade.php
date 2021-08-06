@extends('layouts.app')

@section('content')
    <project
        :project="{{ $project }}"
        :created-at="'{{ $created_at }}'"
        :buy-link="'{{ route('projects.buy', $project) }}'"
        :save-link="'{{ route('projects.modify.save', $project) }}'"
        :save-editor-data-link="'{{ route('projects.modify.save-editor-data', $project) }}'"
        :favorites-add-link="'{{ route('projects.favorites.add', $project) }}'"
        :favorites-remove-link="'{{ route('projects.favorites.remove', $project) }}'"
        @if($saveFile)
        :save-file="{{ $saveFile }}"
        @endif
        :can-edit="{{ json_encode($canEdit) }}"
        :purchase-attributes="{{ $purchase_attributes }}"
        :is-authenticated="{{ json_encode($isAuthenticated) }}"
        :recommendations="{{ $recommendations }}"
        :json-url="'{{ asset('/internal/mappings.json') }}'"
    ></project>
@endsection
