<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Photo;
use App\Movie;
use App\Category_movie;
use App\Downloadmovie;
use App\Watchmovie;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\EditMovieRequest;
use App\Category;
use App\Countrie;
use App\Contact;

class Remot extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin.oplstr.singlecreate'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.oplstr.singlecreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();
        // $imbds = explode("\n",$input['imdbids']);
        // foreach($imbds as $item)
        // {
        //    if(strlen($item) > 7 )
        //    {
        //        echo $item.'<br />';
        //    }
        //         // if(strpos($item,'tt') !== false)
        //         // {
        //         //     echo $item.'<br />';
        //         // }
        // }
        $title = "Oliver &amp; Company";
        $title = str_replace(array('&amp;',' '),array('','+'),$title);
        echo $title;
     
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
