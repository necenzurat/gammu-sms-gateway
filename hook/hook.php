<?php 
include __DIR__.'/../kernel/db.php';
include __DIR__.'/functions.php';


$smsqueue =  R::getAll( 'SELECT * FROM logs' );

foreach ($smsqueue as $sms){

	$hookresponse = HookedOnAFeeling($sms['hook'], $sms);
	
	if ($hookresponse['http_code'] == 200){
		$smsclear = R::load('logs', $sms['id']);
		R::trash($smsclear); 
	}
	/* todo if hook failez */

}