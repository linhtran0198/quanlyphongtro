<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Categories extends Model
{

    protected $table ="categories";
    public function motelroom(){
    	return $this->hasMany('App\Motelroom','category_id','id');
    }
}
 