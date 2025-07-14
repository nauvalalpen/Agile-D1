<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GoogleLoginNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $isNewAccount;

    public function __construct(User $user, $isNewAccount = false)
    {
        $this->user = $user;
        $this->isNewAccount = $isNewAccount;
    }

    public function build()
    {
        $subject = $this->isNewAccount 
            ? 'Welcome to oneVision - Account Created via Google'
            : 'Google Account Login - oneVision';

        $loginTime = now()->format('F j, Y, g:i a');
        $ipAddress = request()->ip();

        // error_log('loginTime: ' . $loginTime);
        // error_log('ipAddress: ' . $ipAddress);

        return $this->subject($subject)
                    ->view('emails.google-login')
                    ->with([
                        'user' => $this->user,
                        'isNewAccount' => $this->isNewAccount,
                        'loginTime' => $loginTime,
                        'ipAddress' => $ipAddress,
                    ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                address: 'thomascharicco@gmail.com',
                name: 'oneVision'
            ),
        );
    }
}
