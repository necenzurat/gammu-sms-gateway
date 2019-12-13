<?php
include __DIR__.'/../kernel/libs/gammu.class.php';
include __DIR__.'/../kernel/db.php';
include __DIR__.'/../kernel/libs/cronHelper.php';

/* lock cron */
if(($pid = cronHelper::lock()) !== FALSE) {
	/* configz */
	$gammu_bin 				= '/usr/bin/gammu';
	$gammu_config_section = '';

	/* send sms between 8 AM and 20 PM */
	if ( date('G') > 8 && date('G') < 20 ) {
		$smsqueue =  R::getAll( 'SELECT * FROM smsqueue' );
		foreach ($smsqueue as $sms) {
			$config_file = __DIR__ . '/../dongles/' . $sms['dongle'] . '.conf';
			/* useful info */
			echo 'sending sms using config file'.$config_file."\n";
			$gammu = new gammu($gammu_bin,$config_file,$gammu_config_section);
			$gammu->send('+'.$sms['number'], $sms['body'], $gammu_response);
			/* get response from gammu */
			$response = strpos($gammu_response, '..OK');
			/* if response failed */
			if ($response === false){
				/* try 3 more times */
				if ($sms['try'] < 3) {
					echo 'fail, trying again';
					$retry = R::load('smsqueue', $sms['id']);
					$retry->try = $retry['try'] + 1;
					R::store($retry);
				} else {
					/* fuck it, log it and move along */
					echo 'logging it and moving along';
					$sent = R::dispense('logs');
					$sent->status 		= 400;
					$sent->dongle 		= $sms['dongle'];
					$sent->number 		= $sms['number'];
					$sent->body 		= $sms['body'];
					$sent->hook 		= $sms['hook'];
					//$sent->hook_try 	= $sms['hook_try'];
					$sent->try 			= $sms['try'];
					$sent->raw 			= $sms['raw'];
					$sent->created 		= $sms['time'];
					$sent->updated	= date("Y-m-d H:i:s");
					$sent->response	= $gammu_response;
					$id = R::store($sent);
					/* remove from queue */
					$smsclear = R::load('smsqueue', $sms['id']);
					R::trash($smsclear); 
				}
			} 
			/* something has gone horribly right and the sms is off */
			if ($response) {
				$sent = R::dispense('logs');
				$sent->status 		= 200;
				$sent->dongle 		= $sms['dongle'];
				$sent->number 		= $sms['number'];
				$sent->body 		= $sms['body'];
				$sent->try 			= $sms['try'];
				$sent->hook 		= $sms['hook'];
				//$sent->hook_try 	= $sms['hook_try'];
				$sent->raw 			= $sms['raw'];
				$sent->created 		= $sms['time'];
				$sent->updated	= date("Y-m-d H:i:s");
				$sent->response	= $gammu_response;
				$id = R::store($sent);
				/* remove from queue */
				$smsclear = R::load('smsqueue', $sms['id']);
				R::trash($smsclear); 
				}
		}
	} // end date 

	cronHelper::unlock();
} // eof
