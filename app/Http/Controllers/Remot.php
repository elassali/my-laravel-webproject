<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Watchmovie;
use Helper;


class Remot extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $input = $request->all();
        $input['imdbids'] = explode("\n",$input['imdbids']);
        $input['urls'] = explode("\n",$input['urls']);
        $i = 0 ;
        foreach($input['imdbids'] as $item)
        {
                $check = Watchmovie::where('server1',trim($item))->first();
                if(!empty($check))
                {
                    if(!empty($check['openloadfileid']))
                    {
                        Helper::deletefile($check['openloadfileid'],'openload');
                        Helper::deletefile($check['vidcloudfileid'],'verystream');
                    }
                    // Add in openload
                    $url = 'https://api.openload.co/1/remotedl/add?login=c54cd983a54a8356&key=eUZoeKCx&url='.trim($input['urls'][$i]);
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $data = curl_exec($ch);
                    curl_close($ch);
                    $data = json_decode($data,true);
                    $result=$data["result"];
                    $check['openloadfileid'] = $result["id"];

                    //Add in streamango
                    $url = 'https://api.fruithosted.net/remotedl/add?login=XecbFWa41f&key=ANDLQnMp&url='.trim($input['urls'][$i]);
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $data = curl_exec($ch);
                    curl_close($ch);
                    $data = json_decode($data,true);
                    $result=$data["result"];
                    $check['streamangofileid'] = $result["id"];

                    //Add in vidcloud
                    $url = 'https://api.verystream.com/remotedl/add?login=cd9384b495e21dc324d7&key=2khMPhTbrvH&url='.trim($input['urls'][$i]);
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $data = curl_exec($ch);
                    curl_close($ch);
                    $data = json_decode($data,true);
                    $result=$data["result"];
                    $check['vidcloudfileid'] = $result["id"];
                    // SAve the change & increment the i
                    $check->save();
                    $i++;
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
