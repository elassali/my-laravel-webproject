<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Serie;
use App\Advertising;
use App\Watchepisode;
use App\Downloadepisode;
use App\Season;
use App\Email;
use App\Contact;
use App\Category;
use DB;
use MetaTag;

class indexmoviepage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movie_owl=Movie::orderBy('id','desc')->take(5)->get();
        $movie_featured=Movie::inRandomOrder()->limit(18)->get();
        $movie_imbd=Movie::orderBy('rate','desc')->limit(18)->get();
        $movie_toview=Movie::orderBy('views','desc')->limit(18)->get();
        $movie_recently=Movie::orderBy('id','desc')->limit(18)->get();
        $ads=Advertising::all();
        $counter =0;
        return view('website.index',compact('movie_owl','movie_featured','movie_toview','movie_imbd','movie_recently','ads','counter'));
    }

    public function tvseries()
    {
        // ->sortBydesc('id')
        $serie=Watchepisode::orderBy('id','desc')->paginate(18);  
        $ads=Advertising::all();
        MetaTag::set('title', 'RESHMOVIES4U | watch tv-series online for free');
        MetaTag::set('image', asset('images/titlecon.png'));
        MetaTag::set('description', 'watch and download tv-series online for free');
        return view('website.tvseries',compact('serie','ads','counter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }
    public function contact()
    {
        $ads=Advertising::all();

        return view('website.contact',compact('ads'));
    }

    public function genre($genre)
    {
        $page='Genre';
        $counter=0;
        $category=Category::where('name','=',$genre)->firstOrFail();
        $ads=Advertising::all();
        $movie=Movie::select('movies.*')
         ->join('category_movie','movie_id','=','movies.id')
         ->join('categories','categories.id','=','category_movie.category_id')
         ->where('categories.name','=',$genre)->paginate(18);
         //----------------------------------------------------------->for title
         MetaTag::set('title', 'RESHMOVIES4U | '.$genre.' Movies');
         MetaTag::set('image', asset('images/titlecon.png'));
         MetaTag::set('description', 'watch'.$genre.' Movies online for free');
         //-----------------------------------------------------------
        return view('website.genre',compact('counter','category','page','movie','ads'));
    }


    public function country($country)
    {
        $counter=0;
        $page='Country';
         $ads=Advertising::all();
         $movie=Movie::select('movies.*')
         ->join('countries','countries.id','=','movies.country_id')
         ->where('countries.name',$country)->paginate(18);
         MetaTag::set('title', 'RESHMOVIES4U |'.$country.'Movies');
         MetaTag::set('image', asset('images/titlecon.png'));
         MetaTag::set('description', 'watch  online for free of all countires');
         return view('website.genre',compact('counter','movie','ads','page','country'));
    }


    
    public function search(Request $request)
    {
        if($request->has('title')) 
        {
         $counter=0;
         $ads=Advertising::all();
         $movie=Movie::where('name',$request['title'])->get();
         if($serie=Serie::where('name',$request['title'])->exists())
         {
            $serie=Serie::where('name',$request['title'])->first();
            $season = Season::where('serie_id',$serie->id)->get();
         }
         else
         {
            $season = Season::where('id',$request['title'])->get();
         }
         MetaTag::set('title', 'RESHMOVIES4U | Watch '.$request['title']);
         MetaTag::set('image', asset('images/titlecon.png'));
         MetaTag::set('description', 'watch '.$request['title'].' online for free');
         return view('website.search',compact('counter','movie','ads','request','season'));
        }
        else{
            return redirect('/');
        }

    }

    // autocomplet searchbar
    public function fetch(Request $request)
    {

        if($request->get('query'))
        {
            $query=$request->get('query');
            $movie= Movie::where('name','LIKE',$query.'%')->get();
            $serie=Serie::where('name','LIKE',$query.'%')->get();
            $output ='';
            foreach($movie as $row)
            {
                $output.='<li class="resulta list-group-item text-center"> <a> '.ucfirst($row->name).'</a></li>';
            }
            foreach($serie as $serie)
            {
                $output.='<li class="resulta list-group-item text-center"> <a> '.ucfirst($serie->name).'</a></li>';

            }
         

            echo $output;

             
        }

        // $movie= Movie::where('name',$request['title'])->orWhere('name','like','%'.$request['title'].'%')->get();
        // $serie=Watchepisode::select('Watchepisodes.*')
        // ->join('series','series.id','=','Watchepisodes.serie_id')
        // ->where('series.name',$request['title'])
        // ->orWhere('name','like','%'.$request['title'].'%')->get();
        // return response()->json(array($movie,$serie));  

    }
    ///////////////////////////////////////------------------------------

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email=new Email();
        $email['email']=$request['email'];
        $email->save();
        return redirect('/');
    }

    public function message(Request $request)
    {
        $message=new Contact();
        $message['firstname']=$request['firstname'];
        $message['lastname']=$request['lastname'];
        $message['email']=$request['email'];
        $message['subject']=$request['subject'];
        $message['message']=$request['message'];
        $message->save();
        return redirect('/contact');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    public function watch($slug)
    {
        $movie=Movie::where('slug',$slug)->firstOrFail();
        $movie->increment('views');
        $ads=Advertising::all(); 
        MetaTag::set('title', 'RESHMOVIES4U | Watch '.$movie->getFullnameAttribute());
        MetaTag::set('image', asset('images/titlecon.png'));
        MetaTag::set('description', $movie->story);
        
        return view('website.movie',compact('movie','ads')); 
    }
//--------------------------------------------------------------------------->
    public function watchserie($slugserie,$slugseason,$slugepisode)
    {
        $serie=Serie::where('slug',$slugserie)->firstOrFail();
        $season=Season::select('seasons.*')->join('series','series.id','=','seasons.serie_id')->where('series.slug',$slugserie)->get();
        $episodes=Watchepisode::select('watchepisodes.*')->join('series','series.id','=','watchepisodes.serie_id')
                                ->join('seasons','seasons.id','=','watchepisodes.season_id')
                                ->where([['series.slug','=',$slugserie],['seasons.slug','=',$slugseason]])->get();
        $watch=Watchepisode::where('slug',$slugepisode)->firstOrFail();
        $watch->increment('views');
        $down=Downloadepisode::where('slug',$slugepisode)->firstOrFail();
        $ads=Advertising::all();
        MetaTag::set('title', 'RESHMOVIES4U | Watch '.$serie->slug.'-'.$slugseason.'-'.$watch->slug);
        MetaTag::set('image', asset('images/titlecon.png'));
        MetaTag::set('description', $serie->story);
        return view('website.serie',compact('serie','season','episodes','watch','down','ads'));
    }

    public function loadepisode(Request $request)
    {
        $data=Watchepisode::where([['serie_id','=',$request->srid],['season_id','=',$request->id]])->get();
        $serie = Serie::where('id',$request->srid)->get();
        $season = Season::where('id',$request->id)->get();
        echo json_encode(array($data,$serie,$season));
    }

    public function seasons($slugserie,$slugseason)
    {

        $episodes=Watchepisode::select('watchepisodes.*') 
        ->join('series','series.id','=','watchepisodes.serie_id')
        ->join('seasons','seasons.id','=','watchepisodes.season_id')
        ->where([['series.slug','=',$slugserie],['seasons.slug','=',$slugseason]])->get();
        $season=Season::where('slug',$slugseason)->firstOrFail();
        $serie=Serie::where('slug',$slugserie)->firstOrFail();
        $ads=Advertising::all();
        return view('website.season',compact('episodes','season','serie','ads'));
    }
    public function privacy()
    {
        $ads=Advertising::all();
        return view('website.privacy',compact('ads'));
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
