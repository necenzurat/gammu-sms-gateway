<?php
error_reporting(-1);
$dongle = $_POST['dongle'];
$number = $_POST['number'];
$body 	= $_POST['body'];
$hook 	= $_POST['hook'];

$number = preg_replace("/[^0-9]/", '', $number);

include __DIR__.'/../kernel/db.php';

if (!$dongle) {
	exit(json_encode(array('status' => 400, 'message' => 'Dongle id not provided' )));
}

if (!$number) {
	exit(json_encode(array('status' => 400, 'message' => 'Phone number not provided' )));
}

if (!$body) {
	exit(json_encode(array('status' => 400, 'message' => 'Message body not provided' )));
}

/* de adaugat multi parametri, json serializat */
$sms = R::dispense('smsqueue');
	$sms->dongle	= $dongle;
	$sms->number	= $number;
	$sms->body		= $body;
	$sms->hook		= $hook;
	$sms->try		= 0;
	$sms->raw		= json_encode($_POST);
	$sms->time		= date("Y-m-d H:i:s");
$id = R::store($sms);

if ($id) {
	$response = array ('status' => 200, 'id' => $id);
	echo json_encode($response);
}