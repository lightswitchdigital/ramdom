@extends('layouts.app')

@section('content')
    <project
        :project="{{ $project }}"
        :images="{{ $images }}"
        :created-at="'{{ $created_at }}'"
        :values="{{ $values }}"
        :create-order-link="'{{ route('projects.order', $project) }}'"
        :order-attributes="{{ $order_attributes }}"
    ></project>
@endsection
