@php
    $user = Auth::user();
@endphp

@if(session('info'))
    <br>
    <div class="alert alert-primary" role="alert">
        {!! session('info') !!}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success" role="alert">
        {!! session('success') !!}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">
        {!! session('error') !!}
    </div>
@endif
