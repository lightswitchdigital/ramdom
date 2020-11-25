<?php

namespace App\Models\Projects;

use App\Models\Image;
use App\Models\User;
use DomainException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Project extends Model
{

    public const STATUS_ACTIVE = 'active';
    public const STATUS_CLOSED = 'closed';

    protected $table = 'projects';

    protected $fillable = [
        'user_id', 'title', 'slug', 'description', 'price', 'status'
    ];

    public $timestamps = true;

    public static function statusesList() {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_CLOSED => 'Закрыт',
        ];
    }

    public function getStatus() {
        return self::statusesList()[$this->status];
    }

    public function getValue($id)
    {
        foreach ($this->values as $value) {
            if ($value->attribute_id === $id) {
                return $value->value;
            }
        }
        return null;
    }

    public function addToFavorites($id): void
    {
        if ($this->hasInFavorites($id)) {
            throw new DomainException('Проект уже добавлен в избранные.');
        }
        $this->favorites()->attach($id);
    }

    public function removeFromFavorites($id): void
    {
        $this->favorites()->detach($id);
    }

    public function hasInFavorites($id): bool
    {
        return $this->favorites()->where('id', $id)->exists();
    }

    public function getImagesInJson(): string
    {
        $images = [];
        foreach ($this->images as $image) {
            $images[] = Storage::disk('public')->url($image->file);
        }
        $images = json_encode($images, JSON_UNESCAPED_UNICODE);

        return $images;
    }

    public function getValuesInJson() {
        $values = [];
        $attributes = Attribute::all();
        foreach ($attributes as $attribute) {
            $values[$attribute->name] = $this->getValue($attribute->id);
        }
        $values = json_encode($values, JSON_UNESCAPED_UNICODE);

        return $values;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function values()
    {
        return $this->hasMany(Value::class, 'project_id', 'id');
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'project_favorites', 'project_id', 'project_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeForUser(Builder $query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeFavoredByUser(Builder $query, User $user)
    {
        return $query->whereHas('favorites', function(Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
