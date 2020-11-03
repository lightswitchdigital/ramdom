<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'order_project_values';

    public $timestamps = false;

    protected $fillable = [
        'project_id', 'attribute_id', 'value'
    ];
}
