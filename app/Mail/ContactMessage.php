<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;
    public $messageBody;

    /**
     * Kreira novi instance emaila.
     */
    public function __construct($email, $messageBody)
    {
        $this->email = $email;
        $this->messageBody = $messageBody;
    }

    /**
     * Gradi email.
     */
    public function build()
    {
        return $this->subject('Nova poruka sa sajta')
                    ->view('prodaja.poruka');
    }
}
