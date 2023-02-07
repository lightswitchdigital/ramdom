@extends('layouts.app')

@section('title')
    Документы
@endsection

@section('content')
    <div class="profile-block">
        <div class="container">
            <h3 class="card-title mb-3">Документы</h3>

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
                            <form action="{{ route('profile.documents.upload-docs') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <h5>Документы</h5>
                                <small class="mt-3">
                                    <b>
                                        Отправляйте документы для подтвержденией администрацией сайта. Это нужно для
                                        оформления заявки на строительства и заявки на рассрочку.
                                    </b>
                                </small>
                                <br>
                                <br>
                                <div class="flex-dropzone-wrapper mt-2">
                                    <p>Паспорт, основные <br> данные с фотографией<br>
                                        (только JPEG PNG PDF)</p>
                                    <input type="file" name="passport_1" class="form-control-file dropzone-hide"
                                           id="documents1" data-multiple-caption="{count} файлов выбрано"/>
                                    <label for="documents1"
                                           class="dropzone-css"><span>выберите или перетащите файл</span></label>
                                    @error('passport_1')
                                    <div class="error-text text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="flex-dropzone-wrapper mt-2">
                                    <p>Паспорт, место жительства<br>
                                        (только JPEG PNG PDF)</p>
                                    <input type="file" name="passport_2" class="form-control-file dropzone-hide"
                                           id="documents2" data-multiple-caption="{count} файлов выбрано"/>
                                    <label for="documents2"
                                           class="dropzone-css"><span>выберите или перетащите файл</span></label>
                                    @error('passport_2')
                                    <div class="error-text text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="flex-dropzone-wrapper mt-2">
                                    <p>Скан СНИЛС<br>
                                        (только JPEG PNG PDF)</p>
                                    <input type="file" name="snils" class="form-control-file dropzone-hide"
                                           id="documents9"
                                           data-multiple-caption="{count} файлов выбрано"/>
                                    <label for="documents9"
                                           class="dropzone-css"><span>выберите или перетащите файл</span></label>
                                    @error('snils')
                                    <div class="error-text text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-4">
                                    <button class="btn yellow-btn">
                                        Отправить на проверку
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
