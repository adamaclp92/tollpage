<?php

//ország tábla és rendszám tábla összefűzése és tárolása
$result=mysqli_query($con,"SELECT * FROM countries
                            INNER JOIN license_plates ON countries.id = license_plates.country_id");

//azoknak az országoknak a listázása, amelyek id-ja nincs benne a rendszám táblába 
//csak olyan országot lehet a rendszám táblához hozzáadni, amelyek még nincsenek benne
$result2 = mysqli_query($con, "SELECT * FROM countries
WHERE id NOT IN (SELECT country_id FROM license_plates)");

//ha be vagyunk jelentkezve
if(isset($_SESSION['login_id'])) {

  //ha a rendszám hozzáadása gombra rákattintottunk
	if(isset($_POST['addLicense'])) {
		
    //képek változóban történő tárolása
		$picturename1=$_FILES['picture1']['name'];
    $picturename2=$_FILES['picture2']['name'];
        
    //rendszám táblába adat hozzáadása (a kiválasztott ország id-ja, méret, formátum, 1. kép, 2. kép, további infó)
    mysqli_query($con,"INSERT INTO license_plates VALUES 
		('','$_POST[country_id]','$_POST[size]','$_POST[format]','$picturename1','$picturename2', '$_POST[more_info]')");	

    //képek áthelyezése mappába
		move_uploaded_file($_FILES['picture1']['tmp_name'],"assets/$picturename1");	
    move_uploaded_file($_FILES['picture2']['tmp_name'],"assets/$picturename2");

    //sikeres hozzáadás alert
		echo '<script type="text/javascript">';
		echo ' alert("Sikeres hozzáadás!")'; 
		echo '</script>';
   
    //rendszám oldal frissítés
		jumping("index.php?page=licenseplates",0);
		
	} else {
    //nincs a rendszám hozzáadása gombra kattintva -> form betöltése (ország(id value alapján), méret, formátum, további infó, 2 kép)
		print '<br>
			<h1 class="mb-4 font-weight-light"> Rendszám hozzáadása </h1>
			<form action="index.php?page=licenseplates" method="POST" 
			enctype="multipart/form-data">

			<div class="form-group">
				<h3 class="font-weight-light">Ország: (Olyan ország választható, ami még nincs felvéve)</h3>
        <select class=\"form-select\" name="country_id" aria-label=\"Default select example\">';
        //itt történik az option-be azoknak az országoknak a megjelenítése, amelyek még nincsenek benne a rendszám táblában
        while($row=mysqli_fetch_assoc($result2)) {
          print"
        <option value=\"$row[id]\">$row[nationality_mark] - $row[country]</option>
        ";}
        print'
        </select>
			</div>

			<div class="form-group">
				<h3 class="font-weight-light">Méret: </h3>
				<textarea cols="70" rows="5" name="size" required></textarea>
			</div>

      <div class="form-group">
        <h3 class="font-weight-light">Formátum: </h3>
        <textarea cols="70" rows="5" name="format" required></textarea>
      </div>

      <div class="form-group">
        <h3 class="font-weight-light">További információ (link): </h3>
        <input type="text" class="form-control w-50" id="more_info" name="more_info" required>
      </div>

			<div class="form-group">
				<h3 class="font-weight-light">Kép 1:</h3>
				<input type="file" class="form-control w-50" id="picture1" name="picture1" required>
			</div>

      <div class="form-group">
        <h3 class="font-weight-light">Kép 2 (opcionális):</h3>
        <input type="file" class="form-control w-50" id="picture2" name="picture2" required>   
      </div>

			<button type="submit" name="addLicense" class="btn btn-success">Rendszám hozzáadása</button>
		</form><br><br>';
  }
}

//rendszámok listázása (card collapse -> card header-ben a felségjel és ország, card body-ban a 2 kép, méret, formátum, további infó)
print "<br>
    <h1 class=\"font-weight-light\">Rendszámok</h1>";  
	while($row=mysqli_fetch_assoc($result)) {

		print "  
    <div id=\"accordion\">
      <div class=\"card\">
        <div class=\"card-header\" id=\"heading$row[id]\">
          <button style=\"font-size: 25px;\" class=\"btn btn-link\" data-toggle=\"collapse\" data-target=\"#collapse$row[id]\" aria-expanded=\"true\" aria-controls=\"collapse$row[id]\">
            $row[nationality_mark] - $row[country] 
          </button>
        </div>

      <div id=\"collapse$row[id]\" class=\"collapse\" aria-labelledby=\"heading$row[id]\" data-parent=\"#accordion\">
        <div class=\"card-body\">
          <div class=\"row align-items-center my-2\">
            <div class=\"col-lg-2\">
              <img class=\"img-fluid\" 
                src=\"assets/$row[picture1]\" alt=\"\">
              <img class=\"img-fluid\" 
                src=\"assets/$row[picture2]\" alt=\"\">
            </div>

            <div class=\"col-lg-8\">
              <h5>Méret: </h5>
              <p>$row[size]</p>
              <h5>Formátum: </h5>
              <p>$row[format]</p>
              <a class=\"text-success\" href=\"$row[more_info]\" target=\"_blank\">További információ </a>
              ";
          //ha be vagyunk jelentkezve, akkor látszódik a módosítás és törlés gomb
          if(isset($_SESSION['login_id'])) {
            print"
              <a class=\"col-sm-4 text-primary\" href=\"index.php?page=licenseupdate&id=$row[id]\">Módosítás</a>
              <a class=\"col-sm-4 text-danger\" href=\"index.php?page=licensedelete&id=$row[id]\" onclick=\"return confirm('Biztosan törölni akarod a rendszámot?');\">Törlés</a>    
              ";}
            print"
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
    ";
	}
?>

