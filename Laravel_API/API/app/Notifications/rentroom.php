<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Notifications\Messages\VonageMessage;

class rentroom extends Notification
{


    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly int $otpCode)
    {
        //

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['vonage'];
    }

    /**
     * Get the mail representation of the notification.
     */

    public function toVonage()
    {
        return (new VonageMessage)
            ->content('Your code:' . $this->otpCode);
    }
}
