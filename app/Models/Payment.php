<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public const TYPE_REPLENISHMENT = 'replenishment';
    public const TYPE_PAYMENT = 'payment';

    public const STATUS_PENDING = 'pending';
    public const STATUS_FINISHED = 'finished';

    protected $table = 'payments';

    protected $fillable = [
        'user_id', 'type', 'amount', 'status', 'meta'
    ];

    public function getType()
    {
        return self::typesList()[$this->type];
    }

    public static function typesList()
    {
        return [
            self::TYPE_REPLENISHMENT => 'Пополнение баланса',
            self::TYPE_PAYMENT => 'Оплата услуг'
        ];
    }

    public function getStatus()
    {
        return self::statusesList()[$this->status];
    }

    public static function statusesList()
    {
        return [
            self::STATUS_PENDING => 'Проводится',
            self::STATUS_FINISHED => 'Закончена'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notFinished()
    {
        return $this->status != self::STATUS_FINISHED;
    }
}
