<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Movie extends Model
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


    ///////////////////////////////////////////////////////////////////////////

    public function country()
    {
      return $this->belongsTo('App\countrie');
    }
    
    public function category()
    {
         return $this->belongsToMany('App\Category')->withPivot('category_id','movie_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }
    public function download()
    {

        return $this->hasOne('App\Downloadmovie');
    }

    public function watch()
    {

        return $this->hasOne('App\Watchmovie');
    }
}
