<?php
$host 	= "localhost";
$dbname  = "sms";
$user = "root";
$pass = "";


R::setup("mysql:host=$host;dbname=$dbname", $user, $pass);