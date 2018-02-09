<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Mail\SignupForm;
use Ramsey\Uuid\Uuid;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SignupController extends Controller
{
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
      return view ('signup.signup');
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
        DB::beginTransaction();
        $data->id = DB::table('iv_users')
                      ->where('email',$data->email)
                      ->where('username',$data->username)
                      ->value('id');
        $data->token = (string) Str::uuid();
        DB::table('iv_user_logins')->insert([
          'id' => $data->id,
          'token' => $data->token,
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
        return view ('signup.thanks', $context);
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
        DB::beginTransaction();
        $data->id = DB::table('iv_users')->insertGetId([
          'email' => $data->email,
          'username' => $data->username,
          'confirmed' => false
        ]);
        $data->token = (string) Str::uuid();
        DB::table('iv_user_logins')->insert([
          'id' => $data->id,
          'token' => $data->token,
          'remember' => $data->remember,
        ]);
        $essentialdetailsid = DB::table('rego_sections')
                                ->where('sectionname','Essential details')
                                ->value('sectionid');
        DB::table('rego_mustask')->insert([
          'userid' => $data->id,
          'sectionid' => $essentialdetailsid,
        ]);
        $data->url = secure_url("/login/{$data->token}");
        Mail::to($data->email)->send(new SignupForm($data));
        DB::commit();
        $context = [
        'activetab' => 'login',
        'titletext' => 'Registration',
        'imagesource' => 'public/images/image-1.jpg',
        ];
        return view ('signup.thanks', $context);
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
    if(!is_null($token))
    {
      $token = Uuid::fromString($token);
    }
    // Delete old tokens created earlier than 1 hour ago.
    DB::table('iv_user_logins')
      ->where('created_at','<',Carbon::parse('-60 minutes'))
      ->delete();
    // Get the record for the token.
    $record = DB::table('iv_user_logins')
                ->where('token',$token)
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
