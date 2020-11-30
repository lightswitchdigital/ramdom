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
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="status" class="col-form-label">Шлюз</label>
                            <select id="status" class="form-control" name="status">
                                <option value=""></option>
                                @foreach ($gateways as $value => $label)
                                    <option value="{{ $value }}"{{ $value === request('gateway') ? ' selected' : '' }}>{{ $label }}</option>
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
            <th>Статус</th>
            <th>Сумма</th>
            <th>Шлюз</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($payments as $payment)
            <tr>
                <td>
                    <a href="{{ route('admin.payments.show', $payment) }}">
                        {{ $payment->id }}
                    </a>
                </td>
                <td>{{ $payment->getStatus() }}</td>
                <td>{{ $payment->amount }}</td>
                <td>{{ $payment->getGateway() }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $payments->links() }}
@endsection
