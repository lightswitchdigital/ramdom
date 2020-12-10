<?php

namespace App\Models\Projects\Purchase;

use App\Models\Projects\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Storage;

class PurchasedProject extends Model
{
    protected $table = 'purchased_projects';

    protected $fillable = [
        'user_id', 'project_id', 'data', 'price'
    ];

    protected $appends = [
        'route', 'jsonValues',
        'orderLink'
    ];

    public $timestamps = true;

    public function getJsonValuesAttribute() {
        $values = [];
        $attributes = PurchaseAttribute::all();
        foreach ($attributes as $attribute) {
            $values[$attribute->name] = $this->getValue($attribute->id);
        }

        return $values;
    }

    public function getOrderLinkAttribute() {
        return route('profile.projects.order', $this);
    }

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
