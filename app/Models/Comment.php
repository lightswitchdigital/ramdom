<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';

    protected $fillable = [
        'user_id', 'text', 'anonymous', 'active'
    ];

    public $timestamps = true;

    public function commentable() {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query) {
        return $query->where('active', true);
    }

    public function scopeWait($query) {
        return $query->where('active', false);
    }

    public function scopeOfAdvice($query) {
        return $query->where('commentable_type', Advice::class);
    }
}
