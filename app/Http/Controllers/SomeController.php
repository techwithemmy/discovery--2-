<?php

namespace App\Http\Controllers;

use App\settings;
use App\users;
use App\user_plans;
use App\plans;
use App\withdrawals;
use App\deposits;
use App\cp_transactions;
use App\tp_transactions;
use App\notifications;
use App\wdmethods;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Mail\NewNotification;
use Illuminate\Support\Facades\Mail;

use App\Http\Traits\CPTrait;
 
class SomeController extends Controller
{
    use CPTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    

     //return settings form
    public function settings(Request $request){
      include'currencies.php';
      return view('settings')->with(array(
        'settings' => settings::where('id', '=', '1')->first(),
        'wmethods' => wdmethods::where('type', 'withdrawal')->get(),
        'cpd' => cp_transactions::where('id', '=', '1')->first(),
        'currencies' => $currencies,
        'title' =>'System Settings'));
      //return view('settings')->with(array('settings' => settings::where('id', '=', '1')->first(),'title' =>'System Settings'));
    }
    
    
    //Add withdrawal and deposit method
    public function addwdmethod(Request $request){
        $method = new wdmethods;
        $method->name=$request['name'];
        $method->minimum=$request['minimum'];
        $method->maximum=$request['maximum'];
        $method->charges_fixed=$request['charges_fixed'];
        $method->charges_percentage=$request['charges_percentage'];
        $method->duration=$request['duration'];
        $method->type=$request['type'];
        $method->status=$request['status'];
        $method->save();
        return redirect()->back()->with('message','Method added successful!');
        
    }
    
    //Update withdrawal and deposit method
    public function updatewdmethod(Request $request){
        
        wdmethods::where('id', $request['id'])
          ->update([
          'name'=>$request['name'],
          'minimum'=>$request['minimum'],
          'maximum'=>$request['maximum'],
          'charges_fixed'=>$request['charges_fixed'],
          'charges_percentage'=>$request['charges_percentage'],
          'duration'=>$request['duration'],
          'type'=>$request['type'],
          'status'=>$request['status'],
          ]);
          return redirect()->back()
          ->with('message', 'Action Successful');
        
    }
    
    //Delete withdrawal and deposit method
    public function deletewdmethod($id){
        wdmethods::where('id',$id)->delete();
        return redirect()->back()->with('message','Withdrawal method deleted successful!');
    }

