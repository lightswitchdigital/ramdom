<?php

namespace App\Models\Projects\Purchase;

use App\Models\Projects\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PurchasedProject extends Model
{
    protected $table = 'purchased_projects';

    protected $fillable = [
        'user_id', 'project_id', 'data', 'price'
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function getValue($id) {
        foreach ($this->values as $value) {
            if ($value->attribute_id === $id) {
                return $value->value;
            }
        }
        return null;
    }


    public function values() {
        return $this->hasMany(PurchaseValue::class, 'purchased_project_id', 'id');
    }
}
