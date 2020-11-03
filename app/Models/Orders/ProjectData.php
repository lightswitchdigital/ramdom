<?php

namespace App\Models\Orders;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Model;

class ProjectData extends Model
{
    protected $table = 'order_project_data';

    protected $fillable = [
        'order_id', 'project_id', 'data', 'total_price'
    ];

    public $timestamps = false;

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