        //save Setttings to DB
        public function updatesettings(Request $request){
          $this->validate($request, [
            'logo' => 'mimes:jpg,jpeg,png|max:500',
            ]);
          /*if($request['payment_mode']=='BTC'){
            $currency='BTC';
          }elseif($request['payment_mode']=='ETH'){
            $currency='ETH';
          }else{
            $currency=$request['currency'];
          }*/
          
          $te=$request['telegram_token'];
          $sa=$request['site_address'];
          
          $settings = settings::where('id', '=', '1')->first();
          if(empty($request->file('logo'))){
            $image=$settings->logo;
          }else{
           //process logo
          $img=$request->file('logo');
          $upload_dir='images';
          $image = date('Ymd') . '_' . time() . '.' . $img->getClientOriginalName();
          //$image=$img->getClientOriginalName();
          $move=$img->move($upload_dir, $image);
          }

          if(isset($request['trade_mode']) and $request['trade_mode']=='on'){
            $trade_mode="on";
          }else{
            $trade_mode="off";
          }
          
          if(isset($request['enable_2fa']) and $request['enable_2fa']=='yes'){
            $enable_2fa="yes";
          }else{
            $enable_2fa="no";
          }
          
          if(isset($request['enable_kyc']) and $request['enable_kyc']=='yes'){
            $enable_kyc="yes";
          }else{
            $enable_kyc="no";
          }
          
          if(isset($request['enable_verification']) and $request['enable_verification']=='true'){
            $enable_verification="true";
            
            //change status column to active on users table
            
            $sql=DB::statement("ALTER TABLE `users` CHANGE `status` `status` VARCHAR(25) DEFAULT 'blocked'"); 
            
          }else{
            $enable_verification="false";
            //change status column to active on users table
            
            $sql=DB::statement("ALTER TABLE `users` CHANGE `status` `status` VARCHAR(25) DEFAULT 'active'"); 
          }
          
           if(isset($request['bot_activate']) && $request['bot_activate']=='true' && $request['site_preference']=="Telegram bot only"){
            $bot_activate="true";
            
            //activate bot
            // create a new cURL resource
            $ch = curl_init();
            
            // set URL and other appropriate options
            curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$te/setWebhook?url=$sa/botman");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            
            // grab URL and pass it to the browser
            curl_exec($ch);
            
            // close cURL resource, and free up system resources
            curl_close($ch);
          }else{
            $bot_activate="false";
            
            //deactivate bot
            // create a new cURL resource
            $ch = curl_init();
            
            // set URL and other appropriate options
            curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$te/deleteWebhook?url=$sa/botman");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            
            // grab URL and pass it to the browser
            curl_exec($ch);
            
            // close cURL resource, and free up system resources
            curl_close($ch);
          }
          
          /*
          //check if telegram token is not set then set it
          if($settings->telegram_token==""){
              //pass telegram token to the .env file
              $path = base_path('.env');

            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    "TELEGRAM_TOKEN=", "TELEGRAM_TOKEN=$te", file_get_contents($path)
                ));
            }
            }*/
            
        /*    
          if(isset($request['tawk_to'])){
            $file = base_path('resources/views/livechat.blade.php');
            $fp = fopen("$file", 'w');
            $content = $request['tawk_to'];
            fwrite($fp, "$content");
            fclose($fp);
          }*/
          

          settings::where('id', $request['id'])
          ->update([
              
          'site_name'=>$request['site_name'],
          'enable_2fa'=>$enable_2fa,
          'enable_kyc'=>$enable_kyc,
          'enable_verification'=>$enable_verification,
          'withdrawal_option'=>$request['withdrawal_option'],
          'description'=>$request['description'],
          'keywords'=>$request['keywords'],
          'site_title'=>$request['site_title'],
          'currency'=>$request['currency'],
          's_currency'=>$request['s_currency'],
          'payment_mode'=>$request['payment_mode1'].$request['payment_mode2'].
          $request['payment_mode3'].$request['payment_mode4'].$request['payment_mode5'].$request['payment_mode6'],
          'logo'=>$image,
          'bot_link'=>$request['bot_link'],
          'site_preference'=>$request['site_preference'],
          'site_colour'=>$request['site_colour'],
          'telegram_token'=>$request['telegram_token'],
          'bot_activate'=>$bot_activate,
          'bot_group_chat'=>$request['bot_group_chat'],
          'bot_channel'=>$request['bot_channel'],
          'site_address'=>$request['site_address'],
          'btc_address'=>$request['btc_address'],
          'ltc_address'=>$request['ltc_address'],
          's_s_k'=>$request['s_s_k'],
          's_p_k'=>$request['s_p_k'],
          'pp_ci'=>$request['pp_ci'],
          'pp_cs'=>$request['pp_cs'],
          'eth_address'=>$request['eth_address'],
          'usdt_address'=>$request['usdt_address'],
          'bank_name'=>$request['bank_name'],
          'account_name'=>$request['account_name'],
          'account_number'=>$request['account_number'],
          'contact_email'=>$request['contact_email'],
          'tawk_to'=>strip_tags($request['tawk_to']),
          'update'=>$request['update'],
          'referral_commission'=>$request['ref_commission'],
          'referral_commission1'=>$request['ref_commission1'],
          'referral_commission2'=>$request['ref_commission2'],
          'referral_commission3'=>$request['ref_commission3'],
          'referral_commission4'=>$request['ref_commission4'],
          'referral_commission5'=>$request['ref_commission5'],
          'signup_bonus'=>$request['signup_bonus'],
          'trade_mode'=>$trade_mode,
          'updated_by'=>Auth::user()->name,
          ]);
          return redirect()->back()
          ->with('message', 'Action Sucessful');
    }

