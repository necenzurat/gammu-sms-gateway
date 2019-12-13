<?php
include __DIR__."/../kernel/libs/gammu.class.php";

/* Test number 
 *
 */
$textNumber = "+407222222222";
$textMessage = "Dongle #";


$gammu_bin 				= '/usr/bin/gammu';
$gammu_config_section = '';
$config_files = glob(__DIR__.'/../dongles/*');
/*var_dump($config_files);die;*/
foreach($config_files as $file) {
	preg_match_all('!\d+!', $file, $dongleID);
	echo 'sending sms using config file ' . $file . "\n";
	$gammu = new gammu($gammu_bin,$file,$gammu_config_section);
	$gammu->send($textNumber, $textMessage . $dongleID[0][0]. ' ready', $gammu_response);
	$response = strpos($gammu_response, '..OK');
	echo $gammu_response;
	if (!$response) {
		curl_setopt_array(
		$chpush = curl_init(),
		array(
			CURLOPT_URL => "https://new.boxcar.io/api/notifications",
			CURLOPT_POSTFIELDS => array(
				"user_credentials" => '',
				"notification[title]" => 'Dongle #' . $dongleID[0][0] . ' failed',
				"notification[long_message]" => "$file failed to load and send the test sms <br /> Gammu said: $gammu_response",
				"notification[sound]" => "success",
				//"notification[open_url]" => "tel:$phone",
			)));
	 
		$ret = curl_exec($chpush);
		curl_close($chpush);
		
	}
echo "\n\n";
}