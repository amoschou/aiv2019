<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpressionOfInterestForm extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $exinternal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$exinternal)
    {
        $this->data = $data;
        $this->exinternal = $exinternal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['AIVCF Adelaide' => 'contact@aiv.org.au'])
                    ->subject('Expression of interest form on Adelaide IV website')
                    ->view('mail.public.expressionofinterest.index')
                    ->text('mail.public.expressionofinterest.index_plain');
    }
}
