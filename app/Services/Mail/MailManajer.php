<?php
namespace App\Services\Mail;

use Illuminate\Support\Facades\Mail;

class MailManajer
{
    public function __construct() {
        
    }

    public function mail($email, $send)
    {
        Mail::to($email)->send($send);
    }
}
