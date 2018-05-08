<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Mailgun\Mailgun;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailingListForm;
use App\Mail\MailingListWelcome;

class TestingController extends Controller
{
  public function index()
  {
    $out = Auth::user()->iscommittee;
    var_dump($out);
    var_dump($out); die();
    return $out;
  }
  
  public function ml()
  {
    $ml = DB::table('mailinglist_subscribers')->get();
    foreach($ml as $record)
    {
      $extrapar = NULL;
      if($record->namefirst === 'Clare' && $record->namelast === 'Keogh')
      {
        $extrapar = 'One reason we’ve asked for phone numbers is that at this stage, email addresses are not validated, and phone numbers help us get in contact with people who’ve provided an incorrect email address (and this has indeed happened!). Your personal information will remain private and won’t be used or disclosed unless there is genuine need.';
      }
      if($record->namefirst === 'Scott' && $record->namelast === 'Tuomi')
      {
        $extrapar = 'Thanks for you message too. It was interesting because I had no idea that the Australian Intervarsity Choral Festival had reached the US and the USC Chamber Singers.';
      }
      if($record->namefirst === 'Andrew' && $record->namelast === 'Moschou')
      {
        $data = (object) [
          'record' => $record,
          'extrapar' => $extrapar,
        ];
        Mail::to(["{$record->namefirst} {$record->namelast}" => $record->email])->send(new MailingListForm($data,'external'));
      }
    }
  }
  
  public function subscribe($random)
  {
    $record = DB::table('mailinglist_subscribers')->where('random',$random)->get()[0];
    $listAddress = 'info@aiv.org.au';
    $vars = [
      'namefirst' => $record->namefirst,
      'namelast' => $record->namelast
    ];
    $Mailgun = new Mailgun(env('MAILGUN_SECRET'));
    $result = $Mailgun->post("lists/{$listAddress}/members", [
      'address'     => $record->email,
      'name'        => "{$record->namefirst} {$record->namelast}",
      'vars'        => json_encode($vars),
      'subscribed'  => true,
      'upsert'      => 'yes',
    ]);
  }
}
