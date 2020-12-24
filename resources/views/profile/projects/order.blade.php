@extends('layouts.app')

@section('content')
<div class="order-block">
    <div class="container">
        <form class="agree-form">
            <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
                </div>
            </div>
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">...</div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <h2 class="title">Основные данные</h2>
                    <input type="text" class="form-control" placeholder="Имя"
                    >
                    <input type="text" class="form-control" placeholder="E-mail"
                    >
                    <input type="text" class="form-control" placeholder="Телефон"
                    >
                    <input type="text" class="form-control" placeholder="Город"
                    >
                    <input type="text" class="form-control" placeholder="Адрес"
                    >
                    <input type="text" class="form-control" placeholder="Индекс"
                    >
                </div>
                <div class="col-md">
                    <div>
                        <h2 class="title">Данные компании</h2>
                        <input type="text" class="form-control" placeholder="Название компании"
                        >
                        <input type="text" class="form-control" placeholder="ИНН"
                        >
                        <input type="text" class="form-control" placeholder="КПП"
                        >
                        <input type="text" class="form-control" placeholder="Платежный счет"
                        >
                        <input type="text" class="form-control" placeholder="Корреспондентский счет"
                        >
                    </div>
                    <div>
                        <h2 class="title">Паспортные данные</h2>
                        <input type="text" class="form-control" placeholder="Серия паспорта"
                        >
                        <input type="text" class="form-control" placeholder="Номер паспорта"
                        >
                        <input type="text" class="form-control" placeholder="Где оформлен"
                        >
                        <input type="text" class="form-control" placeholder="Дата оформления"
                        >
                    </div>
                </div>
            </div>
            <button type="submit" class="btn yellow-btn">Отправить</button>
        </form>
    </div>
</div>
    {{-- <order></order> --}}
@endsection
