<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
class Request extends Notification
{
   
    use Queueable;
    protected $emp;

    public function __construct($emp)
    {
        $this->emp = $emp;
    }
   
    public function via($notifiable)
    {
        return ['database'];
    }

 
    public function toDatabase($notifiable)
    {
        return [
            'job' => $this->emp,
            'user'=>$notifiable,
            'transaction_time' => Carbon::now(),
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
            //
        ];
    }
}
