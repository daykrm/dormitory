<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormitoryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'dormitory_id',
        'room_id'
    ];

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    protected $table = 'dormitory_details';
}
