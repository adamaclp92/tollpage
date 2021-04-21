<?php

//Ha be vagyunk jelentkezve, akkor fut le
  if(isset($_SESSION['login_id'])) {

	//Ha a kategória hozzáadása gombra rákattintunk, akkor fut le
	if(isset($_POST['addCategory'])) {
		
		//kép változóba tárolása
		$picturename=$_FILES['picture']['name'];
		
		//adatbázisba szúrás
		mysqli_query($con,"INSERT INTO categories VALUES 
		('','$_POST[name]','$_POST[description]','$picturename')");	

		//kép eltárolása
		move_uploaded_file($_FILES['picture']['tmp_name'],"assets/$picturename");	

		//alert 
		echo '<script type="text/javascript">';
		echo ' alert("Sikeres hozzáadás!")'; 
		echo '</script>';

		//oldal frissítése
		jumping("index.php?page=categories",0);
		
	} else {
		//Nincs a kategória hozzáadásra kattintva -> form (név, leírás, kép, hozzáadás gomb)
		print '<br>
			<h1 class="mb-4 font-weight-light"> Kategória hozzáadása </h1>
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
	//kategória tábla lekérdezés
	$result=mysqli_query($con,"SELECT * FROM categories");

	print" <br>
	<h1 class=\"font-weight-light\">Kategóriák</h1>";

	//kategóriák listázása (kép, név, leírás)
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

	  //ha be vagyunk jelentkezve, akkor megjelenik a módosítás és törlés gomb
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