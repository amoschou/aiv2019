<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
  public function post(Request $request)
  {
    $requestjson = $request->getContent();
    DB::table('http_posts')->insert([
      'postjson' => $requestjson,
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
