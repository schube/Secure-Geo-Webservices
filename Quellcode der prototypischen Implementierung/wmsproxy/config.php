<?php

define('URL_LIZENZBROKER', 'http://www.schubec.com/aaad/www');


$configuration = array(
    'version' => '1.0', // there is no other version...
    'requestScheme' => Zend_Oauth::REQUEST_SCHEME_HEADER,
    'signatureMethod' => 'HMAC-SHA1',

   
    'callbackUrl' => 'http://fm-training.info/wmsproxy/callback.php',

    'requestTokenUrl' => URL_LIZENZBROKER.'/oauth_request_token.php',
    'authorizeUrl' => URL_LIZENZBROKER.'/oauth_authorize_token.php',
    'accessTokenUrl' => URL_LIZENZBROKER.'/oauth_access_token.php',

    'consumerKey' => 'ed7c5e4b2c9b7f3541a85da01ced279804c13b610',
    'consumerSecret' => '7ae21c810aa10a06b391bf736660dc95'
    
    
    
);