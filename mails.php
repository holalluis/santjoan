<!doctype html><html><head>
<?php include'imports.php'?>
</head><body>
<?php include'navbar.php'?>
<h3>Mails</h3><hr>
<?php
  if(!$admin)die("No ets admin");

  $taula="assistents_2018";

  echo "Taula: $taula<hr>";

  //consulta tots els mails
  $sql="SELECT * FROM $taula ORDER BY mail";
  $res=$mysql->query($sql) or die(mysqli_error($mysql));
  $n=0; //quantitat de mails
  while($row=mysqli_fetch_assoc($res)){
    //estructura assistent
    $id   = $row['id'];
    $nom  = $row['nom'];
    $mail = $row['mail'];

    //check if mail has arroba
    if(strpos($mail,'@')){
      echo "<div>
        $mail,
      </div>";
      $n++;
    }
  }

  echo "<hr>Total: $n mails";
?>
