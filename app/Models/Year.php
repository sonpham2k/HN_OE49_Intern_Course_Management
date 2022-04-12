<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Year extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'begin',
        'end',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }
}
