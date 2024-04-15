<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserConfirmation extends Notification{

    public function toMail($notifiable){
        return (new MailMessage)
            ->subject('Welcome to Our Platform')
            ->line('Thank you for registering!')
            ->line('We are excited to have you as a member.')
            ->line('If you have any questions, feel free to reach out.')
            ->salutation('Best regards');
    }

    public function via($notifiable){
        return ['mail'];
    }
}
