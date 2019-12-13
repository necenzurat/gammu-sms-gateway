<?php 
include __DIR__.'/../kernel/db.php';

$smsqueue =  R::getAll( 'SELECT * FROM smsqueue' );
?>

<table id="dataz" class="row-border" cellspacing="0" width="100%">
        <thead>
            <tr>
            <thead>
            <td>Dongle</td>
            <td>Number</td>
            <td>Body</td>
            <td>Try</td>
            <td>Time</td>
            <td>Hook?</td>
        </thead>
            </tr>
        </thead>
 <tbody>
 	  <?php  foreach($smsqueue as $row): ?>
        <tr>
            <td><?=$row['dongle'];?></td>
            <td><?=$row['number'];?></td>
            <td><?=$row['body'];?></td>
            <td><?=$row['try'];?></td>
            <td><?=$row['time'];?></td>
            <td><?=$row['hook'];?></td>
        </tr>
        <?php endforeach;?>
 </tbody>



        <tfoot>
            <tr>
	               
	            <td>Dongle</td>
	            <td>Number</td>
	            <td>Body</td>
	            <td>Try</td>
	            <td>Time</td>
	            <td>Hook?</td>
      
            </tr>
        </tfoot>
    </table>

