<?php

namespace App\Models;

use App\Models\Plans\PlanSubscription;
use App\Models\Projects\Project;
use App\Models\Projects\Purchase\PurchasedProject;
use App\Models\Projects\SavedProject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    public const ROLE_CUSTOMER = 'customer';
    public const ROLE_PRO = 'pro';
    public const ROLE_DEVELOPER = 'developer';
    public const ROLE_ADMIN = 'admin';

    public const TYPE_INDIVIDUAL = 'individual';
    public const TYPE_ENTITY = 'entity';

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'name', 'last_name', 'middle_name', 'email', 'phone', 'password', 'role', 'type', 'status',
        'passport_serial', 'passport_code', 'passport_issue', 'passport_issue_date',
        'company_name', 'company_address', 'company_inn', 'company_account',
        'developer_desc', 'balance'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'passport_issue_date' => 'date'
    ];

    public static function rolesList() {
        return [
            self::ROLE_CUSTOMER => 'Заказчик',
            self::ROLE_PRO => 'Профессионал',
            self::ROLE_DEVELOPER => 'Застройщик',
        ];
    }

    public static function adminRolesList() {
        return [
            self::ROLE_CUSTOMER => 'Заказчик',
            self::ROLE_PRO => 'Профессионал',
            self::ROLE_DEVELOPER => 'Застройщик',
            self::ROLE_ADMIN => 'Админ'
        ];
    }

    public function getRole() {
        return self::adminRolesList()[$this->role];
    }

    public static function typesList() {
        return [
            self::TYPE_INDIVIDUAL => 'Физическое лицо',
            self::TYPE_ENTITY => 'Юридическое лицо'
        ];
    }

    public function getType() {
        return self::typesList()[$this->type];
    }

    public static function statusesList() {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_WAIT => 'Неактивен'
        ];
    }

    public function getStatus() {
        return self::statusesList()[$this->status];
    }

    public function getFullName() {
        return implode(' ', [$this->middle_name, $this->name, $this->last_name]);
    }

    public static function register($name, $last_name, $email, $phone, $role, $type, $password) {
        return static::create([
            'name' => $name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'password' => bcrypt($password),
            'email_verify_token' => Str::uuid(),
            'status' => self::STATUS_WAIT,
            'role' => $role,
            'type' => $type,
            'balance' => 0
        ]);
    }

    public function withholdFromBalance($amount)
    {
        if ($this->balance < $amount)
            throw new \DomainException('Недостаточно средств на балансе');

        $current = $this->balance;
        $this->update([
            'balance' => $current - $amount
        ]);
    }

    public function addToBalance($amount)
    {
        $current = $this->balance;
        $this->update([
            'balance' => $current + $amount
        ]);
    }


    public function isCustomer()
    {
        return $this->role === self::ROLE_CUSTOMER;
    }

    public function isPro()
    {
        return $this->role === self::ROLE_PRO;
    }

    public function isDeveloper() {
        return $this->role === self::ROLE_DEVELOPER;
    }

    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isIndividual() {
        return $this->type === self::TYPE_INDIVIDUAL;
    }

    public function isEntity() {
        return $this->type === self::TYPE_ENTITY;
    }

    public function isWait() {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive() {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function hasInFavorites(Project $project): bool
    {
        return $this->favorites()->where('id', $project->id)->exists();
    }

    public function addToFavorites($project_id) {
        $project = Project::find($project_id);

        if (!$project)
            abort(404);

        $this->favorites()->attach($project_id);
    }

    public function removeFromFavorites($project_id)
    {
        $project = Project::find($project_id);

        if (!$project)
            abort(404);

        $this->favorites()->detach($project_id);
    }

    public function hasFilledEntityInformation(): bool
    {
        return $this->company_name
            and $this->company_address
            and $this->company_inn
            and $this->company_account;
    }

    /////////////////
    /// Relations

    public function subscription()
    {
        return $this->hasOne(PlanSubscription::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Project::class, 'project_favorites', 'user_id', 'project_id');
    }

    public function purchasedProjects()
    {
        return $this->hasMany(PurchasedProject::class);
    }

    public function savedProjects()
    {
        return $this->hasMany(SavedProject::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    ////////////////
    /// Scopes

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeDevelopers($query)
    {
        return $query->where('role', self::ROLE_DEVELOPER);
    }

    public function scopeHasFavorites($query)
    {
        return $query->has('favorites');
    }
}
