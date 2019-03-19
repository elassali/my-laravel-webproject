<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = false;
    public function movies()
    {
        return $this->belongsToMany('App\Movie')->withPivot('category_id','movie_id');
    }

    public function series()
    {
        return $this->belongsToMany('App\Serie');
    }
}
