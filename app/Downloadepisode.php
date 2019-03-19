<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Downloadepisode extends Model
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
        return 'Episode' . ' ' . $this->episode_number;
    }



    /////////////////////////////////////////////////////////////
    public function serie()
    {
     return $this->belongsTo('App\Serie');
    }
    public function season()
    {
     return $this->belongsTo('App\Season');
    }
}
