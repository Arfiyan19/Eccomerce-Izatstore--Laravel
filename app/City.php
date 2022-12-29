<?php

namespace App;

use Illuminate\Support\Facades\DB;


use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    // public function district(){
    // 	return $this->belongsToMany(District::class);
    // }

}
