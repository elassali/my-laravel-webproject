<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
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

class Movie_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $messagecount =session('counter');
        $indexmessage = Contact::orderBy('id', 'desc')->limit(3)->get();
         $count = $indexmessage->count();
        if($count > session('counter'))
        {
            session(['counter' => $count]);
        }

        
        if(Auth::user()->isadmin())
        {
            $movies=Movie::paginate(20);
            $role='layouts.AdminMaster';
        }
        else if(Auth::user()->isworker())
        {
            $id=Auth::user()->id;
            $movies=Movie::where('user_id',$id)->paginate(20);
            $role='layouts.WorkerMaster';
        }
        return view('admin.movie.index',compact('movies','role','indexmessage'));

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
        else
        {
            $role='layouts.WorkerMaster';
        }
        $category = Category::pluck('name','id')->all();
        $country = Countrie::pluck('name','id')->all();
        return view('admin.movie.create',compact('category','country','role'));

    }

    public function createbyurl()
    {
        
        if(Auth::user()->isadmin())
        {
           $role='layouts.AdminMaster';
        }
        else
        {
            $role='layouts.WorkerMaster';
        }
        return view('admin.movie.addbyurl',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMovieRequest $request)
    {
         $input= $request->all();
         $user=Auth::user()->id;
         if($file=$request->file('photo_id'))
         {
           $file2=$request->file('photo_idcr');
           $name=date('y_m_d_H_i_s').$file->getClientOriginalName();
           $name2=date('y_m_d_H_i_s').$file2->getClientOriginalName();

           $file->move('img',$name);

           $file2->move('img',$name2);

           $picture=new Photo;
           $picture['path']=$name;
           $picture['pathcr']=$name2;
           $picture->save();
           $input['photo_id']=$picture->id;
         }

         $movie=new Movie;
         $movie['user_id']=$user;
         $movie['photo_id']=$input['photo_id'];
         $movie['country_id']=$input['country'];
         $movie['name']=$input['name'];
         $movie['year']=$input['year'];
         $movie['rate']=$input['rate'];
         $movie['quality']=$input['quality'];
         $movie['story']=$input['story'];
         $movie['trailer']=$input['trailer'];
         $movie->save();
         $movie_id=$movie->id;

         foreach($input['category'] as $cat)
         {
           $catego= new Category_movie;  
           $catego['movie_id']=$movie_id;
           $catego['category_id']=$cat;
           $catego->save();
         }

        $watchm=new Watchmovie;
        $watchm['movie_id']=$movie_id;
        $watchm['server1']=$input['wserverone'];
        $watchm->save();

       $downl=new Downloadmovie;
       $downl['movie_id']=$movie_id;
       $downl['server1']=$input['dserverone'];
       $downl['server2']=$input['dservertwo'];
       $downl['server3']=$input['dserverthree'];
       $downl->save();

       //sesion added succefly
    session()->flash('success', 'Movie was added successfully!');

          return redirect()->route('movie.create');
    }

    public function storebyurl(Request $request)
    {
        $countrylist = Countrie::all();

        $input=$request->all();
        $url="http://www.omdbapi.com/?i=".$input['imdb']."&apikey=1c2aadc3";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($data,true);
       
        $title = $result["Title"];
        $year = $result["Year"];
        $story = $result["Plot"];
        $imageurl = $result["Poster"];
        $rate = $result["imdbRating"];
        $imdbid = $result["imdbID"];
        $country = explode(",",$result["Country"]);
        $genre = $result["Genre"];
        $user=Auth::user()->id;
        //add the image
        @$rawImage = file_get_contents($imageurl);
        if($rawImage)
        {
           $name=date('y_m_d_H_i_s').Str::random(10).".png";
           $name2=date('y_m_d_H_i_s').Str::random(11).".png";
           file_put_contents("img/".$name,$rawImage);
           $picture = new Photo;
           $picture['path'] = $name;
           $picture['pathcr']=$name2;
           $picture->save();
           $imageid = $picture->id;
        }
        //add movie
         $movie=new Movie;
         $movie['user_id'] = $user;
         $movie['photo_id'] = $imageid;
         //loop for country
        foreach($countrylist as $countrie)
        {
            if($countrie["name"] == $country[0] )
            {
                $movie['country_id'] = $countrie['id'];
            }

        }
         //end loop for country
         $movie['name'] = $title;
         $movie['year'] = $year;
         $movie['rate'] = $rate;
         $movie['quality'] = $input['quality'];
         $movie['story'] = $story;
         $movie['trailer'] = $input['trailer'];
         $movie->save();
         //end add movie and grap movie id that just added
         $movie_id=$movie->id;
         // add category for that movie
        
                  
      
            
        $category = Category::pluck('name','id')->all();

        foreach ($category as $key => $value) {
            
            if (strpos($genre, $value) !== false) {

                    $catego= new Category_movie; 
                    $catego['movie_id']=$movie_id;
                    $catego['category_id']=$key;
                    $catego->save();
            }
         }

       // watch server
         $watchm=new Watchmovie;
         $watchm['movie_id']=$movie_id;
         $watchm['server1']=$imdbid;
         $watchm->save();
         
         //download server
         $downl=new Downloadmovie;
         $downl['movie_id']=$movie_id;
         $downl['server1']='null';
         $downl['server2']='null';
         $downl['server3']='null';
         $downl->save();

      //sesion added succefly
       session()->flash('success', 'Movie was added successfully!');

         return redirect()->route('movie.createbyurl');

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
    {if(Auth::user()->isadmin())
        {
           $role='layouts.AdminMaster';
        }
        else
        {
            $role='layouts.WorkerMaster';
        }
        $movie=Movie::findOrFail($id);
        $category = Category::pluck('name','id')->all();
        $country = Countrie::pluck('name','id')->all();
        return view('admin.movie.edit',compact('movie','category','country','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditMovieRequest $request, $id)
    {
        Category_movie::where('movie_id',$id)->delete();
        $movie=Movie::findOrFail($id);
        $watchm=Watchmovie::where('movie_id',$id)->first();
        $downl=Downloadmovie::where('movie_id',$id)->first();
        $input=$request->all();

        if($file=$request->file('photo_id'))
        {
            //photo update
            $picture=Photo::findOrFail($movie->photo_id);
            $oldpath=$picture->path;
            $name=date('y_m_d_H_i_s').$file->getClientOriginalName();
            $picture->path=$name;
            $file->move('img',$name);
            $picture->save();
            unlink(public_path().$movie->photo->file.$oldpath);
            //movie update
            $movie['country_id']=$input['country'];
            $movie['name']=$input['name'];
            $movie['year']=$input['year'];
            $movie['rate']=$input['rate'];
            $movie['quality']=$input['quality'];
            $movie['story']=$input['story'];
            $movie['trailer']=$input['trailer'];
            $movie->save();
            foreach($input['category'] as $cat)
             {
                $catego= new Category_movie;  
                $catego['movie_id']=$movie->id;
                $catego['category_id']=$cat;
                $catego->save();
             }
            //watching server update
            $watchm['server1']=$input['wserverone'];
            $watchm->save();
            //download server
            $downl['server1']=$input['dserverone'];
            $downl['server2']=$input['dservertwo'];
            $downl['server3']=$input['dserverthree'];
            $downl->save();
        }
        else{
            //movie update
            $movie['country_id']=$input['country'];
            $movie['name']=$input['name'];
            $movie['year']=$input['year'];
            $movie['rate']=$input['rate'];
            $movie['story']=$input['story'];
            $movie['trailer']=$input['trailer'];
            $movie->save();
            foreach($input['category'] as $cat)
             {
                $catego= new Category_movie;  
                $catego['movie_id']=$id;
                $catego['category_id']=$cat;
                $catego->save();
             }
            //watching server update
            $watchm['server1']=$input['wserverone'];

            $watchm->save();
            //download server
            $downl['server1']=$input['dserverone'];
            $downl['server2']=$input['dservertwo'];
            $downl['server3']=$input['dserverthree'];
            $downl->save();
        }

        return redirect()->route('movie.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $movie=Movie::findOrFail($id);
        if(file_exists(public_path().$movie->photo->file.$movie->photo->path)){
            if(file_exists(public_path().$movie->photo->file.$movie->photo->pathcr))
            {
                unlink(public_path().$movie->photo->file.$movie->photo->pathcr);
            }      
            unlink(public_path().$movie->photo->file.$movie->photo->path);    
            Category_movie::where('movie_id',$id)->delete();
            $movie->delete();
            $watchm=Watchmovie::where('movie_id',$id)->delete();
            $downl=Downloadmovie::where('movie_id',$id)->delete();
            return redirect()->route('movie.index');
        }
        else{
            Category_movie::where('movie_id',$id)->delete();
            $movie->delete();
            $watchm=Watchmovie::where('movie_id',$id)->delete();
            $downl=Downloadmovie::where('movie_id',$id)->delete();
            return redirect()->route('movie.index');

        }


       
    }
}