      //Trading history route
     public function tradinghistory(){
      
      return view('thistory')
      ->with(array(
        
        't_history' => tp_transactions::where('user',Auth::user()->id)->orderBy('id', 'desc')
               ->paginate(12),
        'title' => 'Trading History',
        'settings' => settings::where('id', '=', '1')->first(),
      ));
  }
  
  //Notification route
  public function notification(){
      
    return view('notification')
    ->with(array(
      'Notif' => notifications::where('user_id',Auth::user()->id)->orderBy('id', 'desc')
             ->paginate(12),
      'title' => 'Notification',
      'settings' => settings::where('id', '=', '1')->first(),
    ));
}

//Profile route
public function profile(){
  $userinfo = users::where('id',Auth::user()->id)->first();
  return view('profile')->with(array(
    'userinfo' => $userinfo,
    'title' => 'Profile',
    'settings' => settings::where('id', '=', '1')->first(),
  ));
}


//Updating Profile Route
public function updateprofile(Request $request){
    users::where('id', Auth::user()->id)->first()
        ->update([
          'name'=> $request->firstname,
          'l_name'=> $request->surname,
          'dob'=> $request->dob,
		  'phone_number'=> $request->phone,
          'adress'=> $request->address,
        ]);
    return redirect()->back()
    ->with('message', 'Account Update Sucessful!');
    
}

public function delnotif($id){
  notifications::where('id',$id)->delete();
  //$notif =notifcations::where('id',$id)->delete();
  return redirect()->back()
          ->with('message', 'Message Sucessfully Deleted');
}

  //save CoinPayments credentials to DB
        public function updatecpd(Request $request){

          cp_transactions::where('id', '1')
          ->update([
          'cp_p_key'=>$request['cp_p_key'],
          'cp_pv_key'=>$request['cp_pv_key'],
          'cp_m_id'=>$request['cp_m_id'],
          'cp_ipn_secret'=>$request['cp_ipn_secret'],
          'cp_debug_email'=>$request['cp_debug_email'],
          
          ]);
          return redirect()->back()
          ->with('message', 'Action Sucessful');
    }


    //payment route
    public function payment(Request $request){
      
      return view('payment')
      ->with(array(
        'amount'=>$request->session()->get('amount'),
        'payment_mode'=>$request->session()->get('payment_mode'),
        'pay_type' => $request->session()->get('pay_type'),
        'plan_id' => $request->session()->get('plan_id'),
        'title' => 'Make deposit',
        'settings' => settings::where('id', '=', '1')->first(),
      ));
  }

     //top up route
    public function topup(Request $request){
      $user=users::where('id',$request['user_id'])->first();
      $user_bal=$user->account_bal;
      users::where('id', $request['user_id'])
          ->update([
          'account_bal'=> $user_bal + $request['amount'],
          ]);
          
          //send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "Hello $user->name, Your Account Has just been funded. Login to dashboard to check your balance.";
        $objDemo->sender = "$settings->site_name";
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject = "Account Topup!";
            
        Mail::bcc($user->email)->send(new NewNotification($objDemo));


          return redirect()->route('manageusers')
          ->with('message', 'Action Successful!');
    }
    
