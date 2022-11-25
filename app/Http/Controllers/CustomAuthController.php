<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;



class CustomAuthController extends Controller
{
   

    public function index() 
    {
        if(Auth::check()){
            return redirect('/dashboard');
        }
        // $this->middleware('auth');


        return view('CustomAuth.login');
    }


    public function registration()
    {
        if(Auth::check()){
            return redirect('/dashboard');
        }
        return view('CustomAuth.registration');
    }

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        
        $data = $request->all();

        // echo "<pre>";
        // print_r($data);
        // die();
        // dd($data);

        $check = $this->create($data);

        return redirect("login");

    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'status'    =>  1
      ]);
    }    




    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            
        ]);
        
        $credentials = $request->only('email', 'password');

        // $credentials = ['email'=>$request,'password'=>$request,'status'=>1];

        // echo "<pre>";
        // print_r($credentials);
        // die();
        // dd($credentials);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
  
        return redirect("login")->with('message', 'Login details are not valid');
    }







    public function dashboard()
    {
        if(Auth::check()){
            return view('CustomAuth.dashboard');
        }
        
        return redirect("login");
    }



    public function signOut() {
        
        // print_r(Auth::user()->id);
        // die();
        
        Session::flush();

        

        Auth::logout();


  
        return Redirect('login');
    }
}
