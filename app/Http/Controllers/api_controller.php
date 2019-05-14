<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apilogins;
use App\Http\Requests\apiaccountrequest;
class api_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $api = Apilogins::all();
        return view('admin.oplstr.apiaccount.index_create',compact('api'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(apiaccountrequest $request)
    {
        $input = $request->all();
        $api= new Apilogins();
        $api["apilogin"] = $input["login"];
        $api["apikey"] = $input["key"];
        $api["hostname"] = $input["host"];
        $api->save();
        return redirect()->route('apiaccount.index');
        

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
        $api = Apilogins::findOrFail($id);
        return view('admin.oplstr.apiaccount.edit',compact('api'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(apiaccountrequest $request, $id)
    {
        $input = $request->all();
        $api = Apilogins::findOrFail($id);
        $api["apilogin"] = $input["login"];
        $api["apikey"] = $input["key"];
        $api["hostname"] = $input["host"];
        $api->save();
        return redirect()->route('apiaccount.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Apilogins::where('id',$id)->delete();
        return redirect()->route('apiaccount.index');
    }
}
