<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UsersExport implements FromQuery, WithMapping, WithHeadings
{

    public function query()
    {
        return User::query();
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->last_name,
            $user->middle_name,
            $user->email,
            $user->phone,
            $user->getStatus(),
            $user->getRole(),
            $user->getType(),
            $user->passport_serial,
            $user->passport_code,
            $user->passport_issue,
            $user->passport_issue_date ? Carbon::parse($user->passport_issue_date)->format('d-m-Y') : null,
            $user->company_name,
            $user->company_address,
            $user->company_inn,
            $user->company_account,
            $user->company_kpp,
            $user->company_ogrn,
            $user->company_kc,
            $user->company_bik,
            $user->company_phone,
            $user->company_site,
            $user->company_email,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'passport_birthday' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'passport_issue_date' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function headings(): array
    {
        return [
            'Имя',
            'Фамилия',
            'Отчество',
            'Эл. почта',
            'Телефон',
            'Статус',
            'Роль',
            'Тип',
            'Серия паспорта',
            'Номер паспорта',
            'Место выдачи',
            'Дата выдачи',

            'Название компании',
            'Адрес компании',
            'ИНН',
            'Рас. счет',
            'КПП',
            'ОГРН',
            'К/С',
            'БИК',
            'Телефон компании',
            'Сайт компании',
            'Эл.почта компании',
        ];
    }
}
