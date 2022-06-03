<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['group_name', 'project_id'];

    public function projects() {
        return $this->belongsTo(Project::class);
    }

    public function students() {
        return $this->belongsToMany(Student::class);
    }
}
