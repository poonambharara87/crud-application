<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }    

    public function register_store(Request $request){

        // {"_token":"mkgTODWNlXuz4mTd8Pu26yKvBfcgiL6NCczV2zwC","username":"poonam","email":"admin@yopmail.com","password":"admin@123","password-confirmation":"admin@123"}
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed:password'
        ], );

        if($validator->fails()){
            return redirect()->route('register')->with(['errors' => $validator->errors()]);
        }
        
        try{
            
            $user = User::create([
                    'email' => $request->email ?? '',
                    'password' => $request->password ?? '',
                    'name' => $request->name ?? '',
                ]);

            return redirect()->route('login')->with(['sucsess' => 'Registered successfully!']);
            
            
        }catch(Exception $e){
            return redirect()->route('login')->with(['errors' => $e->getMessage()]);
        }
    }

    public function login(){
        return view('auth.login');
    }

    public function login_store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            
            return redirect()->route('login')->with(['errors' => $validator->errors()]);
        }

        try{
            $user = User::where('email', $request->email)->first();
            if(!$user){
                return redirect('products')->withErrors(['errors' => 'Credentials not matched!']);
            }
            return redirect()->route('products.index')->with(['success' => 'Login successfully!']);  
        }catch(Exception $e){
            return redirect()->route('login')->withErrors(['errors' => $e->getMessage]);  
        }
    }
}
