<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'project_values';

    public $timestamps = false;

    protected $fillable = [
        'project_id', 'attribute_id', 'value'
    ];

    public function project() {
        $this->belongsTo(Project::class);
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }
}
