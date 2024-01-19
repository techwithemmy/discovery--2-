<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');
        
         $botman->fallback(function($bot) {
            $bot->types();
            $bot->reply('Sorry, I did not understand that command. Please touch this icon 👉  /start  👈');
        });

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }
    
    public function welcome($bot)
    {
       $bot->reply('welcome'); 
    }
    
    public function referral($bot)
    {
       $bot->startConversation(new AppConversation());
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
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
