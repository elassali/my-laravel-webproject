<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }
}
