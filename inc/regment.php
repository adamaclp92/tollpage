<?php
	
	$result=mysqli_query($con,"SELECT * FROM users WHERE username='$_POST[username]'");
	
	
	if(mysqli_num_rows($result)>0) {
		echo '<script type="text/javascript">';
		echo ' alert("Már van ilyen felhasználónév!")'; 
		echo '</script>';

		jumping("index.php?page=reg",1);
	} else {
		if($_POST['password1']==$_POST['password2']) {
			$sql = "INSERT INTO users (username, password)
			VALUES ('$_POST[username]', '$_POST[password1]')";
			mysqli_query($con,$sql);
			
			echo '<script type="text/javascript">';
			echo ' alert("Sikeres regisztráció!")'; 
			echo '</script>';

			jumping("index.php?page=login",1);
	
		} else {
			echo '<script type="text/javascript">';
			echo ' alert("A két jelszónak meg kell egyeznie!")'; 
			echo '</script>';

			jumping("index.php?page=reg",1);
		}
	}
?>