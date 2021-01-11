<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceOperation extends Model
{

    public const TYPE_ADD = 'add';
    public const TYPE_SUBSCRIPTION_CHARGED = 'subscription_charged';
    public const TYPE_PROJECT_BOUGHT = 'project_bought';

    public const STATUS_PENDING = 'pending';
    public const STATUS_FINISHED = 'finished';
    public const STATUS_REJECTED = 'rejected';

    protected $table = 'balance_operations';

    protected $fillable = [
        'user_id', 'type', 'amount', 'status'
    ];

    public $timestamps = true;

    public static function typesList() {
        return [
            self::TYPE_ADD => 'Пополнение баланса',
            self::TYPE_PROJECT_BOUGHT => 'Покупка проекта',
            self::TYPE_SUBSCRIPTION_CHARGED => 'Оплата подписки',
        ];
    }

    public function getType() {
        return self::typesList()[$this->type];
    }

    public static function statusesList() {
        return [
            self::STATUS_PENDING => 'Выполняется',
            self::STATUS_FINISHED => 'Закончена',
            self::STATUS_REJECTED => 'Отклонена',
        ];
    }

    public function getStatus() {
        return self::statusesList()[$this->status];
    }

    public function notFinished() {
        return $this->status !== self::STATUS_FINISHED;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeTypeAdd($query) {
        return $query->where('type', self::TYPE_ADD);
    }
}
