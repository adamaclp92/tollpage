<?php
	//ha a módosítás gombra kattintunk
	if(isset($_POST['update'])) {
		
		//a licenseplates.php-ból megkapott id-jú rendszám módosítása (méret és formátum módosítási lehetőség)
		mysqli_query($con,"UPDATE license_plates SET 
		size='$_POST[size]', format='$_POST[format]'
		WHERE id='$_POST[id]'");

		//sikeres módosítás alert
		echo '<script type="text/javascript">';
		echo ' alert("Sikeres módosítás!")'; 
		echo '</script>';
		
		//rendszám oldal frissítése
		jumping("index.php?page=licenseplates",0);
		
	} else {
		
		//ha nincs a módosítás gombra kattintva -> form megjelenítése (licenseplates.php-ból megkapott id megjelenítése)
		//csak a méret, és formátum módosítható, az ország és felségjel csak megjelenik
		$result=mysqli_query($con,"SELECT * FROM countries
                            INNER JOIN license_plates ON countries.id = license_plates.country_id
                            WHERE license_plates.id=$_GET[id]");
		$row=mysqli_fetch_assoc($result);
		print "
		<h1 class=\"mb-4\"> Rendszám módosítása </h1>
		<form action=\"index.php?page=licenseupdate\" method=\"POST\" 
			enctype=\"multipart/form-data\">
            
            <div class=\"form-group\">
			  <h3 class=\"font-weight-light\">Felségjel: </h3>
              <p style=\"font-size: 20px;\" class=\"text-primary\">
              $row[nationality_mark] - $row[country] 
              </p>
			</div>

            <div class=\"form-group\">
			  <h3 class=\"font-weight-light\">Méret: </h3>
			  <textarea cols=\"70\" rows=\"5\" name=\"size\">$row[size]</textarea>
			</div>

			<div class=\"form-group\">
			  <h3 class=\"font-weight-light\">Formátum: </h3>
			  <textarea cols=\"70\" rows=\"5\" name=\"format\">$row[format]</textarea>
			</div>

			<div class=\"form-group\">
			  <input type='hidden' name='id' value='$row[id]'>  
			  <button type=\"submit\" name=\"update\" class=\"btn btn-primary\">
			  Rendszám módosítása</button>
			</div>
		</form><br><br>";
	}	
?>