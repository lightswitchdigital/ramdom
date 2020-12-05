@extends('layouts.app')

@section('content')
    <div class="favorites-block">
        <div class="container">
            <h1 class="title">Понравившиеся проекты</h1>
            <section class="section-projects">
                <div class="projects-wrapper d-flex">
                    @foreach($projects as $project)
                        <project-card
                            :project="{{ $project }}"
                        ></project-card>
                    @endforeach
                </div>
            </section>

            {{ $projects->links() }}
        </div>
    </div>

@endsection
