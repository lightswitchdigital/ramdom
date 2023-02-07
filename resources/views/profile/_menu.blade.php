<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="loanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pt-4">
                <form action="{{ route('profile.feedback') }}" method="POST">
                    @csrf
                    <h5 class="mb-5">Есть вопрос или предложение?</h5>
                    <div class="form-group">
                        <label for="name">Как к вам обращаться?</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <textarea class="form-control" name="message" id="message" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Почта для обратной связи</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn yellow-btn">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4">
    <ul class="menu">
        <li>
            <a href="{{ route('profile.smeta.index') }}">
                <i class="fas fa-info"></i>
                Составить смету</a>
        </li>
        @if(Auth::user()->isDeveloper())
            <li>
                <a href="{{ route('profile.smeta.pricelist') }}">
                    <i class="fal fa-clipboard-list"></i>
                    Прайс-лист</a>
            </li>
            <li>
                <a href="{{ route('profile.developer') }}">
                    <i class="fas fa-tools"></i>
                    Заявки на строительство</a>
            </li>
        @endif
        <li>
            <a href="{{ route('profile.smeta.loan') }}">
                <i class="fas fa-file-search"></i>
                Заявка на рассрочку</a>
        </li>
        {{--        <li>--}}
        {{--            <a href="{{ route('profile.documents.index') }}">--}}
        {{--                <i class="fas fa-file-search"></i>--}}
        {{--                Документы</a>--}}
        {{--        </li>--}}
        <li>
            <a href="#" type="button" data-toggle="modal" data-target="#loanModal">
                <i class="fas fa-landmark"></i>
                Рассчитать рассрочку</a>
        </li>
        <li>
            <a href="{{ route('profile.documents.index') }}">
                <i class="fas fa-file-search"></i>
                Загрузить документы</a>
        </li>
        <li>
            <a href="{{ route('profile.settings.index') }}">
                <i class="fas fa-cogs"></i>
                Настроить аккаунт</a>
        </li>
        <li style="background: #fffbdb !important; padding: 15px 35px">
            <a href="#" type="button" data-toggle="modal" data-target="#feedbackModal">
                <i class="fas fa-envelope"></i>
                Обратная связь</a>
        </li>
    </ul>
</div>
