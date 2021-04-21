<?php
	//session törlés és kezdőlapra irányítás
	session_start();
	session_destroy();
	include("_jumping.php");
	jumping("../index.php?page=homepage",1);
?>