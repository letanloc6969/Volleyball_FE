<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $timestamps = false;
    protected $guarded =[];
    protected $primaryKey = 'xaid';
    protected $table = 'ward';
}
