<?php

exec('lsusb', $lsusb);

echo "<strong>Conected USB Devices</strong><br />";
foreach($lsusb as $usb){
	echo $usb.'<br />';
}


exec('ls -f /dev/serial/by-id', $tty);

echo "<strong>ttyHS Devices</strong><br />";
foreach($tty as $t){
	echo $t.'<br />';
}