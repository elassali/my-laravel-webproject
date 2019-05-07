<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Season extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function sluggable()
    {
        return [
            'slug' => [
                'source' =>'fullname',
                'onUpdate' => true
            ]
        ]; 
    }
    public function getFullnameAttribute() {
        return $this->Serie->name.'-Season' . ' ' . $this->season_number; 
    }


    /////////////////////////////////////////////////////////////////////////////
    public function watchepisodes()
    {
        $this->hasMany('App\Watchepisode');
    }

    public function downepisodes()
    {
        $this->hasMany('App\Downloadepisode');
    }

   public function serie()
   {
       return $this->belongsTo('App\Serie');
   }
}
