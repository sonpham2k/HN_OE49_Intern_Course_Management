<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'credit',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function timeTables()
    {
        return $this->hasMany(TimeTable::class);
    }
}
