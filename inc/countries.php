<?php

$result=mysqli_query($con,"SELECT * FROM countries");

print '<h2 class="mb-4">Ország karbantartó</h2>';

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



if(isset($_POST['addCountry'])) {
		
  mysqli_query($con,"INSERT INTO countries VALUES 
  ('','$_POST[nationalitymark]','$_POST[country]')");	
      
  echo '<script type="text/javascript">';
  echo ' alert("Sikeres hozzáadás!")'; 
  echo '</script>';
  jumping("index.php?page=countries",0);
  
} else {

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