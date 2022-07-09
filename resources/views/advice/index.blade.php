@extends('layouts.app')

@section('content')
    <div class="building-advice">
        <div class="container">
            <h1 class="title">Советы по строительству</h1>
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
