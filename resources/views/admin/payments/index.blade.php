@extends('layouts.admin')

@section('content')
    @include('admin._nav', ['route' => 'payments'])

    <div class="card mb-3">
        <div class="card-header">Фильтр</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-form-label">ID</label>
                            <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="user_id" class="col-form-label">ID пользователя</label>
                            <input id="user_id" class="form-control" name="user_id" value="{{ request('user_id') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="amount" class="col-form-label">Сумма</label>
                            <input id="amount" class="form-control" name="amount" value="{{ request('amount') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="status" class="col-form-label">Статус</label>
                            <select id="status" class="form-control" name="status">
                                <option value=""></option>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}"{{ $value === request('status') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary">Найти</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Статус</th>
            <th>Сумма</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>
                    <a href="{{ route('admin.users.show', $payment) }}">
                        {{ $payment->user->getFullName() }}
                    </a>
                </td>
                <td>{{ $payment->getStatus() }}</td>
                <td>{{ $payment->amount }}</td>
                <td>
                    @if($payment->notFinished())
                        <div class="row">
                            <form action="{{ route('admin.payments.accept', $payment) }}" method="POST">
                                @csrf
                                <button class="mx-3 btn btn-success">Подтвердить</button>
                            </form>
                            <form action="{{ route('admin.payments.reject', $payment) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger">Отклонить</button>
                            </form>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $payments->links() }}
@endsection
