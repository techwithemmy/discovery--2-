<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\User;
use App\settings;
use App\account;
use App\plans;
use App\agents;
use App\confirmations;
use App\users;
use App\user_plans;
//use App\dusers;
use App\deposits;
use App\wdmethods;
use App\withdrawals;
use App\cp_transactions;
use App\tp_transactions;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Traits\CPTrait;

use App\Mail\NewNotification;
use App\Mail\Twofa;
use App\Mail\newroi;
use App\Mail\endplan;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, CPTrait;

       public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            '2fa' => 'required',
        ]);

        if($request->input('2fa') == Auth::user()->token_2fa){            
            $user = Auth::user();
            $user->token_2fa_expiry = \Carbon\Carbon::now()->addMinutes(config('session.lifetime'));
            $user->save();    
            
            $settings = settings::where('id','1')->first();
            
            //send email notification
            $objDemo = new \stdClass();
            $objDemo->message = "This is a successful login notification on your account. If this was not you, kindly take action by changing your account and email passwords.";
            $objDemo->sender = $settings->site_name;
            $objDemo->date = \Carbon\Carbon::Now();
            $objDemo->subject ="Successful login";
                
            Mail::bcc($user->email)->send(new NewNotification($objDemo));
        
            return redirect('/dashboard');
        } else {
            return redirect()->back()->with('message', 'Incorrect code.');
        }
    }

    public function showTwoFactorForm()
    {
        return view('auth.two_factor');
    } 


    public function SendSms($getSenderID , $getbody)
    {
      
      $SmsTitle = env('APP_NAME');
      $SmsApiToken = env('APP_SMS_API_TOKEN');

      $SenderID = $getSenderID ;

      $body = urlencode($getbody);
    
      $url = "https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=".$SmsApiToken ."&from=".$SmsTitle."&to=".$SenderID."&body=".$body;


      $curl = curl_init();
      // Set some options - we are passing in a useragent too here
      curl_setopt_array($curl, [
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => $url,
          CURLOPT_USERAGENT => 'Codular Sample cURL Request'
      ]);
      // Send the request & save response to $resp
      $resp = curl_exec($curl);

      $Jresp = json_decode($resp, true);

      $data = $Jresp['data'];
      return  $data['status'] ;
    }
}

