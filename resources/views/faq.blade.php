@extends('layouts.app')
@section('meta-title')
    ИПК РБК | Частые вопросы наших клиентов
@endsection
@section('meta-desc')
    ИНВЕСТИЦИОННЫЙ ПОТРЕБИТЕЛЬСКИЙ КООПЕРАТИВ РБК дает ответы на наиболее популярные вопросы наших клиентов.
@endsection

@section('content')
    <div class="faq-block">
        <div class="container">
            <h1 class="title">Вопросы/ответы</h1>
            @foreach($faq as $item)
                <div class="accordion" id="faq-{{ $item->id }}">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-{{ $item->id }}" aria-expanded="true" aria-controls="collapse-{{ $item->id }}">
                                        {{ $item->question }}
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse-{{ $item->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#faq-{{ $item->id }}">
                                <div class="card-body">
                                    {!! $item->answer !!}
                                </div>
                            </div>
                        </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
