<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Advice extends Model
{
    protected $table = 'advice';

    protected $fillable = [
        'title', 'content'
    ];

    protected $appends = [
        'imageUrl'
    ];

    public $timestamps = true;

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getImageUrlAttribute() {
        return Storage::disk('public')->url($this->image->file);
    }
}
