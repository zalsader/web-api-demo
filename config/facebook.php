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
        'appId' => env('FB_APP_ID', ''),
        'version' => 'v2.10',
        'scope' => 'public_profile,email,publish_actions,user_photos,user_posts',
    ]
];
