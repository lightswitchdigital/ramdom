<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public const ROLE_CUSTOMER = 'customer';
    public const ROLE_PRO = 'pro';
    public const ROLE_DEVELOPER = 'developer';
    public const ROLE_ADMIN = 'admin';

    public const TYPE_INDIVIDUAL = 'individual';
    public const TYPE_ENTITY = 'entity';

    protected $fillable = [
        'name', 'last_name', 'middle_name', 'email', 'phone', 'password', 'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'passport_issue_date' => 'date'
    ];

    public function rolesList() {
        return [
            self::ROLE_CUSTOMER => 'Заказчик',
            self::ROLE_PRO => 'Профессионал',
            self::ROLE_DEVELOPER => 'Застройщик',
        ];
    }

    public function adminRolesList() {
        return [
            self::ROLE_CUSTOMER => 'Заказчик',
            self::ROLE_PRO => 'Профессионал',
            self::ROLE_DEVELOPER => 'Застройщик',
            self::ROLE_ADMIN => 'Админ'
        ];
    }

    public function getRole() {
        return self::rolesList()[$this->role];
    }

    public function typesList() {
        return [
            self::TYPE_INDIVIDUAL => 'Физическое лицо',
            self::TYPE_ENTITY => 'Юридическое лицо'
        ];
    }

    public function getType() {
        return self::typesList()[$this->type];
    }

    public function isCustomer() {
        return $this->role === self::ROLE_CUSTOMER;
    }

    public function isPro() {
        return $this->role === self::ROLE_PRO;
    }

    public function isDeveloper() {
        return $this->role === self::ROLE_DEVELOPER;
    }

    public function isIndividual() {
        return $this->type === self::TYPE_INDIVIDUAL;
    }

    public function isEntity() {
        return $this->type === self::TYPE_ENTITY;
    }
}
