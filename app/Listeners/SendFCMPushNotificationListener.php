<?php

namespace App\Listeners;

use FCM;
use App\UserDevicesToken;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use App\Events\SendFCMPushNotificationEvent;
use LaravelFCM\Message\PayloadNotificationBuilder;

class SendFCMPushNotificationListener
{
     /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    public function handle(SendFCMPushNotificationEvent $event)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder();

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(
            [
                'notification' => [
                    'title' => $event->title,
                    'body' => $event->body
                ],
                'data' => array_merge([
                    'mode' => $event->mode,
                    'item_id' => $event->itemId,
                ], $event->extraData)
            ]
        );

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $userTokens = UserDevicesToken::whereIn('user_id', $event->userIds)->get();
        $tokens = $userTokens->pluck('user_id', 'fcm_token')->toArray();

        if ($tokens) {
            $chuncTokens = array_chunk(array_keys($tokens), 1000);
            foreach ($chuncTokens as $chuncToken) {
             

                $downstreamResponse = FCM::sendTo($chuncToken, $option, $notification, $data);
                $downstreamResponse->numberSuccess();
                $downstreamResponse->numberFailure();
                $downstreamResponse->numberModification();
                
                $this->handleTokens($downstreamResponse, $chuncToken);

                //return Array - you should try to resend the message to the tokens in the array
                $tokensToRetry = $downstreamResponse->tokensToRetry();
                if ($tokensToRetry) {
                    $downstreamResponse = FCM::sendTo($tokensToRetry, $option, $notification, $data);

                    $this->handleTokens($downstreamResponse, $chuncToken);
                }
            }
        }
    }

    protected function handleTokens($downstreamResponse, $tokens)
    {
        //return Array - you must remove all this tokens in your database
        $tokensToDelete = $downstreamResponse->tokensToDelete();

        if ($tokensToDelete) {
            UserDevicesToken::whereIn('fcm_token', $tokensToDelete)->delete();
            foreach ($tokensToDelete as $tokenToDelete) {
                if (array_key_exists($tokenToDelete, $tokens)) {
                    unset($tokens[$tokenToDelete]);
                }
            }
        }

        // return Array (key:token, value:errror) - in production you should remove from your database the tokens present in this array
        $tokensWithError = $downstreamResponse->tokensWithError();
        if ($tokensWithError) {
            UserDevicesToken::whereIn('fcm_token', array_keys($tokensWithError))->delete();
            foreach ($tokensWithError as $tokenWithError) {
                if (array_key_exists($tokenWithError, $tokens)) {
                    unset($tokens[$tokenWithError]);
                }
            }
        }

        //return Array (key : oldToken, value : new token - you must change the token in your database )
        $tokensToModify = $downstreamResponse->tokensToModify();
        if ($tokensToModify) {
            foreach ($tokensToModify as $oldToken => $newToken) {
                UserDevicesToken::where('fcm_token', $oldToken)->update(['fcm_token' => $newToken]);
            }
        }
    }
}
