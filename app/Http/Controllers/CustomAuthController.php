<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\Authenticate;



class CustomAuthController extends Controller
{

    public function index() 
    {
        if(Auth::check()){
            return redirect('/dashboard');
        }
        // $this->middleware('status');
        

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

        // User Welcome Mail Sending
        Mail::send('emails.welcomeEmail', $check->toArray(), 
        function ($message) {
            $message->to('dharminmakrubiya18@gmail.com', 'Dharmin Makrubiya');
            $message->subject('Welcome! Thank you so much for Register our website.');
        });

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
        
        // dd($request->toArray());
        $mk=user::select('status')->where('email',$request->email)->get();
     


        if($mk[0]->status == 1) {

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // dd($credentials);
                return redirect()->intended('dashboard');

                  $request->session()->push('Email',$request->email );
             }else{
                return redirect("login")->with('message', 'Login details are not valid');
             }
  
       }else{
        return redirect("login")->with('message', 'Login details are not valid');
        }
        
        // $credentials = $request->only('email', 'password');

        // $credentials = ['email'=>$request,'password'=>$request,'status'=>1];

        // echo "<pre>";
        // print_r($credentials);
        // die();
        // dd($credentials);

        // if (Auth::attempt($credentials)) {
        //     return redirect()->intended('dashboard');
        // }
  
        // return redirect("login")->with('message', 'Login details are not valid');
    }







    public function dashboard()
    {
        if(Auth::check()){
            return view('CustomAuth.dashboard');
        }
        
        return redirect("login");
    }



    public function signOut() {
        
        // $mk=Auth::user()->id;
        // print_r($mk);
        // // die();
        // User::where('id', $mk)
        // ->update([
        //    'status' => 1
        // ]);
        // user::where('id',$mk)->update(['status'=>0]);
        // print_r(Auth::user()->id);
        // die();
        
        Session::flush();

        

        Auth::logout();


  
        return Redirect('login');
    }
}