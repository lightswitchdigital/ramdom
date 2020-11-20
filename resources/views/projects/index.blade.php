@extends('layouts.app')

@section('content')

    <div class="container">

        @include('common.search', ['route' => route('projects.index'), 'attributes' => $attributes])

        <section class="section-projects">
            @foreach($projects as $project)
                <project-card
                    :project="{{ $project }}"
                    :project-images="{{ $project->getImagesInJson() }}"
                    :project-values="{{ $project->getValuesInJson() }}"
                    :project-link="'{{ route('projects.show', $project) }}'"
                ></project-card>
            @endforeach
        </section>

    </div>

@endsection
