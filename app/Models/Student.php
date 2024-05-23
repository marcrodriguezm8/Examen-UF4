<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'birthDate',
        'course_id'
    ];

    public function courses()
    {
        return $this->hasOne(Course::class);
    }
}
