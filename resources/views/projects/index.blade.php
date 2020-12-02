@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        @include('common.search', ['route' => route('projects.index'), 'attributes' => $attributes])

        <section class="section-projects">

            <div class="projects-wrapper d-flex">
                @foreach($projects as $project)
                    <project-card
                        :project="{{ $project }}"
                    ></project-card>
                @endforeach
            </div>

            <div class="projects-pagination">
{{--                {{ $projects->links() }}--}}
            </div>
        </section>

@endsection
