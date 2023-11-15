<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;


class SMSGroupChannel
{

    public function send($notifiable, Notification $notification)
    {
        try {
            $info = $notification->getInfo();

            $message = $info['sms_message'];

            $receptors = $info['mobile'];

            $lineNumber = "90004186";

            $api_key = config("services.ghasedak.key");

            $curl = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => config('ghasedak.urls.group_sms'),
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "message=$message&sender=$lineNumber&Receptor=$receptors",
                    CURLOPT_HTTPHEADER => array(
                        "apikey: {$api_key}",
                    ),
                )
            );
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }

        } catch (\Exception $e) {
            throw $e;
        }
    }
}