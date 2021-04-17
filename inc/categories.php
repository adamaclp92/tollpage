<?php

  if(isset($_SESSION['login_id'])) {

	if(isset($_POST['addCategory'])) {
		
		$picturename=$_FILES['picture']['name'];
		mysqli_query($con,"INSERT INTO categories VALUES 
		('','$_POST[name]','$_POST[description]','$picturename')");	


		move_uploaded_file($_FILES['picture']['tmp_name'],"assets/$picturename");	
		echo '<script type="text/javascript">';
		echo ' alert("Sikeres hozzáadás!")'; 
		echo '</script>';
		jumping("index.php?page=categories",0);
		
	} else {
	
		print '
			<h1 class="mb-4"> Kategória hozzáadása </h1>
			<form action="index.php?page=categories" method="POST" 
			enctype="multipart/form-data">
			  <div class="form-group">
				<h3 class="font-weight-light">Kategória neve: </h3>
				<input type="text" class="form-control w-50" 
				id="name" name="name" required>
			  </div>
			  <div class="form-group">
				<h3 class="font-weight-light">Leírás: </h3>
				<textarea cols="70" rows="5" name="description" required></textarea>
			  </div>
			  <div class="form-group">
				<h3 class="font-weight-light">Kép:</h3>
				<input type="file" class="form-control w-50" 
				id="picture" name="picture" required>
			  </div>
			  <button type="submit" name="addCategory" class="btn btn-success">Kategória hozzáadása</button>
			</form><br><br>';

  }
}

	$result=mysqli_query($con,"SELECT * FROM categories");
	while($row=mysqli_fetch_assoc($result)) {

		print "    
		<div class=\"row align-items-center my-4\">
		  <div class=\"col-lg-2\">
			<img class=\"img-fluid rounded mb-1 mb-lg-1\" 
			src=\"assets/$row[image]\" alt=\"\">
		  </div>
	
		  <div class=\"col-lg-8\">
			<h1 class=\"font-weight-light\">$row[name]</h1>
			<p>$row[description]</p>
      </div>
      </div>";

      if(isset($_SESSION['login_id'])) {
      print"
      <div style=\"margin-left: 190px; margin-bottom: 100px;\">
      <a class=\"btn btn-primary\" 
		href=\"index.php?page=categoryupdate&id=$row[id]\">Módosítás</a>
	  <a class=\"btn btn-danger\" 
		href=\"index.php?page=categorydelete&id=$row[id]\" onclick=\"return confirm('Biztosan törölni akarod a kategóriát?');\">Törlés</a>
	  </div>

		";
      }
	}
?>