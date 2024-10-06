<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public $token;

    /**
     * Create a new notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Bonjour !')
                    ->subject('Réinitialisation du mot de passe')
                    ->line('Vous recevez cet e-mail parce que nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.')
                    ->action('Réinitialiser le mot de passe', url(config('app.url').route('password.reset', $this->token, false)))
                    ->line('Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune action supplémentaire n\'est requise.');
    }
}
