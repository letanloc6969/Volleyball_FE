<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    public $timestamps = false;
    protected $guarded =[];
    protected $primaryKey = 'fee_id';
    protected $table = 'feeships';

    public function city(){
        return $this->belongsTo(City::class,'fee_matp');
    }
    public function province(){
        return $this->belongsTo(Province::class,'fee_maqh');
    }
    public function wards(){
        return $this->belongsTo(Ward::class,'fee_xaid');
    }
}
