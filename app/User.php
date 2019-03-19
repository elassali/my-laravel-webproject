<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function role()
    {
       return $this->belongsTo('App\Role');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function movies()
    {
        return $this->hasMany('App\Movie');
    }

    public function isadmin()
    {
        if($this->role->name=='Administrator')
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }

    public function isworker()
    {
        if($this->role->name=='Worker' || $this->role->name=='Administrator' )
        {
            return true;
        }
        else{
            return false;
        }
    }
}
