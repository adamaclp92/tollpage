<?php

	mysqli_query($con,"DELETE FROM license_plates WHERE id='$_GET[id]'");
	echo '<script type="text/javascript">';
	echo ' alert("Rendszám törölve!")'; 
	echo '</script>';
	jumping("index.php?page=licenseplates",0);

?>