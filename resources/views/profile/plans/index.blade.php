@extends('layouts.app')

@section('content')
    <div class="plans-block">
        <div class="container">
            <h1 class="title">Планы</h1>
            <h1 class="subtitle">Выберите подходящий себе план</h1>
            <div class="row">
                @foreach($plans as $plan)
                    <div class="col-md">
                        <div class="card">
                            <form action="{{ route('profile.plans.subscribe', $plan) }}" method="POST">
                                @csrf
                                <h4 class="card-title">{{ $plan->name }}</h4>
                                <h1 class="price">{{ $plan->price }}<br>
                                    <span style="display: block; font-size: 12px; font-weight: bold;">рублей / месяц</span>
                                </h1>
                                <p class="desc">план для тех, кто только начинает знакомиться с функционалом сайта</p>
                                <button class="btn yellow-btn">Перейти</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
