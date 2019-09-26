<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    
   public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function adminLogin(Request $request)
    {
        $email = $request->input('email'); 
        $password = $request->input('password');
         
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]))
        {
              return redirect('admin/admin_dashboard')->with('success', 'Success: You have successfully logged in.');
          
        }
        else
           return redirect('admin/login')->with('success', 'You entered wrong email/password.');
         
    }
    public function setLanguage(Request $request)
    {
        $lang = $request->locale;
         $request->session()->put('lang', $lang); 
         return redirect()->back();
    }
    public function clientLogin(Request $request)
    {
        
        $email = $request->input('email');
        $password = $request->input('password');
                    $rules = ['captcha' => 'required|captcha'];
           $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
               return redirect('client_login')->with('success',  config( $request->session()->get('lang').'.invalid_captcha_message'));
            }
           
        if (Auth::guard('user')->attempt(['email' => $email, 'password' => $password]))
        {
           
           if (Auth::guard('user')->user()->status == 0) { 

                $request->session()->flush();
               $request->session()->regenerate();
               return redirect('client_login')->with('success', config( $request->session()->get('lang').'.inactive_user_message'));
            }
            else
            {
                // subject
                $subject = config(lang().'.login_confirm_subject');

                // message
                $message = config(lang().'.login_confirm_body');
              

                // To send HTML mail, the Content-type header must be set
                $headers = "From: fkzmatkets@techie.com" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html;charset=UTF-8\r\n";
                $mail  =  mail($email, $subject, $message, $headers); 
                
                session(['success' => 'Success: You have successfully logged in.']);
                return redirect('traders')->with('success', 'Success: You have successfully logged in.');
            }
          
        }
        else
          
             return redirect('client_login')->with('success', config( $request->session()->get('lang').'.invalid_login_message'));
         
    }
    
    
    public function logOut(Request $request)
    {
      
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return  redirect('admin/login');
    }
    public function ClientlogOut(Request $request)
    {
      
        Auth::guard('user')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return  redirect('client_login');
    }

}


