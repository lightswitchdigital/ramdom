<?php

namespace App\Models\Projects;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SavedProject extends Model
{
    protected $table = 'user_saved_projects';

    protected $fillable = [
        'user_id', 'project_id', 'data', 'values_data', 'editor_data'
    ];

    protected $casts = [
        'values_data' => 'array',
        'editor_data' => 'array'
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
