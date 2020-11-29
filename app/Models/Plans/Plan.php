<?php

namespace App\Models\Plans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public const INTERVAL_MONTH = 'month';
    public const INTERVAL_YEAR = 'year';

    protected $table = 'plans';

    protected $fillable = [
        'name', 'slug', 'price', 'interval'
    ];

    public $timestamps = true;

    public static function intervalsList() {
        return [
            self::INTERVAL_MONTH => 'Месяц',
            self::INTERVAL_YEAR => 'Год'
        ];
    }

    public static function intervalsInDaysList() {
        return [
            self::INTERVAL_MONTH => 30,
            self::INTERVAL_YEAR => 365
        ];
    }

    public function getInterval() {
        return self::intervalsList()[$this->interval];
    }

    public function getIntervalInDays() {
        return self::intervalsInDaysList()[$this->interval];
    }

    public function isIntervalMonth() {
        return $this->interval === self::INTERVAL_MONTH;
    }

    public function isIntervalYear() {
        return $this->interval === self::INTERVAL_YEAR;
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function subscriptions() {
        return $this->hasMany(PlanSubscription::class);
    }
}
