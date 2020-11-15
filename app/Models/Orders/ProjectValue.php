<?php

namespace App\Models\Orders;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Model;

class ProjectValue extends Model
{
    protected $table = 'order_project_values';

    protected $fillable = [
        'order_id', 'project_id', 'attribute_id', 'value'
    ];

    public $timestamps = false;

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function attribute() {
        return $this->belongsTo(ProjectAttribute::class);
    }
}
