@extends('layouts.app')

@section('content')
    <div class="order-block ">

        <div class="container">
            <form>
                <developers
                    :developers="{{ $developers }}"
                    :user="{{ \Auth::user() }}"
                ></developers>
                {{-- <div class="wrapper-form">
                    <div class="agree-form">
                    <h2 class="title">Введите данные для оформления договора</h2>
                    <input type="text" class="form-control" placeholder="Имя">
                    <input type="text" class="form-control" placeholder="E-mail">
                    <input type="text" class="form-control" placeholder="Телефон">
                    <input type="text" class="form-control" placeholder="Город">
                    <input type="text" class="form-control" placeholder="Адрес">
                    <input type="text" class="form-control" placeholder="Индекс">
                    <br>
                    <input type="text" class="form-control" placeholder="Название компании">
                    <input type="text" class="form-control" placeholder="ИНН">
                    <input type="text" class="form-control" placeholder="КПП">
                    <input type="text" class="form-control" placeholder="Платежный счет">
                    <input type="text" class="form-control" placeholder="Корреспондентский счет">
                    <br>
                    <input type="text" class="form-control" placeholder="Серия паспорта">
                    <input type="text" class="form-control" placeholder="Номер паспорта">
                    <input type="text" class="form-control" placeholder="Где оформлен">
                    <input type="text" class="form-control" placeholder="Дата оформления">
                    <button type="submit" class="btn yellow-btn">Отправить</button>
                </div> --}}
            </form>
            <order/>
    </div>
</div>

@endsection
