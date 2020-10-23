<br>
<footer>
	If you win, you live. If you lose, you die. If you don’t fight, you can’t win! - Eren Yaeger
</footer>
<div class="current-time">
	<b>Current Time: </b> 
<?php 
    $date = new DateTime();
    echo $date->format("M d, Y, h:i A");
?>
<!-- different servers are giving different time -->
</div>