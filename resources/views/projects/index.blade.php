@extends('layouts.app')

@section('content')
    <div class="container projects-wrapper projects-section mt-5">

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

<<<<<<< HEAD
                                @elseif ($attribute->isNumber())
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="attrs[{{ $attribute->id }}][from]" value="{{ request()->input('attrs.' . $attribute->id . '.from') }}" placeholder="From">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="attrs[{{ $attribute->id }}][to]" value="{{ request()->input('attrs.' . $attribute->id . '.to') }}" placeholder="To">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <button class="btn btn-success">Искать</button>
        </form>
        <div class="flex-box">
        @foreach($projects as $project)
            <project-card
                :project="{{ $project }}"
                :project-link="'{{ route('projects.show', $project) }}'"
            ></project-card>
        @endforeach
        </div>
=======
>>>>>>> ff8e82f1228794102b035ad5950001d54c1bb0cf
    </div>

@endsection
