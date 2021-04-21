<?php
	//login.html-ből megkapott felhasználó név és jelszó páros lekérése a felhasználók táblából
	$result=mysqli_query($con,"SELECT * FROM users 
	WHERE username='$_POST[username]' AND password='$_POST[password]'");
	
	//ha a sorok száma > 0 jelenti azt, hogy a felhaszn/jelszóval van user
	if(mysqli_num_rows($result)>0) {
		$row=mysqli_fetch_assoc($result);
		
		//sikeres bejelentkezés alert
		echo '<script type="text/javascript">';
		echo ' alert("Sikeres bejelentkezés!")'; 
		echo '</script>';
	
		//login session beállítás id és username alapján
		$_SESSION['login_id']=$row['id'];
		$_SESSION['login_user']=$row['username'];
		
		//bejelentkezés után kezdőlap
		jumping("index.php?page=homepage",1);
	}else{

		//sorok száma = 0, tehát a user táblában nincs olyan felhasználó ->alert
		echo '<script type="text/javascript">';
		echo ' alert("Sikertelen bejelentkezés! Hibás felhasználónév és/vagy jelszó!")'; 
		echo '</script>';

		//ismét login tábla
		jumping("index.php?page=login",1);
	}

?>