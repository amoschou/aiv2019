<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
  public function post()
  {
    $_SESSION['webhook'] = $_POST;
    return response('OK', 200);
  }

  public function index()
  {
    session_start();
    if(isset($_SESSION['webhook']))
    {
      var_dump($_SESSION['webhook']);
    }
    else
    {
      echo "No webhook data";
    }
    die();
  }
}
