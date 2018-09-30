<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
  public function variableamountget(Request $request)
  {
    $context = [
      'imagesource' => 'public/images/image-1.jpg',
      'activetab' => NULL,
      'titletext' => 'Payments',
      'essay' => [
        [
          '',
          [
            'Credit or debit card payments for registration fees, merchandise sales, donations, etc. can be done here.',
            'If you are expressing your interest to be a chorister in the festival, then write <strong>Preregistration</strong> in the purpose field. We suggest a payment about $50 to $100 (your choice) which will be used to offset your registration fee.',
          ]
        ],
      ],
      'ref' => $request->get('ref'),
    ];
    return view('public.payments.variableamount', $context);
  }
  public function variableamountpost(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|string',
      'email' => 'required|email',
      'subscribe' => 'nullable',
      'phone' => 'string',
      'purpose' => 'required|string',
      'cardtype' => 'required|in:domestic,international',
      'pv' => ['required', 'regex:/^\$([1-9][0-9]*|0)\.[0-9]{2}$/'],
      'fee' => ['required', 'regex:/^\$([1-9][0-9]*|0)\.[0-9]{2}$/'],
      'total' => ['required', 'regex:/^\$([1-9][0-9]*|0)\.[0-9]{2}$/'],
    ]);
    // Only continues if valid.
    $data = (object) $validatedData;
    $data->subscribe = ($data->subscribe ?? 'no') === 'yes';
    $totalarray = explode('.',substr($data->total,1));
    $data->totalincents = ((int) $totalarray[0])*100 + ((int) $totalarray[1]);
    $context = [
      'activetab' => 'participate',
      'titletext' => 'Payments',
      'imagesource' => 'public/images/image-1.jpg',
      'data' => $data,
    ];
    return view ('public.payments.checkout', $context);
  }
  public function stripecheckout()
  {
    /*
      We have available:
        $_POST['_token']
        $_POST['name']
        $_POST['email']
        $_POST['subscribe']
        $_POST['phone']
        $_POST['purpose']
        $_POST['cardtype']
        $_POST['pv']
        $_POST['fee']
        $_POST['total']
        $_POST['totalincents']
        $_POST['stripeToken']
        $_POST['stripeTokenType']
        $_POST['stripeEmail']
    */
    
    
    // Set your secret key: remember to change this to your live secret key in production
    // See your keys here: https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    // Token is created using Checkout or Elements!
    // Get the payment token ID submitted by the form:
    $tokenstring = $_POST['stripeToken'];
    
    // Check that the selected card type matches the actual card type.
    // $_POST['cardtype'] is the selected card type
    // and derived from $token
    $tokenobject = \Stripe\Token::retrieve($tokenstring);
    $cardcountry = $tokenobject->card->country;
    $selectedcardtype = $_POST['cardtype'];

    
    $validcountry = false;
    if($cardcountry === 'AU' && $selectedcardtype === 'domestic')
    {
      $validcountry = true;
    }
    if($cardcountry !== 'AU' && $selectedcardtype === 'international')
    {
      $validcountry = true;
    }
    if(!$validcountry)
    {
      abort(400, 'Unexpected country of the card.');
    }

    // Charge the user's card:
    $charge = \Stripe\Charge::create([
      "amount" => $_POST['totalincents'],
      "currency" => "aud",
      "description" => $_POST['purpose'],
      "receipt_email" => $_POST['email'],
      "metadata" => [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "subscribe" => $_POST['subscribe'],
        "phone" => $_POST['phone'],
        "purpose" => $_POST['purpose'],
        "cardtype" => $_POST['cardtype'],
        "pv" => $_POST['pv'],
        "fee" => $_POST['fee'],
        "total" => $_POST['total'],
        "totalincents" => $_POST['totalincents'],
      ],
      /* This overrides the customer's email address */
//      "receipt_email" => $_POST['email'],
      "source" => $tokenstring,
    ]);
    /*
      Returns a Charge object if the charge succeeded.
      Throws an error if something goes wrong.
      https://stripe.com/docs/api/php#errors
    */
    /* Consider declines and failed payments (https://stripe.com/docs/declines) */
    /* Consider disputes and fraud (https://stripe.com/docs/disputes) */
    
      $accountrefmatches = array();
      preg_match('/AR\d\d\d\d[A-Z]/', strtoupper($_POST['purpose']), $accountrefmatches);
      
      DB::table('rego_stripe_charges')->insert([
        'chargeid' => $charge->id,
        'accountref' => $accountrefmatches[0] ?? '',
      ]);
    
      $context = [
        'activetab' => 'participate',
        'titletext' => 'Payments',
        'imagesource' => 'public/images/image-1.jpg',
        'charge' => $charge
      ];
      return view ('public.payments.thanks', $context);
  }
}
