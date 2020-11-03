<?php

namespace App\Models;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedProject extends Model
{
    protected $table = 'user_saved_projects';

    protected $fillable = [
        'user_id', 'project_id', 'data', 'values_data'
    ];

    protected $casts = [
        'values_data' => 'array'
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
