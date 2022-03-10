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

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function timetables()
    {
        return $this->hasMany(TimeTable::class);
    }
}