      //top up route
    public function popup(Request $request){
      $user=users::where('id',$request['user_id'])->first();
      $user_bal=$user->notify;
      users::where('id', $request['user_id'])
          ->update([
          'notify'=> $request['amount'],
          ]);
          
          //send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "Hello $user->name, You have a vital notification on your dashboard, please login to check";
        $objDemo->sender = "$settings->site_name";
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject = "Popup Notification!";
            
        Mail::bcc($user->email)->send(new NewNotification($objDemo));


          return redirect()->route('manageusers')
          ->with('message', 'Action Successful!');
    }
    
    
      //top up route
    public function toppup(Request $request){
      $user=users::where('id',$request['user_id'])->first();
      $user_bal=$user->roi;
       $user_bali=$user->account_bal;
      users::where('id', $request['user_id'])
          ->update([
          'roi'=> $user_bal + $request['amount'],
          'account_bal'=> $user_bali + $request['amount'],
          ]);
          
          //send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "Hello $user->name, ROI has been credited to your account, Login to dashboard to check your balance.";
        $objDemo->sender = "$settings->site_name";
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject = "ROI Credit Alert!";
            
        Mail::bcc($user->email)->send(new NewNotification($objDemo));


          return redirect()->route('manageusers')
          ->with('message', 'Action Successful!');
    }
    
    
      //Signal route
    public function topupp(Request $request){
      $user=users::where('id',$request['user_id'])->first();
      $user_bal=$user->sig;
      users::where('id', $request['user_id'])
          ->update([
          'sig'=> $request['amount'],
          ]);
          
          //send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "Hello $user->name, Signal Bill has been Assigned, Login to dashboard to check Now.";
        $objDemo->sender = "$settings->site_name";
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject = "Signal Bill Allocation!";
            
        Mail::bcc($user->email)->send(new NewNotification($objDemo));

          return redirect()->route('manageusers')
          ->with('message', 'Action Successful!');
    }
    
    
     //Upgrade route
    public function topupo(Request $request){
      $user=users::where('id',$request['user_id'])->first();
      $user_bal=$user->user_plan;
      users::where('id', $request['user_id'])
          ->update([
          'user_plan'=> $request['amount'],
          ]);
          
          //send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "Hello $user->name, Your Account Has just been Upgraded Successfully, Login to dashboard to check Now.";
        $objDemo->sender = "$settings->site_name";
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject = "Account Plan Upgrade";
            
        Mail::bcc($user->email)->send(new NewNotification($objDemo));


          return redirect()->route('manageusers')
          ->with('message', 'Action Successful!');
    }
    
    
    
    //Return KYC route
      public function kyc()
      {
        return view('kyc')
          ->with(array(
          'title'=>'KYC',
          'users' => users::where('id_card','!=', NULL)->where('passport','!=',NULL)->where('id_back','!=',NULL)->get(),
          'settings' => settings::where('id', '=', '1')->first(),
           'kyc' => users::where('id_card','!=', NULL)->orderBy('id', 'desc')
               ->paginate(12),
          ));
      }
      
       //Save verification documents requests
  public function savevdocs(Request $request){

      $this->validate($request, [
      'id' => 'mimes:jpg,jpeg,png|max:4000',
      'passport' => 'mimes:jpg,jpeg,png|max:4000',
      'ic' => 'mimes:jpg,jpeg,png|max:4000',
      ]);
      
      
      $settings=settings::where('id','1')->first();
        
        //proofs
        $id=$request->file('id');
        $ic=$request->file('ic');
        $passport=$request->file('passport');
        $upload_dir="app/qwery/123/qwerty/uploads/passport";
        
        $image1 = date('Ymd') . '_*_&' . time() . '.' . $id->getClientOriginalName();
        //$image1=$id->getClientOriginalName();
        $move=$id->move($upload_dir, $image1);
        
        $image2 = date('Ymd') . '_*_&' . time() . '.' . $passport->getClientOriginalName();
        //$image2=$passport->getClientOriginalName();
        $move=$passport->move($upload_dir, $image2);
        
        $image3 = date('Ymd') . '_*_&' . time() . '.' . $ic->getClientOriginalName();
        //$image1=$id->getClientOriginalName();
        $move=$ic->move($upload_dir, $image3);
        
        //end proofs process
       
    //update user
    users::where('id',Auth::user()->id)
    ->update([
        'id_card' => $image1,
        'id_back' => $image3,
        'passport' => $image2,
        'account_verify' => 'Under review',
        ]);
$message ="You Verification request has been submitted for review.";
    $returnMSG =  $this->SendSms($user->phone_number , $message);
  return redirect()->back()
  ->with('message', 'Action Sucessful! Please wait for system to validate your submission.');
}
  
  
   //accept KYC route
      public function acceptkyc($id)
      {
        //update user
        users::where('id',$id)
        ->update([
            'account_verify' => 'Verified',
            ]);
    $message ="Congratulations!!! Your Account has been verified Successfully";
    $returnMSG =  $this->SendSms($user->phone_number , $message);
    

      return redirect()->back()
      ->with('message', 'Action Sucessful!');
      }
      
