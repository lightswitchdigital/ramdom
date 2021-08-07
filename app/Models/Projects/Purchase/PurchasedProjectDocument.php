<?php

namespace App\Models\Projects\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedProjectDocument extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'purchased_project_documents';
    protected $fillable = [
        'purchased_project_id', 'file'
    ];

    public function purchased_project()
    {
        return $this->belongsTo(PurchasedProject::class);
    }
}
