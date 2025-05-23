<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorMail extends Mailable
{
    public $admin;
	public $password;

    public function __construct($admin,$password){
        $this->admin = $admin;
        $this->password = $password;
    }
    public function build()
    {
        return $this->subject('Registered as a Vendor')->view('emails.vendor');
    }
}
