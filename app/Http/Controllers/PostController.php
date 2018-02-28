<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
  public function post(Request $request)
  {
    $requestjson = json_encode($request->json());
    DB::table('http_posts')->insert([
      'postjson' => $requestjson,
    ]);
    // If this failed, then exception happens.
    // Otherwise all good and return 200.
    return response()->setStatusCode(200);
  }

  public function get()
  {
    return view('post.post');
  }
}
