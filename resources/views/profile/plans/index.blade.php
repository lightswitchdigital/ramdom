@extends('layouts.app')

@section('content')
    <div class="plans-block">
        <div class="container">
            <h1 class="title">Проекты</h1>
            <div class="row">
                @foreach($plans as $plan)
                    <div class="col-md">
                        <a href="{{ route('profiile.plans.subscribe', $plan) }}" class="card">
                            <h4 class="card-title">{{ $plan->name }}</h4>
                            <h1 class="price">{{ $plan->price }}</h1>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
