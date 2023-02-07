@extends('layouts.app')
@section('meta-title')
    ИПК РБК | Наши услуги
@endsection
@section('meta-desc')
    ИНВЕСТИЦИОННЫЙ ПОТРЕБИТЕЛЬСКИЙ КООПЕРАТИВ РБК оказывает услуги Заёмщикам, Строителям, Девелоперам, Инвесторам. Для каждого индивидуальные условия сотрудничества.
@endsection

@section('content')
    <div class="building-advice">
        <div class="container">
            <h1 class="title">Наши услуги</h1>
            @foreach($advice as $item)
                <advice
                    :advice="{{ $item }}"
                    :advice-link="'{{ route('advice.show', $item) }}'"
                >
                </advice>
            @endforeach

            {{ $advice->links() }}
        </div>
    </div>

@endsection
