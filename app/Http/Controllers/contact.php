<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
//use Mail;
use Illuminate\Support\Facades\Mail;

class contact extends Controller
{
    public function contact(){

        return view('/contact');
    }

    public function contact_mail_send(Request $request)
    {
    
    
        Mail::to('trifpatricia@yahoo.com')->send(new ContactMail($request));
       return redirect('contact');
    
    }

}
