<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'stud_id';
    public $timestamps = false; // dump has no created_at/updated_at on students

    // Example relationship: one student can have many parents
    public function parents()
    {
        return $this->hasMany(ParentModel::class, 'stud_id', 'stud_id');
    }
}
