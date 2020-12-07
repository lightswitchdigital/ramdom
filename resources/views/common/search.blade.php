<div class="container">
    <div class="filter-block">
        <form action="{{ $route }}" method="GET">
            <input type="text" class="form-control search-input" name="text" value="{{ request('text') }}" placeholder="Search for...">
            <div class="price">
                <span class="title">
                    Цена
                </span>
                <input type="number" class="form-control" name="price[from]" value="{{ request()->input('price.from') }}" placeholder="от">
                <input type="number" class="form-control" name="price[to]" value="{{ request()->input('price.to') }}" placeholder="до">
            </div>
            <div class="selectors-block">
                @foreach ($attributes as $attribute)
                    @if ($attribute->isSelect() || $attribute->isNumber())
                    <div class="form-control-custom">
                        @if ($attribute->isSelect())
                            <select class="custom-select" name="attrs[{{ $attribute->id }}][equals]">
                                <option value="">{{ $attribute->name }}</option>
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
            
            <button type="submit" class="btn yellow-btn">Поиск</button>
        </form>
    </div>
</div>
