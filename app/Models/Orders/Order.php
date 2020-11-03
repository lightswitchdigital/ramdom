<?php

namespace App\Models\Orders;

use App\Models\Projects\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public const STATUS_CREATED = 'created';
    public const STATUS_FINISHED = 'finished';

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'project_id', 'order_name', 'order_email', 'order_phone', 'amount', 'status'
    ];

    public $timestamps = true;

    public static function statusesList() {
        return [
            self::STATUS_CREATED => 'Создан',
            self::STATUS_FINISHED => 'Произведен'
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
}
