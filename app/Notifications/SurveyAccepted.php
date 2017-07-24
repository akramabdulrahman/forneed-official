<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SurveyAccepted extends Notification
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
        $sps = User::whereHas('serviceProvider', function ($sp) use ($model) {
            $sp->WhereHas('surveys', function ($survey) use ($model) {
                $survey->where('surveys.id', $model->id);
            });
        })->get();
        $workers = User::WhereHas('worker', function ($sw) use ($model) {
            $sw->WhereHas('projects', function ($project) use ($model) {
                $project->where('id', $model->project_id);
            });
        })->get();
        return ($admins->merge($sps->merge($workers)))->unique('id');
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
            'message' => 'Survey :' . $this->model->subject . ' was accepted',
            'url' => route('Dashboard.work.survey', $this->model->id)
        ];
    }
}
