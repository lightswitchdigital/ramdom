@extends('layouts.app')

@section('content')
    <div class="profile-block">
        <div class="modal fade" id="loanModal" tabindex="-1" aria-labelledby="loanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body loan-modal pt-4">
                        <h1>Калькулятор рассрочки</h1>
                        <input id="amount" type="number" min="1000000"
                               placeholder="Стоимость дома руб. (мин. 1000000 руб.)">
                        <input id="rate" type="number" min="100000" placeholder="Первоначальный платеж руб. (мин. 10%)">
                        <input id="months" type="number" min="3" placeholder="Срок рассрочки (мин. 3 года)">
                        <div class="form-group row">
                            <span class="yellow-btn col" onClick="Calculate()">Рассчитать</span>
                            <a class="yellow-btn-outline col" href="{{ route('profile.smeta.loan') }}">Подать заявку</a>
                        </div>
                        <hr>
                        <h2 class="result" id="total">Ежемесячный платеж: </h2>
                        <h2 class="result" id="total2">Удорожание в год: </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h1 class="title">Личный кабинет</h1>
            <div class="row">
                @include('profile._menu')
                <div class="col">
                    @if(!Auth::user()->docs_verified)
                        <div class="alert alert-warning" role="alert">
                            <p>
                                Для отправки заявки на строительство и на рассрочку необходимо
                                <a href="{{ route('profile.documents.index') }}">загрузить документы</a>
                            </p>
                        </div>
                    @endif
                    <div class="profile-info">
                        <div class="img">
                            <img src="/images/boss.png">
                        </div>
                        <div class="info">
                            <h1>{{ $user->name }}</h1>
                            <h1>{{ $user->last_name }}</h1>
                            <p>
                                {{ $user->isDeveloper()? "Застройщик" : "Физ. Лицо" }}
                            </p>
                            <p>{{ $user->email }}</p>
                            <p>{{ $user->phone }}</p>
                        </div>
                    </div>
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
    </div>

@endsection
