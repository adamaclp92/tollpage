<?php
	//session kezdés
	session_start();

	//adatbázis kapcsolódás, és jumping metódus
	include("inc/_dbconnect.php");
	include("inc/_jumping.php");
	
	//kapott page switch-vel történő irányítása
	if(isset($_GET['page'])) {
		switch($_GET['page']) {
			case 'login'	: $content='login.html'; break;
			case 'loginvalid': $content='loginvalid.php'; break;
			case 'reg'		: $content='reg.html'; break;
			case 'regment'	: $content='regment.php'; break;
			case 'categories'	: $content='categories.php'; break;
			case 'categorydelete'	: $content='categorydelete.php'; break;
			case 'categoryupdate'	: $content='categoryupdate.php'; break;
			case 'licenseplates'	: $content='licenseplates.php'; break;
			case 'licensedelete'	: $content='licensedelete.php'; break;
			case 'licenseupdate'	: $content='licenseupdate.php'; break;
			case 'countries'	: $content='countries.php'; break;
			case 'countrydelete'	: $content='countrydelete.php'; break;
			default: $content='homepage.html';
		}
		//ha nincs beállítva page, akkor kezdőlap
	} else {
		$content='homepage.html';
	}
	//alapértelmezetten az index.html betöltése
	include("index.html");
?>