@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="{{ route('profile.index') }}" style="color: #888"><i class="fas fa-long-arrow-left"
                                                                         style="margin-right: 8px"></i>назад</a></p>
        <h1>
            Заявки на строительство
        </h1>
        <br/>
        <developer-request
            :requests="{{ $requests }}"
            :statuses="{{ json_encode($statuses, JSON_UNESCAPED_UNICODE) }}"
            :status-route="'{{ route('profile.developer.changeStatus') }}'"
        ></developer-request>
    </div>
@endsection
