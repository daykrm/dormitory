<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function dorm()
    {
        return $this->belongsTo(Dormitory::class,'dorm_id');
    }

    public function sub_dist_fa(){
        return $this->belongsTo(SubDistrict::class,'sub_district_id_fa');
    }

    public function sub_dist_mo(){
        return $this->belongsTo(SubDistrict::class,'sub_district_id_mo');
    }

    public function sub_dist_sp(){
        return $this->belongsTo(SubDistrict::class,'sub_district_id_sp');
    }

    public function occ_fa(){
        return $this->belongsTo(Occupation::class,'occupation_fa');
    }

    public function occ_mo(){
        return $this->belongsTo(Occupation::class,'occupation_mo');
    }

    public function occ_sp(){
        return $this->belongsTo(Occupation::class,'occupation_sp');
    }

    public function marital(){
        $status = $this->marital_status;
        if($status == 1) return 'อยู่ด้วย';
        if($status == 2) return 'แยกกันอยู่';
        if($status == 3) return 'หย่าร้าง'; 
    }
}
