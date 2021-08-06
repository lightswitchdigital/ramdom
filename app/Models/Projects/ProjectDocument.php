<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDocument extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'project_documents';
    protected $fillable = [
        'project_id', 'file'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
