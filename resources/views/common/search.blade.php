<div class="container">
    <div class="filter-block">
        <form action="{{ $route }}" method="GET">
            <input type="text" class="form-control search-input" name="text" value="{{ request('text') }}" placeholder="Поиск по названию или описанию проекта">
            <div class="price">
                <span class="title">
                    Цена
                </span>
                <input type="number" class="form-control" name="price[from]" value="{{ request()->input('price.from') }}" placeholder="от">
                <input type="number" class="form-control" name="price[to]" value="{{ request()->input('price.to') }}" placeholder="до">
            </div>
            <div class="selectors-block">
                @foreach ($attributes as $attribute)
                    <div class="form-control-custom">
                        <label for="attrs{{ $attribute->id }}">{{ $attribute->name }}</label>
                        @if ($attribute->isSelect())
                            <select class="custom-select" name="attrs[{{ $attribute->id }}][equals]" id="attrs{{ $attribute->id }}">
                                <option value=""></option>
                                @foreach ($attribute->variants as $variant)
                                    <option value="{{ $variant }}"{{ $variant === request()->input('attrs.' . $attribute->id . '.equals') ? ' selected' : '' }}>
                                        {{ $variant }}
                                    </option>
                                @endforeach
                            </select>

                        @elseif ($attribute->isNumber())
                            <div>
                                <input type="number" class="form-control filter-num" name="attrs[{{ $attribute->id }}][from]" value="{{ request()->input('attrs.' . $attribute->id . '.from') }}" placeholder="От">
                                <input type="number" class="form-control filter-num" name="attrs[{{ $attribute->id }}][to]" value="{{ request()->input('attrs.' . $attribute->id . '.to') }}" placeholder="До">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn yellow-btn">Поиск</button>
        </form>
    </div>
</div>
