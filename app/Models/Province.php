<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'name_en', 'code', 'geography_id'
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
