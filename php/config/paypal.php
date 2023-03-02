<?php
return array(

    'sandbox_client_id'=>env(key:'PAYPAL_SANDBOX_CLIENT_ID',default''),
    'sandbox_secret'=>env(key:'PAYPAL_SANDBOX_SECRET',default''),
    'live_client_id'=>env(key:'LIVE',default''),
    'live_secret'=>env(key:'LIVE',default''),


    'settings'=>[
     'mode' => env(key:PAYPAL_MODE,default'sandbox')
    ]
);