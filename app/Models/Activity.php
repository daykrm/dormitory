<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'dorm_id', 'name', 'detail', 'budget', 'year', 'activity_date', 'credit'
    ];

    public function dorm()
    {
        return $this->belongsTo(Dormitory::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'activity_credits', 'activity_id', 'student_id');
    }
}