       //RJECT KYC route
      public function rejectkyc($id)
      {
        //update user
        users::where('id',$id)
        ->update([
            'account_verify' => 'Rejected',
            ]);
    $message ="Sorry!!! Your Account Verification was not Successful, Please Contact Support.";
    $returnMSG =  $this->SendSms($user->phone_number , $message);
    
      return redirect()->back()
      ->with('message', 'Action Sucessful!');
      }
    
    

    //Return payment page
    public function deposit(Request $request){
       /*
         //fetch user plan
    $dplan=plans::where('id',Auth::user()->plan)->first();
    
    if(count($dplan)<1){
        return redirect()->route('mplans')
      ->with('message', 'Please choose an investment plan first.');
    }
  
  
    if($request['amount'] != $dplan->price){
        return redirect()->back()->with('message',"The amount must be your current plan price. $dplan->price.");
    }*/
      //store payment info in session
      $request->session()->put('amount', $request['amount']);
      $request->session()->put('payment_mode', $request['payment_mode']);

      if(isset($request['pay_type'])){
      $request->session()->put('pay_type', $request['pay_type']);
      $request->session()->put('plan_id', $request['plan_id']);
      }
      $user=users::where('id',Auth::user()->id)->first();
      return redirect()->route('payment')
      ->with(array(
        'title' => 'Make deposit',
        'settings' => settings::where('id', '=', '1')->first(),
      ));
  }

  //Save deposit requests
  public function savedeposit(Request $request){

      $this->validate($request, [
      'proof' => 'mimes:jpg,jpeg,png|max:4000',
      ]);
        
        $settings=settings::where('id','1')->first();
        
       //screenshot
        $img=$request->file('proof');
        $upload_dir='app/qwery/123/qwerty/uploads/proof';
        
        $image = date('Ymd') . '_*_&' . time() . '.' . $img->getClientOriginalName();
        //$image=$img->getClientOriginalName();
        $move=$img->move($upload_dir, $image);
        //end screenshot process
        
        if($request['pay_type']=='plandeposit'){
          //add the user to this plan for approval
          users::where('id',Auth::user()->id)
          ->update([
            'plan'=> $request['plan_id'],
          ]);
          $plan=$request['plan_id'];
        }
        else{
          $plan=Auth::user()->plan;
        }
       
    $dp=new deposits();

    $dp->amount= $request['amount'];
    $dp->payment_mode= $request['payment_mode'];
    $dp->status= 'Pending';
    $dp->proof= $image;
    $dp->plan= $plan;
    $dp->hashurl= $request['hashurl'];
    $dp->user= Auth::user()->id;
    $dp->save();

    // Kill the session variables
    $request->session()->forget('plan_id');
    $request->session()->forget('pay_type');
    $request->session()->forget('payment_mode');
    $request->session()->forget('amount');
    $message ="Your Deposit was succesfull, Please wait for validation. Amount: $" . $request['amount'];
    $returnMSG =  $this->SendSms($user->phone_number , $message);
  return redirect()->route('deposits')
  ->with('message', 'Action Sucessful! Please wait for system to validate this transaction.');
}

