<?php

namespace App\Mail;

use App\Models\ContactBox;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $filePath;

    public function __construct(ContactBox $contact, $filePath)
    {
        $this->contact = $contact;
        $this->filePath = $filePath;
    }

    public function build()
    {
        $email = $this->subject($this->contact->subject)
            ->view('emails.contact')
            ->with([
                'name' => $this->contact->name,
                'email' => $this->contact->email,
                'subject' => $this->contact->subject,
                'messageContent' => $this->contact->message,
            ]);

        if ($this->filePath) {
            $email->attach(storage_path("app/public/{$this->filePath}"));
        }

        return $email;
    }
}