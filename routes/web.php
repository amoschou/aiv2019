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

/*
 * PUBLIC SITE ROUTES
 */

Route::get('/', 'PublicController@frontpage')->name('public.frontpage');
Route::get('/adelaideiv', 'PublicController@adelaideiv')->name('adelaideiv');
Route::get('/aivcfadelaide', 'PublicController@aivcfadelaide')->name('aivcfadelaide');

Route::get('/participate', 'PublicController@participate')->name('participate');
Route::get('/participate/fundraising', 'PublicController@participatefundraising')->name('participatefundraising');
Route::get('/participate/choir', 'PublicController@participatechoir')->name('participatechoir');

Route::get('/participate/choir/register', 'ExpressionOfInterestController@create')->name('register');
Route::post('/participate/choir/register', 'ExpressionOfInterestController@store');
Route::get('/participate/choir/register/thanks', 'ExpressionOfInterestController@show')->name('register.thanks');

Route::get('/contact', 'ContactController@create')->name('contact');
Route::post('/contact', 'ContactController@store');
Route::get('/contact/thanks', 'ContactController@show')->name('contact.thanks');

Route::get('/concert', 'PublicController@concert')->name('public.concert');

/*
  These routes only need to return views.
  A simple shortcut without defining a full route or controller.
*/

Route::view('/help',              'public.footmatter.index',['titletext' => 'Help'           ])->name('help');
Route::view('/privacy',           'public.footmatter.index',['titletext' => 'Privacy policy' ])->name('privacy');
Route::view('/privacy/summary',   'public.footmatter.index',['titletext' => 'Summary of the privacy policy' ])->name('privacy.summary');
Route::view('/privacy/affiliates','public.footmatter.index',['titletext' => 'Affiliates'     ])->name('privacy.affiliates');
Route::view('/conduct',           'public.footmatter.index',['titletext' => 'Code of conduct'])->name('conduct');

Route::get('/payments/checkout', 'PaymentsController@variableamountget')->name('payments.variableamount.get');
Route::post('/payments/checkout', 'PaymentsController@variableamountpost')->name('payments.variableamount.post');

Route::get('/payments', 'PaymentsController@index')->name('payments.index');
Route::post('/stripe/checkout', 'PaymentsController@stripecheckout')->name('stripe.checkout');

/*
 * REGISTRATION SITE ROUTES
 */

// If logged in, then this should redirect to /home
Route::get('/login','SignupController@login')->name('login');
Route::post('/login','SignupController@signuppost')->name('login.post');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
// If logged in already, then /login/token should not work
  Route::get('/login/{token}','SignupController@logintoken');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/registration/{sectionid}', 'HomeController@displayregistration')->name('home.responses');
Route::get('/home/registration/{sectionid}/edit', 'HomeController@registrationform')->name('home.form');
Route::get('/home/registration/{sectionid}/{foritem}/edit', 'HomeController@registrationformwithforitem')->name('home.formwithforitem');
Route::get('/home/registration/{questionshortname}/{key}/{filename}', 'HomeController@getuploadedfile')->name('home.responses.uploadedfile');

Route::post('/home/registration/{sectionid}', 'HomeController@registrationformpost')->name('home.form.post');


Route::get(
  '/home/committee',
  'CommitteeController@index'
)->middleware('committee');





/*
 * festivalinformation SITE ROUTES
 */

$textclasses = [
  'pclass' => 'mdc-typography--body1',
  'ulclass' => 'mdc-typography--body1',
  'liclass' => NULL,
  'h1class' => 'mdc-typography--display4',
  'h2class' => 'mdc-typography--display3',
  'h3class' => 'mdc-typography--display2',
  'h4class' => 'mdc-typography--display1',
  'h5class' => 'mdc-typography--subheading2',
  'h6class' => 'mdc-typography--body2',
  'titleclass' => 'mdc-typography--title',
  'captionclass' => 'mdc-typography--caption',
  'headlineclass' => 'mdc-typography--headline',
];

$fibsacronym = env('FIBS_ACRONYM', 'FIBS');
$fibsacronymlc = strtolower($fibsacronym);
$fibsacronymasaname = ucfirst($fibsacronymlc);
$fibsnameexpanded = env('FIBS_EXPANDED', 'Eff Eye Bee Ess');

$context = [
  'fibsacronym' => $fibsacronym,
  'fibsacronymlc' => $fibsacronymlc,
  'fibsacronymasaname' => $fibsacronymasaname,
  'fibsnameexpanded' => $fibsnameexpanded,
];

$context = array_merge($textclasses,$context);

Route::view("/{$fibsacronymlc}", 'festivalinformation.content.index', $context)->name('festivalinformation.content.index');
Route::view("/{$fibsacronymlc}/calendar", 'festivalinformation.content.calendar', $context)->name('festivalinformation.content.calendar');
Route::view("/{$fibsacronymlc}/maps", 'festivalinformation.content.maps', $context)->name('festivalinformation.content.maps');
Route::view("/{$fibsacronymlc}/publictransport", 'festivalinformation.content.publictransport', $context)->name('festivalinformation.content.publictransport');
Route::view("/{$fibsacronymlc}/dining", 'festivalinformation.content.dining', $context)->name('festivalinformation.content.dining');
Route::view("/{$fibsacronymlc}/fineprint", 'festivalinformation.content.fineprint', $context)->name('festivalinformation.content.fineprint');
Route::view("/{$fibsacronymlc}/dailycommentary", 'festivalinformation.content.dailycommentary.index', $context)->name('festivalinformation.content.dailycommentary');



/*
 * PRIVATE SITE ROUTES
 */

Route::get('/banksa', 'BankingController@index')->name('banking');
Route::get('/post', 'PostController@get')->name('get');

// Ideally, /post should be outside the web middleware group.
// But if it is here, remember to except the csrf token
Route::post('/post', 'PostController@post')->name('post');

Route::get('/testing', 'TestingController@index')->name('testing');

