<?php
/**
  * CRUD: create read UPDATE delete
*/
include"imports.php";

//comprova permís
if(!$admin){die("Error: no admin");}

//inputs
$taula    = $mysql->escape_string($_POST['taula']);
$id       = $mysql->escape_string($_POST['id']);
$camp     = $mysql->escape_string($_POST['camp']);
$nouValor = $mysql->escape_string($_POST['nouValor']);

//update
$sql="UPDATE $taula SET $camp='$nouValor' WHERE id=$id";
$mysql->query($sql) or die(mysqli_error($mysql));

echo "
<ul>
  <li>$sql</li>
  <li>Executat correctament</li>
  <li><a href='index.php'>Inici</a></li>
</ul>
";

?>
