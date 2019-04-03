<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Serie extends Model
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
        return $this->name . ' ' . $this->year;
    }


    /////////////////////////////////////////////////////////////////////////////////
    public function country()
    {
      return $this->belongsTo('App\Countrie');
    }
    
    public function category()
    {
         return $this->belongsToMany('App\Category')->withPivot('category_id','serie_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function seasons()
    {
      return  $this->hasMany('App\Season');
    }

    public function watchepisodes()
    {
     return   $this->hasMany('App\Watchepisode');
    }

    public function downepisodes()
    {
        $this->hasMany('App\Downloadepisode');
    }

}
