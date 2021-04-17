<?php
	if(isset($_POST['update'])) {
		if (file_exists($_FILES['picture']['tmp_name']))
		{
			$picturename=$_FILES['picture']['name'];
			unlink("assets/$_POST[previous_picture]");
			move_uploaded_file($_FILES['picture']['tmp_name'],"assets/$picturename");
		} else {
			$picturename=$_POST['previous_picture'];
		}
		mysqli_query($con,"UPDATE categories SET 
		name='$_POST[name]', description='$_POST[description]',
		image='$picturename' WHERE id='$_POST[id]'");
		
		print "<h2> Sikeres mentés</h2>";
		jumping("index.php?page=categories",0);
		
	} else {
		
		$result=mysqli_query($con,"SELECT * FROM categories WHERE id=$_GET[id]");
		$row=mysqli_fetch_assoc($result);
		print '
		<h1 class="mb-4"> Kategória módosítása </h1>
		<form action="index.php?page=categoryupdate" method="POST" 
			enctype="multipart/form-data">
			  <div class="form-group">
			  <h3 class="font-weight-light">Kategória neve: </h3>
			  <input type="text" class="form-control w-50" 
				id="name" name="name" value="';
				print $row['name'];
				print "\">
			  </div>
			  <div class=\"form-group\">
			  <h3 class=\"font-weight-light\">Leírás: </h3>
			  <textarea cols=\"70\" rows=\"5\" name=\"description\">$row[description]</textarea>
			  </div>
			  <div class=\"form-group\">
			  <h3 class=\"font-weight-light\">Kép:</h3>
			  <img src=\"assets/$row[image]\">
				<input type=\"file\" class=\"form-control w-50\" 
				id=\"picture\" name=\"picture\">
			  </div>
			  <input type='hidden' name='id' value='$row[id]'>
			  <input type='hidden' name='previous_picture' value='$row[image]'>
			  <button type=\"submit\" name=\"update\" class=\"btn btn-primary\">
			  Kategória módosítása</button>
			</form><br><br>";
	}	

?>