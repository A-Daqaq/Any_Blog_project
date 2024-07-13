<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
        
    public function loginPage(){
        return view('login');
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success','logged out successfully');

    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            "name"=> "required",
            "password" =>["required" , "alpha_num" , "min:3", "max:50"],
        ]);
        if(auth()->attempt(['name'=> $fields['name'],'password'=>$fields['password']])){
            return redirect('/')->with("success","You have logged in successfully");
         } else{
            return redirect('/login')->with('errorLogin', "You entered wrong info");
        }

    }

    public function signUpPage(){
        return view('signup');
    }


    public function signUp(Request $request){

        $fields = $request->validate([
            "name" => "required",
            "email"=> ["email" , "max:50" , "required" ,Rule::unique("users","email")],
            "password" =>["required" , "alpha_num" , "min:3", "max:50"],
            "password_confirmation" =>["required" , "same:password"]
        ]);
        $fields['password'] = bcrypt( $fields['password']);
        $user = User::create($fields);
        auth()->login($user);
        return redirect("/")->with('success','Account created successfully');

    }
}
