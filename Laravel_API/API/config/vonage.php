<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Vonage API Credentials
    |--------------------------------------------------------------------------
    |
    | Here you may specify your Vonage API credentials. These credentials
    | are used to authenticate with the Vonage API for sending SMS and
    | handling other Vonage services.
    |
    */

    'api_key' => env('VONAGE_API_KEY', 'your_api_key'),
    'api_secret' => env('VONAGE_API_SECRET', 'your_api_secret'),

    /*
    |--------------------------------------------------------------------------
    | Vonage Brand Name
    |--------------------------------------------------------------------------
    |
    | The brand name to be used when sending SMS messages through the Vonage
    | API. This will appear as the sender's name on the recipient's phone.
    |
    */

    'brand_name' => env('VONAGE_BRAND_NAME', 'YourAppName'),

    /*
    |--------------------------------------------------------------------------
    | Vonage SMS Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the default options for sending SMS messages
    | using the Vonage API. You can set the default message type, ttl, and
    | other SMS options.
    |
    */

    'sms' => [
        'type' => 'text', // Other types can be 'unicode', 'binary', 'wappush'
        'ttl' => 60000,   // Time to live in milliseconds
        'from' => env('VONAGE_SMS_FROM', 'YourAppName'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Vonage API URL
    |--------------------------------------------------------------------------
    |
    | This is the base URL for the Vonage API. You can change this URL if
    | you need to use a different endpoint, such as for testing purposes.
    |
    */

    'api_url' => env('VONAGE_API_URL', 'https://rest.nexmo.com'),

    /*
    |--------------------------------------------------------------------------
    | Vonage Webhook URLs
    |--------------------------------------------------------------------------
    |
    | If you are using Vonage webhooks, you can specify the URLs for
    | receiving webhook events here.
    |
    */

    'webhooks' => [
        'inbound_sms' => env('VONAGE_WEBHOOK_INBOUND_SMS'),
        'delivery_receipt' => env('VONAGE_WEBHOOK_DELIVERY_RECEIPT'),
    ],
];
