@extends('layouts.app')

@section('content')

    <div class="container projects-wrapper mt-5">

        <form action="?">
            <div class="div">
                @foreach ($attributes as $attribute)
                    @if ($attribute->isSelect() || $attribute->isNumber())
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">{{ $attribute->name }}</label>

                                @if ($attribute->isSelect())
                                    <select class="form-control" name="attrs[{{ $attribute->id }}][equals]">
                                        <option value=""></option>
                                        @foreach ($attribute->variants as $variant)
                                            <option value="{{ $variant }}"{{ $variant === request()->input('attrs.' . $attribute->id . '.equals') ? ' selected' : '' }}>
                                                {{ $variant }}
                                            </option>
                                        @endforeach
                                    </select>

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

        @foreach($projects as $project)
            <div class="card mx-4" style="width: 30%; float: left">
                <div class="card-header">{{ $project->title }}</div>
                <div class="card-body">
                    {{ $project->description }}
                </div>
            </div>
        @endforeach
    </div>

@endsection
