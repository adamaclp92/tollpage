<?php
//itt nem szükséges a bejelentkezést ellenőrizni, mert az index.html-en csak akkor jelenik meg a menüpont, ha be vagyunk jelentkezve
//összes ország lekérdezése
$result=mysqli_query($con,"SELECT * FROM countries");

print '<br>
<h1 class="mb-4 font-weight-light">Ország karbantartó</h1>';

//táblázatba listázás (azonosító, felségjel, ország, és minden országhoz törlés gomb)
print '<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Felségjel</th>
    <th scope="col">Ország</th>
    <th scope="col">Törlés</th>
  </tr>
</thead>';
while($row=mysqli_fetch_assoc($result)) {
    print"
<tbody>
  <tr>
    <th scope=\"row\">$row[id]</th>
    <td>$row[nationality_mark]</td>
    <td>$row[country]</td>
    <td><a class=\"btn btn-outline-danger\" 
    href=\"index.php?page=countrydelete&id=$row[id]\" onclick=\"return confirm('Biztosan törölni akarod a kategóriát?');\">Törlés</a>
  </tr>
  ";}
  print'
</tbody>
</table>';

//ország hozzáadása gombra kattintás
if(isset($_POST['addCountry'])) {
		
  //a form adatai az ország táblába való rögzítése
  mysqli_query($con,"INSERT INTO countries VALUES 
  ('','$_POST[nationalitymark]','$_POST[country]')");	
   
  //sikeres hozzáadás alert
  echo '<script type="text/javascript">';
  echo ' alert("Sikeres hozzáadás!")'; 
  echo '</script>';

  //oldal frissítése
  jumping("index.php?page=countries",0);
  
} else {

  //nincs az ország hozzáadása gombra kattintva, a form aktív
  print '
    <h3 class="mb-4 font-weight-light"> Ország hozzáadása </h3>
    <form action="index.php?page=countries" method="POST" 
    enctype="multipart/form-data">
      <div class="form-group">
        <h4 class="font-weight-light">Ország: </h3>
        <input type="text" class="form-control w-50" 
        id="country" name="country" required>
      </div>
      <div class="form-group">
        <h4 class="font-weight-light">Felségjel: </h3>
        <input type="text" class="form-control w-50" 
        id="nationalitymark" name="nationalitymark" required>
      </div>
      <button type="submit" name="addCountry" class="btn btn-outline-success">Ország hozzáadása</button>
    </form><br><br>';
}

?>