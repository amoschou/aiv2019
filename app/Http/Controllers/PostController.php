<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
  public function post(Request $request)
  {
    $requestjson = json_encode($request->all());
    Log::info('Received: ' . $requestjson);
    DB::table('html_posts')->insert([
      'postjson' => $requestjson,
    ]);
  }

  public function get()
  {
    
    return view('post.post');
  }
}
