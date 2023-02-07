@extends('layouts.app')
@section('meta-title')
    ИПК "РБК"
@endsection
@section('meta-desc')
    ИПК РБК в режиме Онлайн поможет рассчитать стоимость постройки дома и составить смету с учетом введенных Вами параметров дома. Поможем подобрать надежного застройщика.
@endsection

@section('content')
    <section class="bg-section">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h1 class="bg-section__title">{{ $settings['title'] }}</h1>
                    <span class="yellow-line"></span>
                    <h5 class="bg-section__subtitle">
                        {!! $settings['text'] !!}
                    </h5>
                </div>
                <div class="col-md img-col">
                    <div class="bg-section__img">
                        <img src="https://i.pinimg.com/originals/30/d0/58/30d058c468aca28ea5c53ea4bc7eea5b.jpg"
                             alt="ИПК РБК" title="ИПК РБК">
                    </div>
                </div>
            </div>
        </div>

        <editor
            :title="'{{ $settings['title_section2'] }}'"
        ></editor>

        <div class="container loan-container">
            <div class="row">
                <div class="col-md">
                    <h2 class="bg-section__title">{{ $settings['title_calculator'] }}</h2>
                    <span class="yellow-line"></span>
                    <h5 class="bg-section__subtitle">{!! $settings['text_calculator'] !!}</h5>
                </div>
                <div class="col-md loan-modal">
                    <input class="mt-4" id="amount" type="number" min="1000000"
                           placeholder="Стоимость дома руб. (мин. 1000000 руб.)">
                    <input id="rate" type="number" min="100000" placeholder="Первоначальный платеж руб. (мин. 10%)">
                    <input id="months" type="number" min="3" placeholder="Срок рассрочки (мин. 3 года)">
                    <div class="form-group row">
                        <span class="yellow-btn col mt-0" onClick="Calculate()">Рассчитать</span>
                        <a class="yellow-btn-outline col mt-0" href="./profile/smeta/loan">Подать заявку</a>
                    </div>
                    <hr>
                    <h2 class="result" id="total">Ежемесячный платеж: </h2>
                    <h2 class="result" id="total2">Удорожание в год: </h2>
                </div>
            </div>
        </div>
        <script>
            function Calculate() {
                const firstPay = +document.querySelector("#rate").value;
                const amount = +document.querySelector("#amount").value - firstPay;
                const price = amount + firstPay;
                const rate = {{ $rate ?: 12 }} / 100 / 12;
                const rateAll = rate + 1;
                const years = +document.querySelector("#months").value
                const months = years * 12;

                const withPercent = (amount * rate) + price

                const interest = Math.pow(rateAll, months) - 1
                const total = (amount * (rate + (rate / interest))).toFixed(2);

                const percentYears = ((((+total * months + firstPay) - price) / price) * 100 / years).toFixed(2)

                if (!isNaN(total) && total != Infinity) {
                    document.querySelector("#total")
                        .innerHTML = "Ежемесячный платеж: " + total;
                    document.querySelector("#total2")
                        .innerHTML = "Удорожание в год: " + percentYears + "%";
                }
            }
        </script>
    </section>
@endsection
