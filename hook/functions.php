<?php

function HookedOnAFeeling( $url,$curl_data=NULL ) { 
    $options = array( 
        CURLOPT_RETURNTRANSFER => true,         // return web page 
        CURLOPT_HEADER         => false,        // don't return headers 
        CURLOPT_FOLLOWLOCATION => true,         // follow redirects 
        CURLOPT_ENCODING       => "",           // handle all encodings 
        CURLOPT_USERAGENT      => "Private SMS",     // who am i 
        CURLOPT_AUTOREFERER    => true,         // set referer on redirect 
        CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect 
        CURLOPT_TIMEOUT        => 120,          // timeout on response 
        CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects 
        CURLOPT_POST           => (!$curl_data) ? 0 : 1,            // i am sending post data 
        CURLOPT_POSTFIELDS     => $curl_data,    // this are my post vars 
        CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl 
        CURLOPT_SSL_VERIFYPEER => false,        // 
        CURLOPT_VERBOSE        => 1                // 
    ); 

    $ch      = curl_init($url); 
    curl_setopt_array($ch,$options); 
    $content = curl_exec($ch); 
    $err     = curl_errno($ch); 
    $errmsg  = curl_error($ch) ; 
    $header  = curl_getinfo($ch); 
    curl_close($ch); 

     // $header['errno']   = $err; 
     // $header['errmsg']  = $errmsg; 
     $header['content'] = $content; 
    return $header; 
}
