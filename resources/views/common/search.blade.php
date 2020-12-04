<div class="search-bar pt-3 my-3">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <form action="{{ $route }}" method="GET">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <input type="text" class="form-control" name="text" value="{{ request('text') }}" placeholder="Search for...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="price[from]" value="{{ request()->input('price.from') }}" placeholder="От">
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="price[to]" value="{{ request()->input('price.to') }}" placeholder="До">
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($attributes as $attribute)
                            @if ($attribute->isSelect() || $attribute->isNumber())
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
                                                <input type="number" class="form-control" name="attrs[{{ $attribute->id }}][from]" value="{{ request()->input('attrs.' . $attribute->id . '.from') }}" placeholder="От">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" name="attrs[{{ $attribute->id }}][to]" value="{{ request()->input('attrs.' . $attribute->id . '.to') }}" placeholder="До">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="col-md-3" style="text-align: right">
                        <button type="submit" class="btn btn-primary">Поиск</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
