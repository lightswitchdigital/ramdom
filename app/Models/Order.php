<?php

namespace App\Models;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public const STATUS_CREATED = 'created';
    public const STATUS_FINISHED = 'finished';

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'project_id', 'developer_id',
        'order_name', 'order_email', 'order_phone', 'order_city', 'order_address', 'order_postal_code',
        'order_passport_serial', 'order_passport_number', 'order_passport_issue', 'order_passport_issue_date',
        'order_company_name', 'order_company_address', 'order_company_inn', 'order_company_kpp', 'order_company_payment_account', 'order_company_correspondent_account',
        'price', 'status'
    ];

    public $timestamps = true;

    public static function statusesList() {
        return [
            self::STATUS_CREATED => 'Создан',
            self::STATUS_FINISHED => 'Закончен'
        ];
    }

    public function getStatus() {
        return self::statusesList()[$this->status];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function developer() {
        return $this->belongsTo(User::class);
    }
}
