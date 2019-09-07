<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
class PostJobs extends Notification
{
    
    use Queueable;
    protected $job;
    

    public function __construct($job)
    {
        $this->job = $job;
    }
   
    public function via($notifiable)
    {
        return ['database'];
    }

 
    public function toDatabase($notifiable)
    {
        return [
            'job' => $this->job,
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
