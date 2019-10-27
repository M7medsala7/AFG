<?php

namespace App\Listeners;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use App\Events\AddNotificationToFirebaseEvent;

class AddNotificationToFirebaseListener
{
    /**
    * Handle the event.
    *
    * @param  object  $event
    * @return void
    */
    public function handle(AddNotificationToFirebaseEvent $event)
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/mainandhelper-f9cb767fe446.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://mainandhelper.firebaseio.com/')
            ->create();

        $database = $firebase->getDatabase();
        $newNotification = $database
            ->getReference('notifications')
            ->push(array_merge([
                'title' => $event->title,
                'body' => $event->body,
                'token' => $event->userToken,
                'mode' => $event->mode,
                'item_id' => $event->itemId,
            ], $event->extraData));

        // $newNotification is array of pushed data 

        //$newNotification->getKey(); // => -KVr5eu8gcTv7_AHb-3-
        //$newNotification->getUri();
        // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-

        //$newNotification->getChild('title')->set('Changed post title');
        //$newNotification->getValue(); // Fetches the data from the realtime database
        //$newNotification->remove();

    }
}
