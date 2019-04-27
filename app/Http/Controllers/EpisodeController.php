<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\Season;
use App\Watchepisode;
use App\Downloadepisode;
use App\Http\Requests\CreateEpisode;
use Illuminate\Support\Facades\Auth;
class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isadmin())
        {
            $role='layouts.AdminMaster';
        }
        else if(Auth::user()->isworker())
        { 
            $role='layouts.WorkerMaster';
        }
        $watchs=Watchepisode::paginate(20);
        return view('admin.series.episodes.index',compact('watchs','role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->isadmin())
        {
            $role='layouts.AdminMaster';
        }
        else if(Auth::user()->isworker())
        { 
            $role='layouts.WorkerMaster';
        }
        $serie=Serie::Pluck('name','id')->all();
        return view('admin.series.episodes.create',compact('serie','season','role'));
    }

    /////// Create multiEpisodes
    public function createmultiepisodes()
    {
        if(Auth::user()->isadmin())
        {
            $role='layouts.AdminMaster';
        }
        else if(Auth::user()->isworker())
        { 
            $role='layouts.WorkerMaster';
        }
        $serie=Serie::Pluck('name','id')->all();
        return view('admin.series.episodes.multicreate',compact('serie','season','role'));
    }


 



    ////////////////////////////////////
    public function findepisode(Request $request)
    {

           $data=Season::select('season_number','id')->where('serie_id',$request->id)->get();
           return response()->json($data); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEpisode $request)
    {
                $input=$request->all();       
                $watch= new Watchepisode;
                $down= new Downloadepisode;

                $watch['serie_id']=$input['serie_id'];
                $watch['season_id']=$input['season_id'];
                $watch['episode_number']=$input['episode_number'];
                $watch['server1']=$input['wserverone'];
                //download servers
                $down['serie_id']=$input['serie_id'];
                $down['season_id']=$input['serie_id'];
                $down['episode_number']=$input['episode_number'];
                $down['server1']=$input['dserverone'];
                $down['server2']=$input['dservertwo'];
                $down['server3']=$input['dserverthree'];
                // save theme
                $watch->save();
                $down->save();
            
          session()->flash('success', 'Episodes was added successfully!');
          return redirect()->route('episode.create');
    }

    public function multistore(CreateEpisode $request)
    {
        $input=$request->all();       
            $number=$input['episode_number'];
            for($i=1 ;$i<=$number; $i++)
            {
                $watch= new Watchepisode;
                $down= new Downloadepisode;
                $watch['serie_id']=$input['serie_id'];
                $watch['season_id']=$input['season_id'];
                $watch['episode_number']=$i;
                $watch['server1']=$input['wserverone'];
                //download servers
                $down['serie_id']=$input['serie_id'];
                $down['season_id']=$input['serie_id'];
                $down['episode_number']=$i;
                $down['server1']=$input['dserverone'];
                $down['server2']=$input['dservertwo'];
                $down['server3']=$input['dserverthree'];
                // save theme
                $watch->save();
                $down->save();
            }
          session()->flash('success', 'Episodes was added successfully!');
          return redirect()->route('episode.multiepisodes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->isadmin())
        {
            $role='layouts.AdminMaster';
        }
        else if(Auth::user()->isworker())
        { 
            $role='layouts.WorkerMaster';
        }
        $watch= Watchepisode::findOrFail($id);
        $down=  Downloadepisode::findOrFail($id);
        $serie=Serie::Pluck('name','id')->all();
        $season=Season::where('serie_id',$watch->serie_id)->get();
        return view('admin.series.episodes.edit',compact('watch','serie','season','down','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateEpisode $request, $id)
    {
        $input=$request->all();
        $watch= Watchepisode::findOrFail($id);
        $down=  Downloadepisode::findOrFail($id);
        $watch['serie_id']=$input['serie_id'];
        $watch['season_id']=$input['season_id'];
        $watch['episode_number']=$input['episode_number'];
        $watch['server1']=$input['wserverone'];
        //download servers
        $down['serie_id']=$input['serie_id'];
        $down['season_id']=$input['serie_id'];
        $down['episode_number']=$input['episode_number'];
        $down['server1']=$input['dserverone'];
        $down['server2']=$input['dservertwo'];
        $down['server3']=$input['dserverthree'];
        // save theme
        $watch->save();
        $down->save();
        return redirect()->route('episode.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $watch= Watchepisode::findOrFail($id)->delete();
        $down=  Downloadepisode::findOrFail($id)->delete();
        return redirect()->route('episode.index');
    }
}
