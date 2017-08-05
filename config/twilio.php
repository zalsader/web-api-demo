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
        'sendSmsEnabled' => filter_var(env('SEND_SMS_ENABLED', false), FILTER_VALIDATE_BOOLEAN),
        'toPhone' => env('TO_PHONE', '+1 256-567-5764'),
    ]
];
