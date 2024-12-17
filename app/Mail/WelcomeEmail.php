<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email; // Add the email property

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $email
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('recipient@example.com', 'Me')
            ->to($this->email, $this->name) // Use $this-> to reference class properties
            ->view('emails.welcome')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
            ]);
    }
}
