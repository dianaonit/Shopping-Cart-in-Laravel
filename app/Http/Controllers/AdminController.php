<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Auth;

class AdminController extends Controller
{
    public function getSignin(){
        return view('admin.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request,[
            'email' => 'email|required',//validation for email adress
            'password' => 'required|min:4'//validation for password, min 4 characters
          ]);

          

          return redirect()->route('admin.profile');//successful authentication ->redirect to user profile
       
    }

    public function getProfile(){
        return view('admin.profile');
    }


    public function getLogout(){
        Auth:: logout(); 
        return redirect()->route('admin.signin');
     }

    
}
