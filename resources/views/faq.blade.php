@extends('layouts.app')

@section('content')
    <div class="faq-block">
        <div class="container">
            <h1 class="title">Вопрос-Ответ</h1>
            <div class="accordion" id="accordionExample">
                @foreach($faq as $item)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ $item->question }}
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                {!! $item->answer !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
