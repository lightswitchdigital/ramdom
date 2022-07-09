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

    protected $casts = [
        'seen' => 'bool'
    ];

    protected $appends = [
        'sinceCreated'
    ];

    public $timestamps = true;

    public static function generate($params) {
        return Notification::create(array_merge([
            'expires_at' => Carbon::now()->addDays(env('NOTIFICATIONS_EXPIRE_DAYS')),
            'seen' => false
        ], $params));
    }

    public function getSinceCreatedAttribute() {
        $since = (string) Carbon::now()->diffInHours($this->created_at);

        $result = '';

        if ($since > 24) {

            $since = (string) Carbon::now()->diffInDays($this->created_at);

            $result =  $since . ' дней назад';

            if ($since == 0) {
                $result = 'Только что';
            }elseif (((strlen($since) > 1 && $since[-1] == '1') || $since == "1") && $since !== '11') {
                $result = $since . ' день назад';
            }elseif ((strlen($since) > 0 && in_array($since[-1], ['2', '3', '4'])) || in_array($since, ['2', '3', '4'])) {
                $result = $since . ' дня назад';
            }elseif ((strlen($since) > 0 && in_array($since[-1], ['5', '6', '7', '8', '9'])) || in_array($since, ['5', '6', '7', '8', '9']) || $since == '11') {
                $result = $since . ' дней назад';
            }elseif (strlen($since) > 1 && $since[-1] == "0") {
                $result = $since . ' дней назад';
            }

        }else {

            if ($since == 0) {
                $result = 'Только что';
            }elseif (((strlen($since) > 1 && $since[-1] == '1') || $since == "1") && $since !== '11') {
                $result = $since . ' час назад';
            }elseif ((strlen($since) > 0 && in_array($since[-1], ['2', '3', '4'])) || in_array($since, ['2', '3', '4'])) {
                $result = $since . ' часа назад';
            }elseif ((strlen($since) > 0 && in_array($since[-1], ['5', '6', '7', '8', '9'])) || in_array($since, ['5', '6', '7', '8', '9']) || $since == '11') {
                $result = $since . ' часов назад';
            }elseif (strlen($since) > 1 && $since[-1] == "0") {
                $result = $since . ' часов назад';
            }

        }

        return $result;
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
