<?php

namespace App\Notifications\Channels;

// use Ghasedak\Laravel\GhasedakFacade;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Notifications\Notification;


class SMSChannel
{

    public function send($notifiable, Notification $notification)
    {
        try {
            $info = $notification->getInfo();

            $message = $info['sms_message'];

            $receptor = $notifiable->mobile;

            $this->sendSMS($message, $receptor);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function sendWithoutUser($details)
    {
        extract($details);
        
        try {
            $this->sendSMS($message, $mobile);
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    private function sendSMS($message, $receptor)
    {
        $lineNumber = config('ghasedak.line_number');

        $api_key = config("services.ghasedak.key");


        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => config('ghasedak.urls.simple_sms'),
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "message=$message&sender=$lineNumber&Receptor=$receptor",
                CURLOPT_HTTPHEADER => array(
                    "apikey: {$api_key}",
                ),
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }
}