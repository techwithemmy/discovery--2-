<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (version_compare(PHP_VERSION, '7.1.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

/*Route::get('/', function () {
    return view('home/index');
});*/

Route::get('cloud/app/images/{file}', [ function ($file) {
    
    $settings = DB::table('settings')->where('id', '1')->first();

    $path = storage_path("../../$settings->files_key/cloud/uploads/".$file);

    if (file_exists($path)) {

        return response()->file($path, array('Content-Type' =>'image/jpeg'));

    }

    abort(503);

}]);


Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');


Route::get('/', 'UsersController@index')->name('home');
Route::get('terms', 'UsersController@terms')->name('terms');
Route::get('privacy', 'UsersController@privacy')->name('privacy');
Route::get('about', 'UsersController@about')->name('about');
Route::get('contact', 'UsersController@contact')->name('contact');
Route::get('faq', 'UsersController@faq')->name('faq');
//cron url
Route::get('cron', 'Controller@autotopup')->name('cron');

/*
Route::get('autotopup', 'Controller@autotopup')->name('autotopup');
*/
Route::get('autoconfirm', 'CoinPaymentsAPI@autoconfirm')->name('autoconfirm');


Auth::routes();

    // Two Factor Authentication
    
    Route::get('2fa', 'TwoFactorController@showTwoFactorForm')->name('2fa');
    
    Route::post('2fa', 'TwoFactorController@verifyTwoFactor');
    
    Route::get('dashboard/switchuser/{id}', ['middleware' => ['auth', 'admin'], 'uses'=>'UsersController@switchuser', 'as'=>'switchuser']);
    
    Route::post('dashboard/paypalverify/{amount}', 'Controller@paypalverify')->name('paypalverify');
    
     //activate account
    Route::get('activate/{session}', 'UsersController@activate_account')->name('activate');
    
    // KYC Routes
	Route::get('dashboard/kyc', ['middleware' => 'auth', 'uses'=>'SomeController@kyc', 'as'=>'kyc']);
	Route::get('dashboard/acceptkyc/{id}', ['middleware' => ['auth', 'admin'], 'uses'=>'SomeController@acceptkyc', 'as'=>'acceptkyc']);
	Route::get('dashboard/rejectkyc/{id}', ['middleware' => ['auth', 'admin'], 'uses'=>'SomeController@rejectkyc', 'as'=>'rejectkyc']);
	Route::post('dashboard/savevdocs', 'SomeController@savevdocs');


	Route::get('licensing', 'UsersController@licensing')->name('licensing');

	Route::get('dashboard/deposits', ['middleware' => 'auth', 'uses' => 'Controller@deposits'])->name('deposits');
	Route::get('dashboard/skip_account', ['middleware' => 'auth', 'uses' => 'Controller@skip_account'])->name('skip_account');
	Route::get('dashboard/payment', 'SomeController@payment')->name('payment');
	Route::get('dashboard/agents', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@agents'])->name('agents');
	Route::get('dashboard/viewagent/{agent}', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@viewagent'])->name('viewagent');
	Route::get('dashboard/tradinghistory', 'SomeController@tradinghistory')->name('tradinghistory');
	Route::get('dashboard/manageusers', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@manageusers'])->name('manageusers')->middleware('2fa');
	Route::get('dashboard/mwithdrawals', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@mwithdrawals'])->name('mwithdrawals')->middleware('2fa');
	Route::get('dashboard/mdeposits', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@mdeposits'])->name('mdeposits')->middleware('2fa');
	Route::get('dashboard/withdrawals', ['middleware' => 'auth', 'uses' => 'Controller@withdrawals'])->name('withdrawalsdeposits')->middleware('2fa');
	
	//dashboard
	Route::get('dashboard', ['middleware' => 'auth', 'uses'=>'Controller@dashboard','as'=>'dashboard'])->middleware('2fa');
	
	Route::get('dashboard/ublock/{id}', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@ublock']);
	Route::get('dashboard/pdeposit/{id}', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@pdeposit']);
	Route::get('dashboard/pwithdrawal/{id}', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@pwithdrawal']);
	Route::get('dashboard/dwithdrawal/{id}', ['middleware' => 'auth', 'uses' => 'Controller@dwithdrawal']);
	Route::get('dashboard/unblock/{id}', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@unblock']);
	Route::get('dashboard/paywithcard/{amount}', ['middleware' => 'auth', 'uses' => 'UsersController@paywithcard'])->name('paywithcard');
	Route::get('dashboard/cpay/{amount}/{coin}/{ui}/{msg}', ['uses' => 'Controller@cpay'])->name('cpay');
	Route::get('dashboard/mplans', ['middleware' => 'auth', 'uses' => 'Controller@mplans'])->name('mplans');
	
	Route::get('dashboard/myplans', ['middleware' => 'auth', 'uses' => 'Controller@myplans'])->name('myplans')->middleware('2fa');

	Route::get('dashboard/makeadmin/{id}/{action}', ['middleware' => ['auth', 'admin'], 'uses'=>'UsersController@makeadmin', 'as'=>'makeadmin']);
	
	Route::get('dashboard/delagent/{id}', ['middleware' => ['auth', 'admin'], 'uses'=>'UsersController@delagent', 'as'=>'delagent']);

	Route::get('dashboard/plans', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@plans'])->name('plans');
	Route::get('dashboard/pplans', ['middleware' => 'auth', 'uses' => 'Controller@pplan'])->name('pplans');
	Route::get('dashboard/trashplan/{id}', ['middleware' => ['auth', 'admin'], 'uses' => 'Controller@trashplan']);
	Route::get('dashboard/deletewdmethod/{id}', ['middleware' => ['auth', 'admin'], 'uses' => 'SomeController@deletewdmethod']);
	Route::get('dashboard/deldeposit/{id}', ['middleware' => ['auth', 'admin'], 'uses'=>'UsersController@deldeposit', 'as'=>'deldeposit']);
	//Route::get('dashboard/joinplan/{id}', ['middleware' => 'auth', 'uses' => 'Controller@joinplan']);
	Route::get('ref/{id}', ['middleware' => 'auth', 'uses'=>'Controller@ref', 'as'=>'ref']);
	Route::get('dashboard/resetpswd/{id}', ['middleware' => 'auth', 'uses'=>'UsersController@resetpswd', 'as'=>'resetpassword']);
	Route::get('dashboard/clearacct/{id}', ['middleware' => ['auth', 'admin'], 'uses'=>'Controller@clearacct', 'as'=>'clearacct']);
	Route::get('dashboard/deluser/{id}', ['middleware' => ['auth', 'admin'], 'uses'=>'UsersController@deluser', 'as'=>'deluser']);
	
	Route::get('dashboard/usertrademode/{id}/{action}', ['middleware' => ['auth', 'admin'], 'uses'=>'UsersController@usertrademode', 'as'=>'usertrademode']);
	
	Route::get('dashboard/settings', ['middleware' => ['auth', 'admin'], 'uses'=>'SomeController@settings', 'as'=>'settings'])->middleware('2fa');
	

	//Search Routes
	Route::post('dashboard/search', ['middleware' => 'auth', 'uses' => 'Controller@search']);
	Route::post('dashboard/searchdp', ['middleware' => 'auth', 'uses' => 'Controller@searchDp']);
	Route::post('dashboard/searchWith', ['middleware' => 'auth', 'uses' => 'Controller@searchWt']);

    Route::post('dashboard/joinplan', ['middleware' => 'auth', 'uses' => 'Controller@joinplan']);
	Route::post('dashboard/paywithcard/charge', ['middleware' => 'auth', 'uses' => 'UsersController@charge']);
	Route::post('dashboard/edituser', ['middleware' => 'auth', 'uses' => 'UsersController@edituser'])->middleware('admin');
	Route::post('dashboard/updateplan', ['middleware' => 'auth', 'uses' => 'Controller@updateplan']);
	Route::post('dashboard/withdrawal', 'SomeController@withdrawal');
	Route::post('sendcontact', 'UsersController@sendcontact');
	Route::post('dashboard/deposit', 'SomeController@deposit');
	Route::post('dashboard/sendmail', 'UsersController@sendmail');
	Route::post('dashboard/sendmailsingle', 'UsersController@sendmailtooneuser');
	Route::post('dashboard/topup', 'SomeController@topup');
	Route::post('dashboard/topupp', 'SomeController@topupp');
	Route::post('dashboard/topupo', 'SomeController@topupo');
	Route::post('dashboard/toppup', 'SomeController@toppup');
	Route::post('dashboard/popup', 'SomeController@popup');

	Route::post('dashboard/addagent', 'UsersController@addagent');
	Route::post('dashboard/chngemail', 'UsersController@chngemail');

	Route::post('dashboard/savedeposit', 'SomeController@savedeposit');
	Route::post('dashboard/addwdmethod', 'SomeController@addwdmethod');
	Route::post('dashboard/updatewdmethod', 'SomeController@updatewdmethod');
	Route::post('dashboard/saveuser', ['middleware' => 'auth', 'uses' => 'Controller@saveuser']);
	Route::post('dashboard/addplan', ['middleware' => 'auth', 'uses' => 'Controller@addplan']);
	
	Route::post('dashboard/updatecpd', 'SomeController@updatecpd')->middleware("admin");
	Route::post('dashboard/updatesettings', 'SomeController@updatesettings')->middleware("admin");



	Route::get('dashboard/accountdetails', ['middleware' => 'auth', 'uses'=>'UsersController@accountdetails', 'as'=>'acountdetails']);
	Route::get('dashboard/changepassword', ['middleware' => 'auth', 'uses'=>'UsersController@changepassword', 'as'=>'changepassword']);
	Route::get('dashboard/support', ['middleware' => 'auth', 'uses'=>'Controller@support', 'as'=>'support']);
	Route::get('dashboard/withdrawal', ['middleware' => 'auth', 'uses'=>'SomeController@withdrawal', 'as'=>'withdrawal']);
	Route::get('dashboard/phusers', ['middleware' => 'auth', 'uses'=>'SomeController@phusers', 'as'=>'phusers']);
	Route::get('dashboard/matchinglist', ['middleware' => 'auth', 'uses'=>'SomeController@matchinglist', 'as'=>'matchinglist']);
	Route::get('dashboard/ghuser', ['middleware' => 'auth', 'uses'=>'SomeController@ghuser', 'as'=>'ghuser']);
	Route::get('dashboard/confirmation/{id}', ['middleware' => 'auth', 'uses'=>'UsersController@confirmation', 'as'=>'confirmation']);
	Route::get('dashboard/tupload/{id}', ['middleware' => 'auth', 'uses'=>'UsersController@tupload', 'as'=>'tupload']);
	Route::get('dashboard/dnpagent', ['middleware' => 'auth', 'uses'=>'UsersController@dnpagent', 'as'=>'dnpagent']);
	Route::get('dashboard/referuser', ['middleware' => 'auth', 'uses'=>'UsersController@referuser', 'as'=>'referuser']);
	
	Route::get('dashboard/popup/{id}/{action}', ['middleware' => ['auth', 'admin'], 'uses'=>'UsersController@popup', 'as'=>'popup']);

	//Route::get('dashboard/notification', 'UsersController@notification');
	Route::get('dashboard/notification', ['middleware' => 'auth', 'uses'=>'SomeController@notification', 'as'=>'notification']);

	Route::get('dashboard/profile', ['middleware' => 'auth', 'uses'=>'SomeController@profile', 'as'=>'profile']);
// Upadting user profile info
	Route::post('dashboard/profileinfo', ['middleware' => 'auth', 'uses'=>'SomeController@updateprofile', 'as'=>'userprofile']);
	//Route::get('dashboar

	//Route::get('dashboard/plans', ['middleware' => 'auth', 'uses'=>'Controller@showplans', 'as'=>'plans']);
	Route::get('dashboard/delnotif/{id}', 'SomeController@delnotif' );

	Route::post('dashboard/AddHistory', 'Controller@addHistory');

	Route::post('dashboard/upload', 'UsersController@upload');
	Route::post('dashboard/confirm', 'UsersController@confirm');
	Route::get('dashboard/mconfirm/{id}/{ph_id}/{amount}', 'UsersController@mconfirm');
	Route::get('dashboard/mdelete/{id}/{ph_id}/{amount}', 'UsersController@mdelete');
	Route::post('dashboard/withdraw', 'SomeController@withdraw');
	Route::post('dashboard/updatephoto', 'UsersController@updatephoto');
	Route::post('dashboard/updateacct', 'UsersController@updateacct');
	Route::post('dashboard/updatepass', 'UsersController@updatepass');
	Route::post('dashboard/updatephoto', 'Controller@updatephoto');
	Route::post('dashboard/dnate', 'UsersController@dnate');
	Route::get('dashboard/donation', ['uses'=>'UsersController@donation', 'as'=>'donation']);
	Route::get('dashboard/donate/{plan}', ['uses'=>'UsersController@donate', 'as'=>'donate']);
	Route::get('ref/{id}', ['uses'=>'UsersController@ref', 'as'=>'ref']);
	Route::post('reguser', 'Auth\AuthController@reguser');
	Route::post('dashboard/saveagent', 'UsersController@saveagent');


Route::group(['middleware' => 'web'], function () {
	
});
