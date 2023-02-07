<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSave extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'user_saves';
    protected $fillable = [
        'user_id', 'data', 'price'
    ];
    protected $casts = [
        'data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
