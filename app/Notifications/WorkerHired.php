<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WorkerHired extends Notification
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
        $model = $this->model;
        $admins = User::WhereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        $workers = User::whereHas('worker', function ($worker) use ($model) {
            $worker->where('id', $model->id);
        })->get();

        return ($admins->merge($workers))->unique('id');
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
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        return [
            'message' => 'Worker :' . $this->model->user()->first()->name . ' was hired to work at '
                . $this->model->projects()->first()->name,
            'url' => "javascript:void(0)"
        ];
    }
}
