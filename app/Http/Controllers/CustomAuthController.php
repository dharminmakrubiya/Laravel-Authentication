<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class CustomAuthController extends Controller
{
    


    public function index() 
    {
        return view('CustomAuth.login');
    }


    public function registration()
    {
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
        'password' => Hash::make($data['password'])
      ]);
    }    




    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        
        $credentials = $request->only('email', 'password');

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
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
