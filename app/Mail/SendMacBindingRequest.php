<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendMacBindingRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->description = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$user_email = User::find(Auth::id())->email;
        //$data = $data;
        $user_email = 'support.it@palmalgarments.com';
        return $this->from($user_email)
            ->subject("MAC Binding Request")
            ->view('layouts.mail.requisition-request')->with('description', $this->description);

    }
}
