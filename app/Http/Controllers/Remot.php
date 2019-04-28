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
        $countrylist = Countrie::all();
        $apikey = 'AIzaSyCBdzrJpNLhWK0rHXbtre-QBLuDZ63mu5Y'; 
        $input = $request->all();
        $imdbids = explode("\n",$input["imdbids"]);

        foreach($imdbids as $item)
        {
         
        $item = trim($item);
        $check = Watchmovie::where('server1',$item)->first();
        if(empty($check))
        {
        $url="http://www.omdbapi.com/?i=".$item."&apikey=1c2aadc3";
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
        $keyword = $item.'+trailer';
        $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keyword . '&maxResults=1&key=' . $apikey;
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
         $downl['server1']='null';
         $downl['server2']='null';
         $downl['server3']='null';
         $downl->save();

      
        
        }
    }
   


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
