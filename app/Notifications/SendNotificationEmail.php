<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendNotificationEmail extends Notification
{
    use Queueable;

    protected $line1;
    protected $action_text;
    protected $action_route;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($line1, $action_text, $action_route)
    {
        $this->line1 = $line1;
        $this->action_text = $action_text;
        $this->action_route = $action_route;
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
            ->subject('Has recibido una nueva notificación')
            ->greeting('Hola ' . $notifiable->name . ',')
            ->line($this->line1)
            ->line('Haga clic en el enlace a continuación para ver más detalles.')
            ->action($this->action_text, route($this->action_route))
            ->line('¡Gracias por usar nuestra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
