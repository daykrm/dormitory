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
}
