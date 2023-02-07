<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    use HasFactory;

    public const STATUS_UNWATCHED = 'unwatched';
    public const STATUS_WATCHED = 'watched';
    public $timestamps = true;
    protected $table = 'loan_requests';
    protected $fillable = [
        'user_id', 'text', 'build_request_id', 'status', 'amount',
        'passport_1', 'passport_2', 'inn', 'snils', 'place', 'floor_plan', 'smeta'
    ];

    public function getStatus()
    {
        return self::statusesList()[$this->status];
    }

    public static function statusesList()
    {
        return [
            self::STATUS_UNWATCHED => 'Непросмотрен',
            self::STATUS_WATCHED => 'Просмотрен'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buildRequest()
    {
        return $this->belongsTo(BuildRequest::class);
    }
}
