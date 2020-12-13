<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id', 'title', 'content', 'seen', 'expires_at'
    ];

    public $timestamps = true;

    public static function generate($params) {
        return Notification::create(array_merge([
            'expires_at' => Carbon::now()->addDays(env('NOTIFICATIONS_EXPIRE_DAYS')),
            'seen' => false
        ], $params));
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeNotSeen($query) {
        return $query->where('seen', false);
    }

    public function scopeFindExpired($query) {
        return $query->where('expires_at', '<=', Carbon::now());
    }
}
