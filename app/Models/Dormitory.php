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

    protected $table = 'dormitories';
}
