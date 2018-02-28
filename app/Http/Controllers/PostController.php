<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
  public function post(Request $request)
  {
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    $endpoint_secret = config('services.stripe.webhooksecret');
    $payload = $request->getContent();
    $sig_header = $request->server('HTTP_STRIPE_SIGNATURE');
    $event = null;
    
    try {
      $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
      );
    } catch(\UnexpectedValueException $e) {
      // Invalid payload
      response(400);
      exit();
    } catch(\Stripe\Error\SignatureVerification $e) {
      // Invalid signature
      response(400);
      exit();
    }

    DB::table('http_posts')->insert([
      'postjson' => $payload,
    ]);
    // If this failed, then exception happens.
    // Otherwise all good and return 200.
    return response(200);
  }

  public function get()
  {
    return view('post.post');
  }
}

