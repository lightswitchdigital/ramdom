@extends('layouts.app')

@section('content')
    <div class="settings-block">
        <div class="container">
            <p><a href="{{ route('profile.index') }}" style="color: #888"><i class="fas fa-long-arrow-left"
                                                                             style="margin-right: 8px"></i>назад</a></p>
            <form action="{{ route('profile.settings.update') }}" method="POST" class="my-3 mt-5">
                @csrf
                @method('PUT')
                <h5>Личные данные</h5>
                <div style="display:flex; column-gap: 20px; flex-wrap: wrap;">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Имя</label>
                        <input id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                            <label for="last_name" class="col-form-label">Фамилия</label>
                            <input id="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                   name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                            @error('last_name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="middle_name" class="col-form-label">Отчество</label>
                            <input id="middle_name" class="form-control @error('middle_name') is-invalid @enderror"
                                   name="middle_name" value="{{ old('middle_name', $user->middle_name) }}">
                            @error('middle_name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                    <div class="form-group">
                        <label for="phone" class="col-form-label">Телефон</label>
                        <input id="phone" class="form-control phone-input @error('phone') is-invalid @enderror"
                               name="phone"
                               value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <hr>

                @if($user->isIndividual())
                    <h5>Данные физ лица</h5>
                    <div style="display:flex; column-gap: 20px; flex-wrap: wrap;">
                        <div class="form-group">
                            <label for="passport_serial" class="col-form-label">Серия паспорта</label>
                            <input id="passport_serial"
                                   class="form-control @error('passport_serial') is-invalid @enderror"
                                   name="passport_serial"
                                   value="{{ old('passport_serial', $user->passport_serial) }}">
                            @error('passport_serial')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="passport_code" class="col-form-label">Номер паспорта</label>
                            <input id="passport_code"
                                   class="form-control @error('passport_code') is-invalid @enderror"
                                   name="passport_code" value="{{ old('passport_code', $user->passport_code) }}">
                            @error('passport_code')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="passport_issue" class="col-form-label">Кем выдан</label>
                            <input id="passport_issue"
                                   class="form-control @error('passport_issue') is-invalid @enderror"
                                   name="passport_issue"
                                   value="{{ old('passport_issue', $user->passport_issue ) }}">
                            @error('passport_issue')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="passport_issue_date" class="col-form-label">Дата выдачи</label>
                            <input id="passport_issue_date"
                                   class="form-control @error('passport_issue_date') is-invalid @enderror"
                                   name="passport_issue_date"
                                   value="{{ old('passport_issue_date', $user->passport_issue_date? $user->passport_issue_date->format('d.m.Y') : '') }}">
                            @error('passport_issue_date')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                @else
                    <h5>Данные компании</h5>
                    <div style="display:flex; column-gap: 20px; flex-wrap: wrap;">
                        <div class="form-group">
                            <label for="company_name" class="col-form-label">Название компании</label>
                            <input id="company_name"
                                   class="form-control @error('company_name') is-invalid @enderror"
                                   name="company_name" value="{{ old('company_name', $user->company_name) }}">
                            @error('company_name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-grosup">
                            <label for="company_address" class="col-form-label">Юридический адрес</label>
                            <input id="company_address"
                                   class="form-control @error('company_address') is-invalid @enderror"
                                   name="company_address"
                                   value="{{ old('company_address', $user->company_address) }}">
                            @error('company_address')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_inn" class="col-form-label">ИНН</label>
                            <input id="company_inn" class="form-control @error('company_inn') is-invalid @enderror"
                                   name="company_inn" value="{{ old('company_inn', $user->company_inn) }}">
                            @error('company_inn')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_account" class="col-form-label">Расчетный счет</label>
                            <input id="company_account"
                                   class="form-control @error('company_account') is-invalid @enderror"
                                   name="company_account"
                                   value="{{ old('company_account', $user->company_account) }}">
                            @error('company_account')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_kpp" class="col-form-label">КПП</label>
                            <input id="company_kpp"
                                   class="form-control @error('company_kpp') is-invalid @enderror"
                                   name="company_kpp"
                                   value="{{ old('company_kpp', $user->company_kpp) }}">
                            @error('company_kpp')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_ogrn" class="col-form-label">ОГРН</label>
                            <input id="company_ogrn"
                                   class="form-control @error('company_ogrn') is-invalid @enderror"
                                   name="company_ogrn"
                                   value="{{ old('company_ogrn', $user->company_ogrn) }}">
                            @error('company_ogrn')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_kc" class="col-form-label">К/С</label>
                            <input id="company_kc"
                                   class="form-control @error('company_kc') is-invalid @enderror"
                                   name="company_kc"
                                   value="{{ old('company_kc', $user->company_kc) }}">
                            @error('company_kc')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_bik" class="col-form-label">БИК</label>
                            <input id="company_bik"
                                   class="form-control @error('company_bik') is-invalid @enderror"
                                   name="company_bik"
                                   value="{{ old('company_bik', $user->company_bik) }}">
                            @error('company_bik')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_phone" class="col-form-label">Телефон компании (мессенджер)</label>
                            <input id="company_phone"
                                   class="form-control @error('company_phone') is-invalid @enderror"
                                   name="company_phone"
                                   value="{{ old('company_phone', $user->company_phone) }}">
                            @error('company_phone')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_site" class="col-form-label">Сайт компании</label>
                            <input id="company_site"
                                   class="form-control @error('company_site') is-invalid @enderror"
                                   name="company_site"
                                   value="{{ old('company_site', $user->company_site) }}">
                            @error('company_site')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_email" class="col-form-label">Эл.почта компании</label>
                            <input id="company_email"
                                   class="form-control @error('company_email') is-invalid @enderror"
                                   name="company_email"
                                   value="{{ old('company_email', $user->company_email) }}">
                            @error('company_email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <button class="btn yellow-btn">
                        Обновить
                    </button>
                </div>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', init, false);

                function init() {
                    const input = document.querySelector(".phone-input");
                    const prefixNumber = (str) => {
                        if (str === "7") {
                            return "7 (";
                        }
                        if (str === "8") {
                            return "8 (";
                        }
                        if (str === "9") {
                            return "7 (9";
                        }
                        return "7 (";
                    };
                    input.addEventListener("input", (e) => {
                        const value = input.value.replace(/\D+/g, "");
                        const numberLength = 11;
                        let result;
                        if (input.value.includes("+8") || input.value[0] === "8") {
                            result = "";
                        } else {
                            result = "+";
                        }
                        for (let i = 0; i < value.length && i < numberLength; i++) {
                            switch (i) {
                                case 0:
                                    result += prefixNumber(value[i]);
                                    continue;
                                case 4:
                                    result += ") ";
                                    break;
                                case 7:
                                    result += "-";
                                    break;
                                case 9:
                                    result += "-";
                                    break;
                                default:
                                    break;
                            }
                            result += value[i];
                        }
                        input.value = result;
                    });
                }
            </script>
        </div>
    </div>
@endsection
