<?php 


$var = "17 / 0
Sending SMS 1/1....waiting for network answer..OK, message reference=71";

$var2 ='No response in specified timeout. Probably phone not connected.
';

$response = strpos($var, '..OK');

var_dump($response);