<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
class AddEmployer extends Notification
{
    use Queueable;
    protected $emptype;

    public function __construct($emptype)
    {
        $this->emptype = $emptype;
    }
   
    public function via($notifiable)
    {
        return ['database'];
    }

 
    public function toDatabase($notifiable)
    {
        return [
            'emptype' => $this->emptype,
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
