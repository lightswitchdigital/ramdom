<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    protected $fillable = [
        'name', 'slug', 'kladr'
    ];

    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFindKladr($query, $kladr) {
        return $query->where('kladr', $kladr);
    }
}
