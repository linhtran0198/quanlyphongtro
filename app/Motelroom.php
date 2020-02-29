<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
class Motelroom extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    protected $table = "motelrooms";
    public function category(){
    	return $this->belongsTo('App\Categories','category_id','id');
    }
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    public function district(){
    	return $this->belongsTo('App\District','district_id','id');
    } 
    public function reports(){
        return $this->hasMany('App\Reports','id_motelroom','id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
