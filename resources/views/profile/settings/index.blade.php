@extends('layouts.app')

@section('content')
    <div class="settings-block">
        <div class="container">
            <form action="{{ route('profile.settings.update') }}" method="POST" class="my-3 col-md">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="my-3 col-md">
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
                            <input id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                   value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <div class="my-3 col-md">
                        @if($user->isIndividual())
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
                        @else
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
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn yellow-btn">
                        Обновить
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
