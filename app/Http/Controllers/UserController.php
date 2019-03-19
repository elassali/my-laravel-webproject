<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;
use Carbon\Carbon;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Auth;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user=User::all();

        return view('admin.users.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=Role::pluck('name','id')->all();

        return view('admin.users.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $input= $request->all();

        if($file=$request->file('photo_id'))
        {
            $name=date('y_m_d_H_i_s').$file->getClientOriginalName();

            $file->move('img',$name);

             $picture=Photo::create(['path'=>$name]);

            $input['photo_id']=$picture->id;
           
        }
   

        $input['password']=bcrypt($request->password);
        $user = new User;
        $user->role_id=$input['role_id'];
        $user->photo_id=$input['photo_id'] ;
        $user->name=$input['name'];
        $user->email=$input['email'] ;
        $user->password=$input['password'];
        $user->save();  
        
        return redirect('/user');
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
        $user=User::findOrFail($id);
        $role=Role::pluck('name','id')->all();

        return view('admin.users.edit',compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $user=User::findOrFail($id);

        if(trim($request->password)=='')
        {
            $input=$request->except('password');
            if(!$request->file('photo_id'))
            {
              $user->name=$input['name'];
              $user->email=$input['email'];
              $user->role_id=$input['role_id'];
              $user->save();
            }
            else if($file=$request->file('photo_id'))
            {
                     $picture=Photo::findOrFail($user->photo_id);
                     $oldpath=$picture->path;
                     $name=date('y_m_d_H_i_s').$file->getClientOriginalName();
                     $picture->path=$name;
                     $file->move('img',$name);
                     $picture->save();
                     $user->name=$input['name'];
                     $user->email=$input['email'];
                     $user->role_id=$input['role_id'];
                     $user->save();
                     unlink(public_path().$movie->photo->file.$oldpath);
            }
        }
        else{
           $input= $request->all();
           $input['password']=bcrypt($request->password);

           if(!$request->file('photo_id'))
            {
              $user->name=$input['name'];
              $user->email=$input['email'];
              $user->role_id=$input['role_id'];
              $user->password=$input['password'];
              $user->save();
            }
            else if($file=$request->file('photo_id'))
            {
                     $picture=Photo::findOrFail($user->photo_id);
                     $oldpath=$picture->path;

                     $name=date('y_m_d_H_i_s').$file->getClientOriginalName();
                     $picture->path=$name;
                     $file->move('img',$name);
                     $picture->save();
                     $user->name=$input['name'];
                     $user->email=$input['email'];
                     $user->role_id=$input['role_id'];
                     $user->password=$input['password'];
                     $user->save();
                     unlink(public_path().$movie->photo->file.$oldpath);
            }
        }  
         return redirect('/user');
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
        $user=User::findOrFail($id);
        unlink(public_path().$user->photo->file.$user->photo->path);
        Photo::findOrFail($user->photo_id)->delete();
        $user->delete();
        return redirect('/user');

    }
}
