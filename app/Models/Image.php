<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'file'
    ];

    public $timestamps = true;

    public function imageable() {
        return $this->morphTo();
    }
}
