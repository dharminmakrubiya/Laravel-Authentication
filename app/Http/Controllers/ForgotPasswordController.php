<?php

namespace App\Http\Controllers;
use DB; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

  



class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
      {
        if(Auth::check()){
            return redirect('/dashboard');
        }
         return view('CustomAuth.forgetPassword');
      }


      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);

        //   print_r($request);
        //   die();
  
          $token = Str::random(10);

        //   print_r($token);
        //   die();

          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
            
        

        
          Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }


      public function showResetPasswordForm($token) { 
        if(Auth::check()){
            return redirect('/dashboard');
        }
        return view('CustomAuth.forgetPasswordLink', ['token' => $token]);
     }


     public function submitResetPasswordForm(Request $request)
     {
         $request->validate([
             'email' => 'required|email|exists:users',
             'password' => 'required|string|min:6|confirmed',
             'password_confirmation' => 'required'
         ]);

        //  echo "<pre>";
         
        //  die($request);
 
        //  $updatePassword = DB::table('password_resets')
        //                      ->where([
        //                        'email' => $request->email, 
        //                        'token' => $request->token
        //                      ])
        //                      ->first();
        
        // die();
        
        //  if($updatePassword){
        //     // die();
        //     return back()->with('message', 'Your Token is Invalid!');
        //  }
        //  die('1111111');      
         $user = User::where('email', $request->email)
                     ->update(['password' => Hash::make($request->password)]);

         

        //  DB::table('password_resets')->where(['email'=> $request->email])->delete();
         
         return redirect('/login')->with('message_password_reset', 'Your password has been changed!');
     }
}