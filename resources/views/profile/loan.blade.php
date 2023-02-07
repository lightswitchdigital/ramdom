@extends('layouts.app')

@section('title')
    Заявка на рассрочку
@endsection

@section('content')
    <div class="profile-block">
        <div class="container">
            <h3 class="card-title mb-3">Заявка на рассрочку</h3>

            <div class="row">

                @include('profile._menu')
                <div class="col">
                    <div class="card card-balance mb-4 mx-auto" style="width: 35rem">
                        <div class="card-body">
                            <a href="https://kontur.ru/diadoc?p=f17925" target="_blank"><img height="80"
                                                                                             src="https://www.diadoc.ru/Files/userfiles/image/tsrs/600-diadoc-receive.png"
                                                                                             width="100%"/></a>
                            <br>
                            <br>
                            <form action="{{ route('profile.smeta.request-loan') }}" method="POST" id="documentsForm"
                                  enctype="multipart/form-data">
                                @csrf
                                <h5>Данные для заявки</h5>

                                <input type="hidden" id="tokenInput" name="token">
                                <div class="input-block">
                                    <input type="number" name="amount" placeholder="Сумма кредитования"
                                           class="form-control">
                                    @error('amount')
                                    <div class="error-text text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="input-block mt-2">
                                    <input type="number" name="building_price" placeholder="Стоимость дома"
                                           class="form-control">
                                    @error('building_price')
                                    <div class="error-text text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="input-block mt-2">
                                    <textarea class="form-control" name="message"
                                              placeholder="Комментарий (необязательно для заполнения)"
                                              style="resize: none; height: 50px;"></textarea>
                                    @error('message')
                                    <div class="error-text text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <hr>
                                <h5>Документы</h5>
                                <small>Для рассмотрения заявки требуется загрузить следующие документы:</small>
                                <div class="flex-dropzone-wrapper mt-2">
                                    <p>Документы на участок<br>
                                        <small>(только JPEG PNG PDF)</small>
                                    </p>
                                    <div>
                                        <input type="file" name="place" class="form-control-file dropzone-hide"
                                               id="documents10"
                                               data-multiple-caption="{count} файлов выбрано"/>
                                        <label for="documents10"
                                               class="dropzone-css"><span>Выберите или перетащите файл</span></label>
                                        @error('place')
                                        <div class="error-text text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex-dropzone-wrapper mt-2">
                                    <p>Проект дома<br>
                                        <small>(только JPEG PNG PDF)</small>
                                    </p>
                                    <div>
                                        <input type="file" name="floor_plan" class="form-control-file dropzone-hide"
                                               id="documents11"
                                               data-multiple-caption="{count} файлов выбрано"/>
                                        <label for="documents11"
                                               class="dropzone-css"><span>Выберите или перетащите файл</span></label>
                                        @error('floor_plan')
                                        <div class="error-text text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex-dropzone-wrapper mt-2">
                                    <p>Смета<br>
                                        <small>(только JPEG PNG PDF)</small>
                                    </p>
                                    <div>
                                        <input type="file" name="smeta" class="form-control-file dropzone-hide"
                                               id="documents12"
                                               data-multiple-caption="{count} файлов выбрано"/>
                                        <label for="documents12"
                                               class="dropzone-css"><span>Выберите или перетащите файл</span></label>
                                        @error('smeta')
                                        <div class="error-text text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                @if(Auth::user()->isDeveloper())
                                    <div class="my-3">
                                        <small><b>Оставьте поля ниже пустыми, если заполняете не для клиента</b></small>
                                    </div>
                                    <div class="flex-dropzone-wrapper mt-2">
                                        <p>Паспорт клиента - 1 страница<br>
                                            <small>(только JPEG PNG PDF)</small>
                                        </p>
                                        <div>
                                            <input type="file" name="passport_1" class="form-control-file dropzone-hide"
                                                   id="passport_1"
                                                   data-multiple-caption="{count} файлов выбрано"/>
                                            <label for="passport_1" class="dropzone-css"><span>Выберите или перетащите файл</span></label>
                                            @error('passport_1')
                                            <div class="error-text text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex-dropzone-wrapper mt-2">
                                        <p>Паспорт клиента - 2 страница<br>
                                            <small>(только JPEG PNG PDF)</small>
                                        </p>
                                        <div>
                                            <input type="file" name="passport_2" class="form-control-file dropzone-hide"
                                                   id="passport_2"
                                                   data-multiple-caption="{count} файлов выбрано"/>
                                            <label for="passport_2" class="dropzone-css"><span>Выберите или перетащите файл</span></label>
                                            @error('passport_2')
                                            <div class="error-text text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="form-check mt-3 text-muted">
                                    <input class="form-check-input" type="checkbox" id="checkbox" name="checkbox">
                                    <label class="form-check-label" for="checkbox">
                                        <small>
                                            Я соглашаюсь с условиями договора и соглашаюсь на обработку <a href="#"
                                                                                                           data-toggle="modal"
                                                                                                           data-target="#sogl">персональных
                                                данных</a>
                                        </small>
                                        <br>
                                        <small>
                                            Передача документов приветствуется через <a
                                                href="https://kontur.ru/diadoc?p=f17925">КонтурДиадок</a>
                                        </small>
                                    </label>
                                    @error('checkbox')
                                    <div class="error-text text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" id="requestTokenBtn"
                                            class="btn yellow-btn mt-2 mb-2">Отправить
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
