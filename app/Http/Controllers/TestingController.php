<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestingController extends Controller
{
  public function index()
  {
    $out = Auth::user()->iscommittee;
    var_dump($out);
    var_dump($out); die();
    return $out;
  }
}
