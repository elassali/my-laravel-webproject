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
        //watch servers
        $watch['serie_id']=$input['serie_id'];
        $watch['season_id']=$input['season_id'];
        $watch['episode_number']=$input['episode_number'];
        $watch['server1']=$input['wserverone'];
        $watch['server2']=$input['wservertwo'];
        $watch['server3']=$input['wserverthree'];
        $watch['server4']=$input['wserverfour'];
        $watch['server5']=$input['wserverfive'];
        $watch['server6']=$input['wserversix'];
        //download servers
        $down['serie_id']=$input['serie_id'];
        $down['season_id']=$input['season_id'];
        $down['episode_number']=$input['episode_number'];
        $down['server1']=$input['dserverone'];
        $down['server2']=$input['dservertwo'];
        $down['server3']=$input['dserverthree'];
        $down['server4']=$input['dserverfour'];
        $down['server5']=$input['dserverfive'];
        $down['server6']=$input['dserversix'];
        // save theme
        $watch->save();
        $down->save();
        session()->flash('success', 'Episode was added successfully!');
        return redirect()->route('episode.create');

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
        $watch['server2']=$input['wservertwo'];
        $watch['server3']=$input['wserverthree'];
        $watch['server4']=$input['wserverfour'];
        $watch['server5']=$input['wserverfive'];
        $watch['server6']=$input['wserversix'];
        //download servers
        $down['serie_id']=$input['serie_id'];
        $down['season_id']=$input['serie_id'];
        $down['episode_number']=$input['episode_number'];
        $down['server1']=$input['dserverone'];
        $down['server2']=$input['dservertwo'];
        $down['server3']=$input['dserverthree'];
        $down['server4']=$input['dserverfour'];
        $down['server5']=$input['dserverfive'];
        $down['server6']=$input['dserversix'];
        // save theme
        $watch->save();
        $down->save();
        return redirect('/episode');
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
        return redirect('/episode');
    }
}
