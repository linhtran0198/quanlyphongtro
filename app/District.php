<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    public function motelroom(){
    	return $this->hasMany('App\Motelroom','district_id','id');
    }
}
 