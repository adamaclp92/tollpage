<?php

	mysqli_query($con,"DELETE FROM categories WHERE id='$_GET[id]'");
	echo '<script type="text/javascript">';
	echo ' alert("Kategória törölve!")'; 
	echo '</script>';
	jumping("index.php?page=categories",0);

?>