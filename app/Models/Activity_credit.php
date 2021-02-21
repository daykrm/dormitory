<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity_credit extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'activity_id'
    ];

    public function student(){
        return $this->belongsTo(User::class,'student_id');
    }
}
