<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public const STATUS_CREATED = 'created';
    public const STATUS_FINISHED = 'finished';
    public const STATUS_EXPIRED = 'expired';

    public const GATEWAY_YANDEX = 'yandex';

    protected $table = 'payments';

    protected $fillable = [
        'user_id', 'amount', 'gateway', 'status'
    ];

    public $timestamps = true;

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    public static function statusesList() {
        return [
            self::STATUS_CREATED => 'Создана',
            self::STATUS_FINISHED => 'Закончена',
        ];
    }

    public function getStatus() {
        return self::statusesList()[$this->status];
    }

    public static function gatewaysList() {
        return [
            self::GATEWAY_YANDEX => 'Яндекс касса',
        ];
    }

    public function getGateway() {
        return self::gatewaysList()[$this->gateway];
    }


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeCreated($query) {
        return $query->where('status', self::STATUS_CREATED);
    }

    public function scopeFindExpired($query) {
        return $query->where('ends_at', '<=', now());
    }
}
