@extends('layouts.app')

@section('content')
    <div class="faq-block">
        <div class="container">
            <h1 class="title">Вопрос-Ответ</h1>
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
