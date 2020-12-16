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

                {{-- {{ $projects->links() }} --}}

{{--                <nav aria-label="Page navigation example">--}}
{{--                    <ul class="pagination">--}}
{{--                        <li class="page-item">--}}
{{--                        <a class="page-link btn-prev" href="#" aria-label="Previous">--}}
{{--                            <i class="fas fa-chevron-left"></i>--}}
{{--                        </a>--}}
{{--                        </li>--}}
{{--                        <li class="page-item">--}}
{{--                            <a class="page-link" href="#" aria-label="Next">--}}
{{--                                1--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="page-item">--}}
{{--                        <a class="page-link btn-next" href="#" aria-label="Next">--}}
{{--                            <i class="fas fa-chevron-right"></i>--}}
{{--                        </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
            </div>
        </section>

@endsection
