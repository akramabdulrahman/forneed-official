<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ServiceProviderCreated extends Notification
{
    use Queueable;
    private $model;

    /**
     * get targets.
     *
     * @return Collection
     */
    public function getTargets()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
    }

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'message' => 'Organization :' . $this->model->user()->first()->name . ' was created',
            'url' => route('Dashboard.org.verify.list', 'org')
        ];
    }
}
