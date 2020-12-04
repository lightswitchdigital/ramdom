<?php

namespace App\Models\Projects\Purchase;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Model;

class PurchaseValue extends Model
{
    protected $table = 'purchase_project_values';

    protected $fillable = [
        'order_id', 'project_id', 'attribute_id', 'value'
    ];

    public $timestamps = false;

    public function purchased_project() {
        return $this->belongsTo(PurchasedProject::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function attribute() {
        return $this->belongsTo(PurchaseAttribute::class);
    }
}
