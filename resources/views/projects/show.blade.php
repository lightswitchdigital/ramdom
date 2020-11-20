@extends('layouts.app')

@section('content')
    <project
        :project="{{ $project }}"
        :images="{{ $images }}"
        :created-at="'{{ $created_at }}'"
        :values="{{ $values }}"
    ></project>
@endsection
