<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountSecurityNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $action;

    public function __construct(User $user, string $action)
    {
        $this->user = $user;
        $this->action = $action;
    }

    public function build()
    {
        return $this->subject('Security Alert - ' . $this->action . ' - oneVision')
                    ->view('emails.account-security-notification');
    }
}
