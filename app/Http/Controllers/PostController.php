<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
  public function post(Request $request)
  {
    $requestjson = json_encode($request->all(),JSON_UNESCAPED_SLASHES);
    Log::info('Received post (A): ' . $requestjson);
    DB::table('html_posts')->insert([
      'postjson' => $requestjson,
    ]);
    // Ideally, this should send some HTTP response (e.g. 200) back to Stripe



// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey(config('services.stripe.secret'));

// Retrieve the request's body and parse it as JSON
$input = @file_get_contents("php://input");
$event_json = json_decode($input);

// Do something with $event_json
    Log::info('Received post (B): ' . $input);
    Log::info('Reeived post (C): ' . var_export($event_json,TRUE));
  }

  public function get()
  {
    
    return view('post.post');
  }
}
