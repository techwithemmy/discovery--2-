<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;

class AppConversation extends Controller
{
    
    /**
     * Place your App questions logic here.
     */
    
    public function welcome()
    {
        $this->showInfo();
    }

    private function showInfo()
    {
    $this->say('You will be shown some questions about Laravel. Every correct answer will reward you with a certain amount of points. Please keep it fair, and don\'t use any help. All the best! 🍀');
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
