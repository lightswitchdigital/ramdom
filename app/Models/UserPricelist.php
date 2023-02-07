<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPricelist extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'user_pricelists';
    protected $fillable = [
        'user_id', 'data'
    ];
    protected $casts = [
        'data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
