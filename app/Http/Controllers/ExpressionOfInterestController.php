<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\ExpressionOfInterestForm;

class ExpressionOfInterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $context = [
        'imagesource' => 'public/images/image-2.jpg',
        'activetab' => 'participate',
        'titletext' => 'Festival registration',
        'essay' => [
          [
            'Expression of interest',
            [
              'You can express your interest to be a chorister in the festival now by telling us your name and contact details. You can even provide a payment now which will be used to offset your registration fee when full registration is opened.',
              "If you want to pay by credit or debit card, there’s no need to fill in the form here. Instead, go straight to card payments.",
              "<a class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored\" href=\"/payments/checkout\">Card payments</a>",
            ]
          ]
        ]
      ];
      return view('public.expressionofinterest.create', $context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'receipt' => 'required|string',
        'subscribe' => 'nullable'
      ]);
      // Only continues if valid.
      $data = (object) $validatedData;
      DB::beginTransaction();
      $data->expressionid = DB::table('expressionsofinterest')->insertGetId([
        'name' => $data->name,
        'email' => $data->email,
        'phone' => $data->phone,
        'receipt' => $data->receipt
      ],'expressionid');
      $subscribe = ($data->subscribe ?? 'no') === 'yes';
      DB::table('subscribeemail')->insert([
        'email' => $data->email,
        'subscribe' => $subscribe,
      ]);
      DB::commit();
      $createdat = DB::table('expressionsofinterest')->where('expressionid',$data->expressionid)->value('created_at');
      $data->date = date('d F Y',strtotime($createdat));
      $data->time = date('g:i A',strtotime($createdat));
      $data->timezone = date('T',strtotime($createdat));
      Mail::to([$data->name => $data->email])->send(new ExpressionOfInterestForm($data,'external'));
      Mail::to(['AIVCF Adelaide' => 'contact@aiv.org.au'])->send(new ExpressionOfInterestForm($data,'internal'));
      $context = [
        'activetab' => 'participate',
        'titletext' => 'Festival registration',
        'imagesource' => 'public/images/image-1.jpg',
        'data' => $data
      ];
      return view ('public.expressionofinterest.thanks', $context);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
