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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('message');
})->middleware('auth');
Route::get('about','HomeController@about')->name('home.about');
Route::get('plan','HomeController@plan')->name('home.plan');
Route::get('contact','HomeController@contact')->name('home.contact');
Route::post('contact/store','ContactController@store')->name('contact.storeQuery');
// Auth::routes();
// Authentication Routes...

Route::post('send-otp','HomeController@sendOtp')->name('home.sendOtp');
Route::post('verify-otp','HomeController@verifyOtp')->name('home.verifyOtp');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register.showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register')->name('register.register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/mobile-verification', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/verify-otp', 'Auth\ForgotPasswordController@verifyOtp')->name('password.verifyOtp');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::post('get-districts','HomeController@getDistricts')->name('home.getDistricts');
Route::post('getSponsorDetails','HomeController@getSponsorDetails')->name('home.getSponsorDetails');
// Authentication Routes Ends Here

Route::get('remote-validateion','ValidationController@remoteValidation')->name('validation.remote');

//******************* User Routes **********************//
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'roles','status'], 'roles' => 'User'], function () {
    Route::get('dashboard','user\UserController@index')->name('user.index');
    Route::get('view-profile', 'user\ProfileController@viewProfile')->name('profile.viewProfile');
    Route::get('sponsor-info', 'user\ProfileController@viewSponsor')->name('profile.viewSponsor');
    Route::get('user-security', 'user\ProfileController@viewSecurity')->name('profile.viewSecurity');
    Route::post('user-security', 'user\ProfileController@changeSecurity')->name('profile.changeSecurity');
    Route::get('register-user','user\TeamController@registeredList')->name('team.registeredList');
    Route::get('active-user','user\TeamController@activeList')->name('team.activeList');
    Route::get('direct-list','user\TeamController@directList')->name('team.directList');
    Route::get('rejected-list','user\TeamController@rejectedList')->name('team.rejectedList');
    Route::get('give-help-reports','user\ReportController@provideHelpReport')->name('report.provideHelpReport');
    Route::get('get-help-reports','user\ReportController@receiveHelpReport')->name('report.receiveHelpReport');
    Route::get('rejected-help-reports','user\ReportController@rejectedHelpReport')->name('report.rejectedHelpReport');
    Route::get('income','user\IncomeController@directIncome')->name('income.direct');
    Route::post('income-widhrawal','user\IncomeController@workingWithrawal')->name('income.workingWithrawal');
    Route::post('upload-proof','user\ProofController@uploadProof')->name('proof.uploadProof');
    Route::post('reject-help','user\UserController@rejectHelp')->name('user.rejectHelp');
    Route::post('accept-help','user\UserController@acceptHelp')->name('user.acceptHelp');
    Route::post('send-message','user\UserController@message')->name('user.message');
    Route::post('extend-timer','user\UserController@extendTimer')->name('user.extendTimer');
    Route::resource('messages', 'user\\MessageController');
});
//******************************************************//

//******************************************************//
  Route::get('help-matching','CronController@helpMatching');
  Route::get('user-status-update','CronController@userStatusUpdate');
  Route::get('access-denied','HomeController@block');
//******************************************************//

//******************* Admin Routes **********************//
Route::get('admin-login', 'admin\LoginController@loginForm')->name('admin.loginForm');
Route::post('admin-login', 'admin\LoginController@authenticate')->name('admin.authenticate');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'Admin'], function () {
    Route::get('dashboard', 'admin\AdminController@index')->name('admin.dashboard');
    Route::resource('roles', 'admin\RolesController');
    Route::resource('permissions', 'admin\PermissionsController');
    Route::resource('users', 'admin\UsersController');
    Route::resource('blog', 'admin\\BlogController');
    Route::resource('news', 'admin\\NewsController');
    Route::resource('contact', 'admin\\ContactController');
    Route::resource('subscribe', 'admin\\SubscribeController');
    Route::resource('user-profiles', 'admin\\UserProfilesController');
    Route::resource('bank-details', 'admin\\BankDetailsController');
    Route::resource('wallet-details', 'admin\\WalletDetailsController');
    Route::resource('give-helps', 'admin\\GiveHelpsController');
    Route::resource('get-helps', 'admin\\GetHelpsController');
    Route::resource('get-helps-working', 'admin\\GetHelpWorkingController');
    Route::resource('amount-charts', 'admin\\AmountChartsController');
    Route::get('change-admin-password', 'admin\UsersController@viewSecurity')->name('user.viewSecurity');
    Route::post('user-security', 'admin\UsersController@changeSecurity')->name('user.changeSecurity');
    Route::get('create-user','admin\UsersController@createUserForm')->name('user.createUserForm');
    Route::get('joining-report','admin\JoiningController@index')->name('joining.index');
    Route::get('total-new-joining','admin\JoiningController@newJoining')->name('joining.newJoining');
    Route::post('create-user','admin\UsersController@createUser')->name('user.createUser');
    Route::get('downline/total-downline','admin\DownlineController@totalDownline' )->name('downline.totalDownline');
    Route::get('downline/total-direct-team','admin\DownlineController@directTeam' )->name('downline.directTeam');
    Route::get('downline/total-rejected-list','admin\DownlineController@rejectedMembers' )->name('downline.rejectedMembers');
    Route::get('downline/total-blocked-list','admin\DownlineController@blockedMembers' )->name('downline.blockedMembers');
    Route::get('link-reports/accepted-link','admin\LinkReportController@accptedLink' )->name('linkReport.accptedLink');
    Route::get('link-reports/rejected-link','admin\LinkReportController@rejectedLink' )->name('linkReport.rejectedLink');
    Route::get('link-reports/resend-rejected-link','admin\LinkReportController@resendRejectedLink' )->name('linkReport.resendRejectedLink');
    Route::get('link-reports/pending-link','admin\LinkReportController@pendingLink' )->name('linkReport.pendingLink');
    Route::get('link-reports/senders-list','admin\LinkReportController@sendersList' )->name('linkReport.sendersList');
    Route::get('link-reports/receivers-list','admin\LinkReportController@receiverList' )->name('linkReport.receiverList');
    Route::post('delete-link','admin\LinkReportController@deleteLink' )->name('linkReport.deleteLink');
    Route::get('actions','admin\ActionController@index')->name('action.index');
    Route::get('actions/status-change','admin\ActionController@adminAction')->name('action.adminAction');
    Route::get('actions/total-link-on-off','admin\ActionController@linkAction')->name('action.linkAction');
    Route::post('actions/total-link-on-off','admin\ActionController@linkOnOff')->name('action.linkOnOff');
    Route::get('add-fund','admin\FundController@addFundForm')->name('fund.addFundForm');
    Route::post('add-fund','admin\FundController@addFund')->name('fund.addFund');
    Route::get('added-user-fund','admin\FundController@fundList')->name('fund.fundList');
    Route::post('change-order','admin\LinkReportController@changeOrder')->name('link.changeOrder');
    Route::post('change-order-give-help','admin\LinkReportController@changeOrderGive')->name('link.changeOrderGive');
});
//******************************************************//

