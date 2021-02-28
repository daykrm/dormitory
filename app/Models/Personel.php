<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Personel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'prefix_id',
        'dorm_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function dorm()
    {
        return $this->belongsTo(Dormitory::class, 'dorm_id');
    }

    public function prefix()
    {
        return $this->belongsTo(Prefix::class, 'prefix_id');
    }
}
