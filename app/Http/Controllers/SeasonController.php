<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\Season;
use App\Http\Requests\CreateSeason;
use Illuminate\Support\Facades\Auth;

class SeasonController extends Controller
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
        $seasons=Season::paginate(20);
        return view('admin.series.seasons.index',compact('seasons','role'));
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
        return view('admin.series.seasons.create',compact('serie','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSeason $request)
    {
        $input=$request->all();
        $season = new Season;
        $season['serie_id']=$input['serie_id'];
        $season['season_number']=$input['season_num'];
        $season['trailer']=$input['trailer'];
        $season->save();
        session()->flash('success', 'Season was added successfully!');
        return redirect()->route('season.create');

        
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
        $season=Season::findOrFail($id);
        $serie=Serie::Pluck('name','id')->all();
        return view('admin.series.seasons.edit',compact('season','serie','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSeason $request, $id)
    {
        $input=$request->all();
        $season=Season::findOrFail($id);
        $season['serie_id']=$input['serie_id']; 
        $season['season_number']=$input['season_num'];
        $season['trailer']=$input['trailer'];
        $season->save();
        return redirect()->route('season.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Season::findOrFail($id)->delete();
        return redirect()->route('season.index');

    }
}
