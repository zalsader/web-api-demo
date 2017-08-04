<?php
/**
 * Created by PhpStorm.
 * User: zuhair
 * Date: 5/8/2017
 * Time: 1:40 AM
 */
return [
    'Twilio' => [
        'accountSid' => env('TWILIO_ACCOUNT_SID', ''),
        'messagingSid' => env('TWILIO_MESSAGING_SID', ''),
        'authToken' => env('TWILIO_AUTH_TOKEN', ''),
    ]
];
