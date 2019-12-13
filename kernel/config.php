<?php

/* date time */

date_default_timezone_set('Europe/Bucharest');


$host 	= "localhost";
$dbname  = "sms";
$user = "root";
$pass = "";


R::setup("mysql:host=$host;dbname=$dbname", $user, $pass);