<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function count;

class Attribute extends Model
{

    public const TYPE_STRING = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_FLOAT = 'float';

    protected $table = 'project_attributes';

    public $timestamps = false;

    protected $fillable = [
        'name', 'type', 'required', 'default', 'variants', 'sort'
    ];

    protected $casts = [
        'variants' => 'array'
    ];

    public static function typesList() {
        return [
            self::TYPE_STRING => 'Строка',
            self::TYPE_INTEGER => 'Число',
            self::TYPE_FLOAT => 'Дробное',
        ];
    }

    public function getType() {
        return self::typesList()[$this->type];
    }

    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isNumber(): bool
    {
        return $this->isInteger() || $this->isFloat();
    }

    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }
}
