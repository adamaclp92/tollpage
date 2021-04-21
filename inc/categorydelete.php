<?php
	//categories.php törlés gombtól megkapott Id alapján a kategória törlése
	mysqli_query($con,"DELETE FROM categories WHERE id='$_GET[id]'");

	//Törlés megerősítése
	echo '<script type="text/javascript">';
	echo ' alert("Kategória törölve!")'; 
	echo '</script>';

	//kategória tábla frissítése
	jumping("index.php?page=categories",0);
?>