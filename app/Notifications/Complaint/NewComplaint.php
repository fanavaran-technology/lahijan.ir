<?php

namespace App\Notifications\Complaint;

use App\Notifications\Channels\SMSChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewComplaint extends Notification
{

    use Queueable;

    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if (complaintConfig('notifications.send_sms_expert')) {
            return ['database', SMSChannel::class];
        }

        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->details['message'],
        ];
    }

    public function getInfo() {
        return $this->details;
    }
}

