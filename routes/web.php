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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PublicController@frontpage')->name('frontpage');
Route::get('/adelaideiv', 'PublicController@adelaideiv')->name('adelaideiv');
Route::get('/aivcfadelaide', 'PublicController@aivcfadelaide')->name('aivcfadelaide');
Route::get('/participate', 'PublicController@participate')->name('participate');
Route::get('/participate/fundraising', 'PublicController@participatefundraising')->name('participatefundraising');
Route::get('/participate/choir', 'PublicController@participatechoir')->name('participatechoir');

Route::get('/participate/choir/register', 'ExpressionOfInterestController@create')->name('register');
Route::post('/participate/choir/register', 'ExpressionOfInterestController@store');
Route::get('/participate/choir/register/thanks', 'ExpressionOfInterestController@show')->name('register.thanks');

Route::view('/participate/informationforregistrants','informationforregistrants.index',['titletext' => 'Information for registrants'])->name('informationforchoristers');
Route::view('/participate/informationforregistrants/publictransport','informationforregistrants.index',['titletext' => 'Public transport: Adelaide Metro'])->name('publictransport');
Route::view('/participate/informationforregistrants/dining','informationforregistrants.index',['titletext' => 'Dining in Adelaide'])->name('dining');

Route::get('/contact', 'ContactController@create')->name('contact');
Route::post('/contact', 'ContactController@store');
Route::get('/contact/thanks', 'ContactController@show')->name('contact.thanks');

/*
  These routes only need to return views.
  A simple shortcut without defining a full route or controller.
*/

Route::view('/help',              'footmatter.index',['titletext' => 'Help'           ])->name('help');
Route::view('/privacy',           'footmatter.index',['titletext' => 'Privacy policy' ])->name('privacy');
Route::view('/privacy/summary',   'footmatter.index',['titletext' => 'Summary of the privacy policy' ])->name('privacy.summary');
Route::view('/privacy/affiliates','footmatter.index',['titletext' => 'Affiliates'     ])->name('privacy.affiliates');
Route::view('/conduct',           'footmatter.index',['titletext' => 'Code of conduct'])->name('conduct');

Route::get('/payments/checkout', 'PaymentsController@variableamountget')->name('payments.variableamount.get');
Route::post('/payments/checkout', 'PaymentsController@variableamountpost')->name('payments.variableamount.post');

Route::get('/payments', 'PaymentsController@index')->name('payments.index');
Route::post('/stripe/checkout', 'PaymentsController@stripecheckout')->name('stripe.checkout');

// If logged in, then this should redirect to /home
Route::get('/login','SignupController@login')->name('login');
Route::post('/login','SignupController@signuppost')->name('login.post');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
// If logged in already, then /login/token should not work
Route::get('/login/{token}','SignupController@logintoken');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/registration/{sectionid}', 'HomeController@displayregistration')->name('home.responses');
Route::get('/home/registration/{sectionid}/edit', 'HomeController@registrationform')->name('home.form');
Route::post('/home/registration/{sectionid}', 'HomeController@registrationformpost')->name('home.form.post');

Route::get('/banksa', 'BankingController@index')->name('banking');

Route::post('/stripe/webhook', 'WebhookController@post')->name('webhook.post');
Route::get('/stripe/webhook', 'WebhookController@index')->name('webhook');
