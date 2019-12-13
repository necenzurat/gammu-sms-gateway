<?php
$output = shell_exec('echo "some message" | gammu -c /app/dongles/1.conf --sendsms TEXT 0722222222');
echo "<pre>$output</pre>";
//$output = shell_exec('cat /app/dongles/1.conf');
//echo "<pre>$output</pre>";
