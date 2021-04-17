<?php
	$result=mysqli_query($con,"SELECT * FROM users 
	WHERE username='$_POST[username]' AND password='$_POST[password]'");
	
	if(mysqli_num_rows($result)>0) {
		$row=mysqli_fetch_assoc($result);
		
		echo '<script type="text/javascript">';
		echo ' alert("Sikeres bejelentkezés!")'; 
		echo '</script>';
	
		$_SESSION['login_id']=$row['id'];
		$_SESSION['login_user']=$row['username'];
		
		jumping("index.php?page=homepage",1);
	}else{

		echo '<script type="text/javascript">';
		echo ' alert("Sikertelen bejelentkezés! Hibás felhasználónév és/vagy jelszó!")'; 
		echo '</script>';
		jumping("index.php?page=login",1);
	}


?>