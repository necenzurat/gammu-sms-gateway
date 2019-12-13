<?php
include "libs/gammu.class.php";

/*-----------------------------------------
| curl --data "dongle=1&number=+07222222222&body=value2" http://digi.go.ro:8080/api.php
| :::::::::::: EXAMPLE ::::::::::::::::::
|	ls -al /dev/serial/by-id

-----------------------------------------*/
/** */
$gammu_bin 				= '/usr/bin/gammu';
$gammu_config 			= '/root/.gammurc';
$gammu_config_section	= ''; // for default section please set "blank" value --> $gammu_config_section = '';


$sms = new gammu($gammu_bin,$gammu_config,$gammu_config_section);

/* Identify Device information */
//$sms->Identify($response);

print_r($response); 

$sms->Send('+07222222222','Hello World 2 '.rand(0,100),$response);
echo "\n";
print_r($response); 


/*
$response = $sms->Get();
var_dump(($response)); 
*/
/* Sending SMS 
/*$sms->Send('+07222222222','De pe celalalt nr',$response);
echo '<pre>';
print_r($response); echo '</pre>'; */

/* Get Phone -> ME = Phone Memory; SM = Sim Card;  options list => DC|MC|RC|ON|VM|SM|ME|MT|FD|SL * /
$response = $sms->phoneBook('ME');
echo '<pre>';print_r($response); echo '</pre>'; 
/**/