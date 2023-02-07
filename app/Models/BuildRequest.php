<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildRequest extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';
    public $timestamps = true;
    protected $table = 'build_requests';
    protected $fillable = [
        'user_id', 'developer_id', 'status', 'text', 'data', 'price', 'building_price'
    ];
    protected $casts = [
        'data' => 'array'
    ];

    public function getStatus()
    {
        return self::statusesList()[$this->status];
    }

    public static function statusesList()
    {
        return [
            self::STATUS_ACTIVE => 'Активна',
            self::STATUS_ACCEPTED => 'Принята',
            self::STATUS_REJECTED => 'Отклонена'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id', 'id');
    }
}
