<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Mail\SignupForm;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Tuupola\Base62Proxy as Base62;

class SignupController extends Controller
{
  public function b62str($l)
  {
    $c = strlen(Base62::encode(PHP_INT_MAX)) - 1;
    $b64str = $l % $c !== 0 ? Base62::encode(random_int(0,Base62::decode(str_repeat('z',$l % $c),True))) : '';
    $l = (int) ($l/$c);
    while($l > 0)
    {
      $b64str .= Base62::encode(random_int(0,Base62::decode(str_repeat('z',$c),True)));
      $l--;
    }
    return $b64str;
  }

  public function login()
  {
    // If logged in, then redirect to /home.
    // If not logged in, then return view.
    if(Auth::check())
    {
      return redirect('/home');
    }
    else
    {
      return view ('registration.signup.signup');
    }
  }

  public function signuppost(Request $request)
  {
    $validatedData = $request->validate([
      'email' => 'required|email',
      'sharedemail' => 'sometimes|filled|in:on',
      'username' => 'string|nullable|required_if:sharedemail,on',
//      'remember' => 'sometimes|filled|in:on',
    ]);
    // Only continues if valid
    $data = (object) $validatedData;
    $data->username = $data->username ?? $data->email;
    $data->remember = isset($data->remember) ? True : False;
    $userexists = DB::table('iv_users')
                    ->where('email',$data->email)
                    ->where('username',$data->username)
                    ->exists();
    // IF USER EXISTS, THEN WE ARE LOGGING IN.
    // IF NOT, THEN WE ARE SIGNING UP.
    if($userexists)
    {
      // WE ARE LOGGIN IN
      try
      {
        $request->session()->regenerate();
        DB::beginTransaction();
        $data->id = DB::table('iv_users')
                      ->where('email',$data->email)
                      ->where('username',$data->username)
                      ->value('id');
        $data->token = $this->b62str(40);
        DB::table('iv_user_logins')->insert([
          'id' => $data->id,
          'token' => $data->token,
          'session' => session()->getId(),
          'remember' => $data->remember,
        ]);
        $data->url = secure_url("/login/{$data->token}");
        Mail::to($data->email)->send(new SignupForm($data));
        DB::commit();
        $context = [
        'activetab' => 'login',
        'titletext' => 'Registration',
        'imagesource' => 'public/images/image-1.jpg',
        ];
        return view ('registration.signup.thanks', $context);
      }
      catch (Exception $e)
      {
        DB::rollBack();
        return 'Sorry, that didn’t work.';
      }
    }
    else
    {
      // WE ARE SIGNING UP
      try
      {
        $request->session()->regenerate();
        DB::beginTransaction();
        $data->id = DB::table('iv_users')->insertGetId([
          'email' => $data->email,
          'username' => $data->username,
          'confirmed' => false,
          'accountref' => '',
        ]);

        $doesntexist = False;
        while(!$doesntexist)
        {
          $accountref = 'AR'.random_int(1000,9999).chr(random_int(65,90));
          $doesntexist = DB::table('iv_users')->where('accountref',$accountref)->doesntExist();
        }
        DB::table('iv_users')->where('id',$data->id)->update(['accountref' => $accountref]);
        
        $data->token = $this->b62str(40);
        DB::table('iv_user_logins')->insert([
          'id' => $data->id,
          'token' => $data->token,
          'session' => session()->getId(),
          'remember' => $data->remember,
        ]);
        $data->url = secure_url("/login/{$data->token}");
        Mail::to($data->email)->send(new SignupForm($data));
        DB::commit();
        $context = [
        'activetab' => 'login',
        'titletext' => 'Registration',
        'imagesource' => 'public/images/image-1.jpg',
        ];
        return view ('registration.signup.thanks', $context);
      }
      catch (Exception $e)
      {
        DB::rollBack();
        return 'Sorry, that didn’t work.';
      }
    }
  }
  
  public function logintoken ($token)
  {
    $loginpassed = False;
    // Delete old tokens created earlier than 1 hour ago.
    DB::table('iv_user_logins')
      ->where('created_at','<',Carbon::parse('-60 minutes',config('database.timezone')))
      ->delete();
    // Get the record for the token.  If it exists, then it couldn't have expired.
    $record = DB::table('iv_user_logins')
                ->where('token',$token)
                ->where('session',session()->getId())
                ->first();
    // And delete the token just used.
    DB::table('iv_user_logins')
      ->where('token',$token)
      ->delete();
    if(!is_null($record))
    {
      $loginpassed = True;
    }
    if($loginpassed)
    {
      // We record that the email address is valid.
      DB::table('iv_users')
        ->where('id',$record->id)
        ->where('confirmed',False)
        ->update(['confirmed' => True]);
      Auth::loginUsingId($record->id,$record->remember);
      return redirect('home');
    }
    else
    {
      return 'Log in failed';
    }
  }
}
