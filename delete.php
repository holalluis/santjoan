<?php
/**
  * CRUD: create read update DELETE
*/
include"imports.php";

//comprova permís
if(!$admin){die("Error: no admin");}

//inputs
$taula = $mysql->escape_string($_POST['taula']);
$id    = $mysql->escape_string($_POST['id']);

//update
$sql="DELETE FROM $taula WHERE id=$id";
$mysql->query($sql) or die(mysqli_error($mysql));

echo "
<ul>
  <li>$sql</li>
  <li>Executat correctament</li>
  <li><a href='index.php'>Inici</a></li>
</ul>
";

?>
