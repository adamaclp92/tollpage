<?php
	//adott országhoz tartozó törlés gombra kattintva törlődik a táblázatból
	mysqli_query($con,"DELETE FROM countries WHERE id='$_GET[id]'");

	//törlés megerősítés alert
	echo '<script type="text/javascript">';
	echo ' alert("Kategória törölve!")'; 
	echo '</script>';

	//ország oldal frissítése
	jumping("index.php?page=countries",0);

?>