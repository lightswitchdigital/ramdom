@extends('layouts.app')

@section('content')
    <div class="plans-block">
        <div class="container">
            <h1 class="title">Проекты</h1>
            <div class="row">
                @foreach($plans as $plan)
                    <div class="col-md">
                        <div class="card">
                            <form action="{{ route('profile.plans.subscribe', $plan) }}" method="POST">
                                @csrf
                                <h4 class="card-title">{{ $plan->name }}</h4>
                                <h1 class="price">{{ $plan->price }}</h1>
                                <button class="btn btn-primary">Выбрать</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
