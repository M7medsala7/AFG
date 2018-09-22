<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
class Employer extends Notification
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
    
    public function toMail($notifiable)
 
    {
  
        return (new MailMessage)
  
                    ->line('new employer is added.')
  
                    ->action('Notification Action', url('/'))
  
                    ->line('Thank you for using our application!');
  
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
