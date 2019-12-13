<?php
/* 
on boot cron, ca bipăie telefonu cand se aprinde drăcia 
si sa ne dea ip-ul si sa stim ca are internet 
*/

$ip = shell_exec("/sbin/ifconfig  | grep 'inet'| grep -v '127.0.0.1' | cut -d: -f2 | awk '{ print $1}'");

curl_setopt_array(
	$chpush = curl_init(),
	array(
		CURLOPT_URL => "https://new.boxcar.io/api/notifications",
		CURLOPT_POSTFIELDS => array(
			"user_credentials" => '',
			"notification[title]" => 'rpi server UP',
			"notification[long_message]" => "ip: $ip\n ",
			"notification[sound]" => "up",
		)));
 
$ret = curl_exec($chpush);
curl_close($chpush);