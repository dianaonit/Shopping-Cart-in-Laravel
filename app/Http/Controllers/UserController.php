<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;

class UserController extends Controller
{   
    //functions for register user
    public function getSignup(){
        return view('user.signup');
    }


    public function postSignup(Request $request){
        $this->validate($request,[
          'email' => 'email|required|unique:users',//validation for email adress
          'password' => 'required|min:4'//validation for password, min 4 characters
        ]);

        //if validation is succesfull, create new user

        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt( $request->input('password'))//store password encrypted(bcrypt)

        ]);

        $user->save();//save user to the database

        Auth::login($user);//direct reference to the product page without having to login

        if(Session::has('oldUrl')){
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        }

        return redirect()->route('user.profile');//redirect to the user profile page
    }
  

    //function for signin user

    public function getSignin(){
        return view('user.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request,[
            'email' => 'email|required',//validation for email adress
            'password' => 'required|min:4'//validation for password, min 4 characters
          ]);

        

         if( Auth:: attempt(['email' => $request->input('email'),'password'=>$request->input('password')])){
                     if(Session::has('oldUrl')){
                         $oldUrl = Session::get('oldUrl');
                         Session::forget('oldUrl');
                         return redirect()->to($oldUrl);
                     }

                   return redirect()->route('user.profile');//successful authentication ->redirect to user profile
          }
          return redirect()->back();//faild->redirect back, at the same page
    
    }

    //function for user profile

    public function getProfile(){
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key){
          $order ->cart = unserialize($order->cart);
          return $order;
        });

        return view('user.profile',['orders'=>$orders]);
    }


    
    //function for log out

    public function getLogout(){
       Auth:: logout(); 
       return redirect()->route('user.signin');
    }
}
