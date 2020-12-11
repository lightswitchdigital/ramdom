<?php

namespace App\Models\Plans;

use App\Models\User;
use Carbon\Carbon;
use DB;
use DomainException;
use Illuminate\Database\Eloquent\Model;

class PlanSubscription extends Model
{

    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_ACTIVE = 'active';

    protected $table = 'plan_subscriptions';

    protected $fillable = [
        'plan_id', 'user_id', 'active', 'starts_at', 'ends_at', 'canceled_at'
    ];

    public $timestamps = true;

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'canceled_at' => 'datetime',
    ];

    public static function statusesList() {
        return [
            self::STATUS_INACTIVE => 'Не активна',
            self::STATUS_ACTIVE => 'Активна'
        ];
    }

    public function getStatus() {
        return self::statusesList()[$this->status];
    }

    public function isActive() {
        return $this->active;
    }

    public function canceled(): bool
    {
        return $this->canceled_at ? Carbon::now()->gte($this->canceled_at) : false;
    }

    public function ended(): bool
    {
        return $this->ends_at ? Carbon::now()->gte($this->ends_at) : false;
    }

    public function cancel($immediately = false)
    {
        $this->canceled_at = Carbon::now();

        if ($immediately) {
            $this->ends_at = $this->canceled_at;
        }

        $this->save();

        return $this;
    }

    public function renew() {
        if ($this->ended() && $this->canceled()) {
            throw new DomainException('Unable to renew canceled ended subscription.');
        }

        $subscription = $this;

        DB::transaction(function () use ($subscription) {

            $subscription->setNewInterval();
            $subscription->canceled_at = null;
            $subscription->active = true;
            $subscription->save();

        });

        return $this;
    }

    public function changePlan(Plan $plan) {

        $this->plan_id = $plan->getKey();
        $this->save();

        if ($this->plan->interval !== $plan->interval) {
            $this->setNewInterval();
        }

    }

    public function setNewInterval() {
        $interval = $this->plan->getIntervalInDays();

        $this->starts_at = Carbon::now();
        $this->ends_at = $this->starts_at->addDays($interval);

        $this->update();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function scopeFindEndingPeriod($query, int $dayRange = 3)
    {
        $from = Carbon::now();
        $to = Carbon::now()->addDays($dayRange);

        return $query->whereBetween('ends_at', [$from, $to]);
    }

    public function scopeFindEndedPeriod($query)
    {
        return $query->where('ends_at', '<=', now());
    }
}
