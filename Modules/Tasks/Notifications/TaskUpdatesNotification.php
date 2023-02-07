<?php

namespace Modules\Tasks\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Modules\Tasks\Entities\Task;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

/*
 * dynamic notification fol all changes in tasks
*/

class TaskUpdatesNotification extends Notification
{
    use Queueable;

    public $task;

    public $notificationType;

    public $notificationTransKey;

    public $oldStatus;

    public $newStatus;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Task $task, string $notificationType, string $notificationTransKey, string $oldStatus = '', string $newStatus = '')
    {
        // we do not need relations to inset into model_attributes field
        $this->task = $task->unsetRelations();
        $this->notificationType = $notificationType; // this will use in front
        $this->notificationTransKey = $notificationTransKey; // this will use to get multiple language notifications
        $this->oldStatus = $oldStatus; // optional ,, will used mostly with task statuse changes
        $this->newStatus = $newStatus;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', WebPushChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        // this format will be used for all tasks notifications

        return [
            // this will be used in front altenate of write all model path ,, we will use same event class name
            'notification_type' => $this->notificationType,
            'space_id' => $this->task->space_id, // very2023-01-08 05:51:52 important to show every workspace  it's related notifications
            'task_id' => $this->task->id,
            'link' => $this->task->slug,
            'notification_title' => 'tasks::notifications.task.'.$this->notificationTransKey, // to get trans in front , we just save trans key here, this key must same in front app (vuejs 118n keys) and backend
            'task_title' => $this->task->name, // to get trans in front , we just save trans key here
            'old_status' => $this->oldStatus, // to get trans in front , we just save trans key here
            'new_status' => $this->newStatus, // to get trans in front , we just save trans key here
            'user_full_name' => $notifiable->name.' '.$notifiable->family_name, // to get trans in front , we just save trans key here
            'user_image_path' => $notifiable->image_path, // to get trans in front , we just save trans key here
            'extra_attributes' => '{}', // to get trans in front , we just save trans key here
        ];
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
            'title' => 'Hello from Laravel!',
            'body' => 'Thank you for using our application.',
            'action_url' => 'https://laravel.com',
            'created' => Carbon::now()->toIso8601String(),
        ];
    }

    /**
     * Get the web push representation of the notification.
     *
     * @param  mixed  $notifiable
     * @param  mixed  $notification
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Hello from Laravel!')
            ->icon('/notification-icon.png')
            ->body('Thank you for using our application.')
            ->action('View app', 'view_app')
            ->data(['id' => $notification->id]);
    }
}
