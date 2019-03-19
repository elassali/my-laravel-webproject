<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use App\Contact;
class ContactController extends Controller
{
    //


    public function index()
    {
        $messages=Contact::paginate(5);
        return view('admin.contact.index',compact('messages')); 
    }

    
    public function emails() 
    {      
        $emails=Email::paginate(20);
        return view('admin.contact.email',compact('emails'));
    }
    public function destroy($id)
    {
        $messages=Contact::findOrFail($id)->delete();
        return redirect('/messages');

    }
}
