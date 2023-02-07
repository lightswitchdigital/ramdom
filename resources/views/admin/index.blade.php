@extends('layouts.admin')

@section('content')
    @include('layouts.common.partials')

    @include('admin._nav', ['route' => 'home'])

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.save-settings') }}" class="form" method="POST">

                @csrf

                <h4>
                    Основные данные
                </h4>

                <div class="form-group">
                    <label for="loan_requests_email">Почта для уведомлений о запросах на кредитование</label>
                    <input type="text" id="loan_requests_email" name="loan_requests_email" class="form-control"
                           value="{{ old('loan_requests_email', $settings['loan_requests_email']) }}">
                </div>

                <div class="form-group">
                    <label for="feedback_email">Почта для обратной связи</label>
                    <input type="text" id="feedback_email" name="feedback_email" class="form-control"
                           value="{{ old('feedback_email', $settings['feedback_email']) }}">
                </div>

                <h4>
                    Данные главной страницы
                </h4>


                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" id="title" name="title" class="form-control"
                           value="{{ old('title', $settings['title']) }}">
                </div>

                <div class="form-group my-3">
                    <label for="text">Текст</label>
                    <textarea class="texteditor form-control" name="text" id="text"
                              rows="5">{{ old('text', $settings['text']) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="title">Заголовок - Секция 2</label>
                    <input type="text" id="title" name="title_section2" class="form-control"
                           value="{{ old('title', $settings['title_section2']) }}">
                </div>

                <div class="form-group">
                    <label for="title">Заголовок - Секция калькулятор</label>
                    <textarea id="title" name="title_calculator"
                              class="form-control">{{ old('title', $settings['title_calculator']) }}</textarea>
                </div>

                <div class="form-group my-3">
                    <label for="text">Текст - Секция калькулятор</label>
                    <textarea class="texteditor form-control" name="text_calculator" id="text"
                              rows="5">{{ old('text', $settings['text_calculator']) }}</textarea>
                </div>


                <h4>
                    Данные подвала
                </h4>


                <div class="form-group">
                    <label for="footer_email">Эл. почта</label>
                    <input type="email" id="footer_email" name="footer_email" class="form-control"
                           value="{{ old('footer_email', $settings['footer_email']) }}">
                </div>
                <div class="form-group">
                    <label for="footer_vk">Ссылка вконтакте</label>
                    <input type="url" id="footer_vk" name="footer_vk" class="form-control"
                           value="{{ old('footer_vk', $settings['footer_vk']) }}">
                </div>
                <div class="form-group">
                    <label for="footer_ok">Ссылка одноклассники</label>
                    <input type="url" id="footer_ok" name="footer_ok" class="form-control"
                           value="{{ old('footer_ok', $settings['footer_ok']) }}">
                </div>
                <div class="form-group">
                    <label for="footer_fb">Ссылка фейсбук</label>
                    <input type="url" id="footer_fb" name="footer_fb" class="form-control"
                           value="{{ old('footer_fb', $settings['footer_fb']) }}">
                </div>

                <div class="form-group">
                    <label for="footer_phone">Рабочий телефон</label>
                    <input type="text" id="footer_phone" name="footer_phone" class="form-control"
                           value="{{ old('footer_phone', $settings['footer_phone']) }}">
                </div>
                <div class="form-group">
                    <label for="footer_viber">Ссылка вайбер</label>
                    <input type="text" id="footer_viber" name="footer_viber" class="form-control"
                           value="{{ old('footer_viber', $settings['footer_viber']) }}">
                </div>
                <div class="form-group">
                    <label for="footer_wa">Ссылка ватсап</label>
                    <input type="text" id="footer_wa" name="footer_wa" class="form-control"
                           value="{{ old('footer_wa', $settings['footer_wa']) }}">
                </div>
                <div class="form-group">
                    <label for="footer_tg">Ссылка телеграм</label>
                    <input type="text" id="footer_tg" name="footer_tg" class="form-control"
                           value="{{ old('footer_tg', $settings['footer_tg']) }}">
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
