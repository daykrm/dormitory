<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'prefix_id',
        'dob',
        'phone',
        'enrolled_year',
        'dorm_detail_id',
        'province_id',
        'faculty_id',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function year()
    {
        $year = YearConfig::find(1);
        return $year->year - $this->enrolled_year;
    }

    public function type()
    {
        return $this->belongsTo(UserType::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function dorm()
    {
        return $this->belongsTo(DormitoryDetail::class, 'dorm_detail_id');
    }

    public function prefix()
    {
        return $this->belongsTo(Prefix::class, 'prefix_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity_credit::class, 'student_id');
    }
}
