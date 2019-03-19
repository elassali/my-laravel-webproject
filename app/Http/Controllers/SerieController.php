<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateSerie;
use App\Http\Requests\EditSerie;
use App\Category;
use App\Countrie;
use App\User;
use App\Photo;
use App\Serie;
use App\Category_serie; 
class SerieController extends Controller
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
        $series=Serie::paginate(20);
        return view('admin.series.index',compact('series','role'));
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
        $category = Category::pluck('name','id')->all();
        $country = Countrie::pluck('name','id')->all();
        return view('admin.series.create',compact('category','country','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSerie $request)
    {
        $input=$request->all();
        $user=Auth::user()->id;

        if($file=$request->file('photo_id'))
        {
            $name=date('y_m_d_H_i_s').$file->getClientOriginalName();

            $file->move('img',$name);
 
            $picture=Photo::create(['path'=>$name]);
 
            $input['photo_id']=$picture->id;
        }
     
        $serie=new Serie;
        $serie['user_id']=$user;
        $serie['photo_id']=$input['photo_id'];
        $serie['country_id']=$input['country'];
        $serie['name']=$input['name'];
        $serie['year']=$input['year'];
        $serie['rate']=$input['rate'];
        $serie['story']=$input['story'];
        $serie->save();
        foreach($input['category'] as $cat)
        {
           $catego= new Category_serie;  
           $catego['serie_id']=$serie->id;
           $catego['category_id']=$cat;
           $catego->save();
        }
        session()->flash('success', 'Serie was added successfully!');
        return redirect()->route('serie.create');
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
        $category = Category::pluck('name','id')->all();
        $country = Countrie::pluck('name','id')->all();
        $serie=Serie::findOrFail($id);
        return view('admin.series.edit',compact('category','country','serie','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSerie $request, $id)
    {
        Category_serie::where('serie_id',$id)->delete();
        $serie=Serie::findOrFail($id);
        if($file=$request->file('photo_id'))
        {
            $picture=Photo::findOrFail($serie->photo_id);
            $oldpath=$picture->path;
            $name=date('y_m_d_H_i_s').$file->getClientOriginalName();
            $picture->path=$name;
            $file->move('img',$name);
            $picture->save();
            unlink(public_path().$movie->photo->file.$oldpath);
            /////////////////////
            foreach($input['category'] as $cat)
            {
               $catego= new Category_serie;  
               $catego['serie_id']=$serie->id;
               $catego['category_id']=$cat;
               $catego->save();
            }

            //serie update
            $serie['user_id']=$user;
            $serie['photo_id']=$input['photo_id'];
            $serie['country_id']=$input['country'];
            $serie['name']=$input['name'];
            $serie['year']=$input['year'];
            $serie['rate']=$input['rate'];
            $serie['story']=$input['story'];
            $serie->save();
        }
        else{
            foreach($input['category'] as $cat)
            {
               $catego= new Category_serie;  
               $catego['serie_id']=$serie->id;
               $catego['category_id']=$cat;
               $catego->save();
            }

            //serie update
            $serie['user_id']=$user;
            $serie['photo_id']=$input['photo_id'];
            $serie['country_id']=$input['country'];
            $serie['name']=$input['name'];
            $serie['year']=$input['year'];
            $serie['rate']=$input['rate'];
            $serie['story']=$input['story'];
            $serie->save();
        }
        return redirect()->route('serie.index');

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
