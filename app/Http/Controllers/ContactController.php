<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContactForm;

class ContactController extends Controller
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
        'activetab' => 'contact',
        'titletext' => 'Contact',
        'imagesource' => 'public/images/image-1.jpg',
        'essay' => [
        /*
          [
            'Website problems',
            [
              'This site is continuously updated and sometimes, something might go wrong. If you notice a problem with the website, please don’t use this form. Instead, go to <a href="https://github.com/amoschou/aiv2019/issues">https://github.com/amoschou/aiv2019/issues</a> and tell us about it there.',
            ]
          ],
          [
//            'Other issues',
            '',
            [
              'If your issue isn’t addressed on the website, please tell us about it.',
            ]
          ]
        */
        ]
      ];
      return view('public.contact.create', $context);
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
        'subject' => 'required|string',
        'message' => 'required|string',
      ]);
      // Only continues if valid.
      $data = (object) $validatedData;
      $data->messageid = DB::table('contactmessages')->insertGetId([
        'name' => $data->name,
        'email' => $data->email,
        'subject' => $data->subject,
        'message' => $data->message
      ],'messageid');
      $createdat = DB::table('contactmessages')->where('messageid',$data->messageid)->value('created_at');
      $data->date = date('d F Y',strtotime($createdat));
      $data->time = date('g:i A',strtotime($createdat));
      $data->timezone = date('T',strtotime($createdat));
      Mail::to([$data->name => $data->email])->send(new ContactForm($data,'external'));
      Mail::to(['AIVCF Adelaide' => 'contact@aiv.org.au'])->send(new ContactForm($data,'internal'));
      $context = [
        'activetab' => 'contact',
        'titletext' => 'Contact',
        'imagesource' => 'public/images/image-1.jpg',
        'data' => $data
      ];
      return view ('public.contact.thanks', $context);
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
