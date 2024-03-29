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
 //store by url masse store
    public function storebyurl(Request $request)
    {
       
        $countrylist = Countrie::all();
        $apikey = array('AIzaSyD0fwa3x0hh-XpfkyBP-1ovd7IqtLQXk1U','AIzaSyAmnTQuGQQ-pFCapApNQNSXdR7QGRmAMhY',
                         'AIzaSyCqOK1ieeTk_TLE3tsgQbe07x7ot9zUkCE','AIzaSyAcupoPquwXnGCW2SB886SZMUDEVB5dl_0',
                         'AIzaSyDvgM24eS6VfrymFIzVebO_7rHz__RLrA8','AIzaSyCBdzrJpNLhWK0rHXbtre-QBLuDZ63mu5Y'); 
        $input = $request->all();
        $imdbids = explode("\n",$input["imdbids"]);
        //////////////////////////
        $added = 0;
        /////////////////////////
        $alreadyexist =0;
        foreach($imdbids as $item)
        {
         
        $item = trim($item);
        $check = Watchmovie::where('server1',$item)->first();
        if(empty($check))
        {
        $url="http://www.omdbapi.com/?i=".$item."&apikey=fff6833a";
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
        //rate 
        $result["imdbRating"] != "N/A" ? $rate = $result["imdbRating"] : $rate = mt_rand(5,9).'.'.mt_rand(0,10);
        ///end rate
        $imdbid = $result["imdbID"];
        $country = explode(",",$result["Country"]);
        $genre = $result["Genre"];
        $user=Auth::user()->id;
        $keyword = str_replace(array('&',' '),array('','+'),$title).'+trailer';
        $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keyword . '&maxResults=1&key=' . $apikey[$input["counter"]];
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response,true);
        $result = $result["items"][0];
        $result = $result["id"];
         $trailer = 'https://www.youtube.com/embed/'.$result["videoId"];
         //end loop for country
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
         $countryid = Countrie::where('name','=',$country[0])->first();
         if(!$countryid)
         {
            $newcountrie = new Countrie;
            $newcountrie['name'] = $country[0];
            $newcountrie->save();
            $movie['country_id'] = $newcountrie->id;
         }
         else{
            $movie['country_id'] = $countryid->id;
         }
         $movie['name'] = $title;
         $movie['year'] = $year;
         $movie['rate'] = $rate;
         $movie['quality'] = $input['quality'];
         $movie['story'] = $story;
         $movie['trailer'] = $trailer;
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
         $downl['server1']='';
         $downl['server2']='';
         $downl['server3']='';
         $downl->save();   
         //
         $added++;

        
        }
        else
        $alreadyexist++;
         
    }
    //sesion added succefly
    session()->flash('success', $added.' Movie was added successfully! '.$alreadyexist.' already exist');
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
