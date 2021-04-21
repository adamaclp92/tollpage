<?php
	//licenseplates.php-ból megkapott id-jú rendszám törlése
	mysqli_query($con,"DELETE FROM license_plates WHERE id='$_GET[id]'");

	//törlés megerősítés alert
	echo '<script type="text/javascript">';
	echo ' alert("Rendszám törölve!")'; 
	echo '</script>';

	//rendszám oldal frissítése
	jumping("index.php?page=licenseplates",0);
?>