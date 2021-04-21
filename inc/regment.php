<?php
	//reg.html-ből megkaputt username megkeresése a users táblában
	$result=mysqli_query($con,"SELECT * FROM users WHERE username='$_POST[username]'");
	
	//ha a találat > 0 jelenti azt, hogy van olyan felhasználónév, tehát nem lehet regisztrálni azzal a felhasználónévvel
	if(mysqli_num_rows($result)>0) {

		//hibaüzenet
		echo '<script type="text/javascript">';
		echo ' alert("Már van ilyen felhasználónév!")'; 
		echo '</script>';

		//oldal frissítése
		jumping("index.php?page=reg",1);
	} else {
		//különben ha a két beírt jelszó megegyezik, akkor rögzítésre kerül a users táblában
		if($_POST['password1']==$_POST['password2']) {
			$sql = "INSERT INTO users (username, password)
			VALUES ('$_POST[username]', '$_POST[password1]')";
			mysqli_query($con,$sql);
			
			//sikeres regisztráció üzenet
			echo '<script type="text/javascript">';
			echo ' alert("Sikeres regisztráció!")'; 
			echo '</script>';

			//login oldalra irányítás
			jumping("index.php?page=login",1);
	
		} else {
			//nem egyezik meg a beírt 2 jelszó
			echo '<script type="text/javascript">';
			echo ' alert("A két jelszónak meg kell egyeznie!")'; 
			echo '</script>';

			//oldal frissítése
			jumping("index.php?page=reg",1);
		}
	}
?>