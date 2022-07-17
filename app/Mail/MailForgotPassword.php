<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class MailForgotPassword extends Mailable
{
    protected $data;
    public function __construct($data) {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Forgot Password')
                    ->view('auth.ForgotPassword', ["data" => $this->data]);
    }
}