    //Save withdrawal requests
     public function withdrawal(Request $request){
            //get settings
            $settings=settings::where('id','1')->first();
            
             if($settings->enable_kyc =="yes"){
                if(Auth::user()->account_verify != "Verified"){
                    return redirect()->back()->with('message','Your account must be verified before you can make withdrawal.');
                }
             }
            
            $method=wdmethods::where('id',$request['method_id'])->first();
            $charges_percentage = $request['amount'] * $method->charges_percentage/100;
            $to_withdraw = $request['amount'] + $charges_percentage + $method->charges_fixed;
            //return if amount is lesser than method minimum withdrawal amount
            

            if(Auth::user()->account_bal < $to_withdraw){
               return redirect()->back()
            ->with('message', 'Sorry, your account balance is insufficient for this request.'); 
            }
            
            if($request['amount'] < $method->minimum){
               return redirect()->back()
            ->with("message", "Sorry, The minimum amount is $$method->minimum."); 
            }
            
            //get user last investment package
            $last_user_plan=user_plans::where('user',Auth::user()->id)
            ->where('active','yes')
            ->orderby('activated_at','ASC')->first();
            
            /*if(count($last_user_plan) < 1){
                return redirect()->back()->with('message','You can not make withdrawal yet. You must have an investment running.');
            }*/
            
           //if 30 days has reached since activation
           /*if($last_user_plan->activated_at->diffInDays() < 30){
               return redirect()->back()->with('message','Your investment(s) is not due for withdrawal yet. You must wait till 30 days after your last investment.');
           }*/
           
          //get user
         $user=users::where('id',Auth::user()->id)->first();
         
         $amount= $request['amount'];
         $ui = $user->id;

         if(empty($user->btc_address)){
          return redirect()->route('acountdetails')
          ->with('message', 'You must set up your coins wallet address before you can withdraw.');
        }
         
         //debit user
         users::where('id',$user->id)
          ->update([
          'account_bal' => $user->account_bal-$to_withdraw,
          ]);
      
         //send notification
         $settings=settings::where('id', '=', '1')->first();
        
        //send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "This is to inform you that a withdrawal request has just occured on your account. Amount: $$amount.";
        $objDemo->sender = $settings->site_name;
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject ="Withdrawal Request";
            
        Mail::bcc($user->email)->send(new NewNotification($objDemo));
         //send sms on widthdraw;
         $returnMSG =  $this->SendSms($user->phone_number ,"This is to inform you that a withdrawal request has just occured on your account. Amount: $$amount.");
           if ($returnMSG == "success") {
             $returnmessage = 'Action Sucessful! Please wait for system to process your request. Sms sent to';
           }
           else {$returnmessage = 'Action Sucessful! Please wait for system to process your request.';}
           
         if($request['payment_mode']=='Bitcoin'){
            if(empty($user->btc_address)){
                return redirect()->route('acountdetails')
                ->with('message', 'You must set up your coins wallet address before you can withdraw.');
            }
          $payment_mode = "Bitcoin";
          $coin="BTC"; 
          $wallet=$user->btc_address;
          //create auto transaction
          if($settings->withdrawal_option =="auto"){
            return $this->cpwithdraw($amount, $coin, $wallet, $ui, $to_withdraw);
          }
         }elseif($request['payment_mode']=='Ethereum'){
            if(empty($user->eth_address)){
                return redirect()->route('acountdetails')
                ->with('message', 'You must set up your coins wallet address before you can withdraw.');
            }
          $payment_mode = "Ethereum";
          $coin="ETH"; 
          $wallet=$user->eth_address;
          //create auto transaction
          if($settings->withdrawal_option =="auto"){
            return $this->cpwithdraw($amount, $coin, $wallet, $ui, $to_withdraw);
          }
         }elseif($request['payment_mode']=='Litecoin'){
            if(empty($user->ltc_address)){
                return redirect()->route('acountdetails')
                ->with('message', 'You must set up your coins wallet address before you can withdraw.');
            }
          $payment_mode = "Litecoin";
          $coin="LTC";  
          $wallet=$user->ltc_address;
          //create transaction
        //create auto transaction
          if($settings->withdrawal_option =="auto"){
            return $this->cpwithdraw($amount, $coin, $wallet, $ui, $to_withdraw);
          }
         }else{
             $payment_mode = "Bank transfer";
         }
         //save withdrawal info
            $dp=new withdrawals();
                      
            //$dp->txn_id= $txn_id;         
            $dp->amount= $amount;
            $dp->to_deduct= $to_withdraw;
            $dp->payment_mode= "$payment_mode";
            $dp->status= 'Pending';
            $dp->user= $user->id;
            
            $dp->save();  
            
            return redirect()->back()
          ->with('message',  $returnmessage);
         
          
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
