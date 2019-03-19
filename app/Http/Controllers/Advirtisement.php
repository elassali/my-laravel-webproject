<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Advertising;

class Advirtisement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ad=Advertising::all();
        return view('admin.advertisement.index',compact('ad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input= $request->all();
        $ad=new Advertising;
        if($file=$request->file('photo_id'))
        {
            $name=date('y_m_d_H_i_s').$file->getClientOriginalName();

            $file->move('img',$name);

             $picture=Photo::create(['path'=>$name]);

            $input['photo_id']=$picture->id;  
        }
        $ad['photo_id']=$input['photo_id'];
        $ad['name']=$input['name'];
        $ad['adurl']=$input['adurl'];
         $ad->save();
         session()->flash('success', 'advirtisement was added successfully!');
         return redirect()->route('advirtisement.index');

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
        $ad=Advertising::findOrFail($id);
          
        return view('admin.advertisement.edit',compact('ad'));
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
         $input= $request->all();
        $ad=Advertising::findOrFail($id);
        if($file=$request->file('photo_id'))
        {
                 $picture=Photo::findOrFail($ad->photo_id);
                 $oldpath=$picture->path;
                 $name=date('y_m_d_H_i_s').$file->getClientOriginalName();
                 $picture->path=$name;
                 $file->move('img',$name);
                 $picture->save();
                 $ad['name']=$input['name'];
                 $ad['adurl']=$input['adurl'];
                  $ad->save();
                 unlink(public_path().$ad->photo->file.$oldpath);
        }
        else{
            $ad['name']=$input['name'];
            $ad['adurl']=$input['adurl'];
             $ad->save();
        }
        return redirect('/advirtisement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Advertising::findOrFail($id)->delete();
        return redirect('/advirtisement');
    }
}
