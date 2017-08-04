<?php
/**
 * Created by PhpStorm.
 * User: zuhair
 * Date: 5/8/2017
 * Time: 1:38 AM
 */
return [
    'Facebook' => [
        'secret' => env('FB_SECRET', ''),
        'appId' => '108757106465617',
        'version' => 'v2.10',
        'scope' => 'public_profile,email,publish_actions',
    ]
];
