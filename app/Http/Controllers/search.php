<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Serie;
use App\Watchepisode;
use Illuminate\Support\Facades\Auth;


class search extends Controller
{
    public function result(Request $request)
    {
        
        if(Auth::user()->isadmin())
        {
            $movies=Movie::paginate(20);
            $role='layouts.AdminMaster';
        }
        else if(Auth::user()->isworker())
        {
            $id=Auth::user()->id;
            $role='layouts.WorkerMaster';
        }
         $movies=Movie::where('name',$request['title'])->paginate(5);

         $series=Serie::where('name',$request['title'])->paginate(5); 

         $watchs=Watchepisode::select('Watchepisodes.*')->join('series','series.id','=','Watchepisodes.serie_id')->where('series.name',$request['title'])->paginate(5);

        return view('admin.search',compact('movies','series','watchs','role')); 


    }
}
