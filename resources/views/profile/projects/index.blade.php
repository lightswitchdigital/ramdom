@extends('layouts.app')

@section('content')
    <div class="favorites-block">

        <div class="container">
            <h1 class="title">Мои проекты</h1>
            <section class="section-projects">
                <div class="projects-wrapper d-flex">
{{--                    @foreach($projects as $project)--}}
{{--                        <purchased-project-card--}}
{{--                            :project="{{ $project }}"--}}
{{--                        ></purchased-project-card>--}}
{{--                        <purchased-project-details--}}
{{--                            :project="{{ $project }}"--}}
{{--                        >--}}
{{--                        </purchased-project-details>--}}
{{--                    @endforeach--}}
                </div>
            </section>

            Роут для сохраненных: {{ route('profile.projects.get-purchased-projects') }}
            <br>
            Роут для купленных: {{ route('profile.projects.get-purchased-projects') }}
            <br>
            <br>
            Передавай роуты в пропах этими же функциями
        </div>
    </div>
@endsection
