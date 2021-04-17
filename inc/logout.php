<?php
	session_start();
	session_destroy();
	include("_jumping.php");
	jumping("../index.php?page=homepage",1);
?>