<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasMany(\App\Models\DormitoryDetail::class,'dormitory_id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class,'dormitory_details','dormitory_id','room_id');
    }

    protected $table = 'dormitories';
}
