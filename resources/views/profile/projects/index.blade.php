@extends('layouts.app')

@section('content')
    <div class="favorites-block">
        <div class="modal fade" id="modalProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                </div>
            </div>
        </div>

        <div class="container">
            <h1 class="title">Мои проекты</h1>
            <section class="section-projects">
                <div class="projects-wrapper d-flex">
                    @foreach($projects as $project)
                        <purchased-project-card
                            :project="{{ $project }}"
                            @projectInfo="getId"
                        ></purchased-project-card>
                    @endforeach
                </div>
            </section>
            {{ $projects->links() }}
        </div>
    </div>
@endsection
