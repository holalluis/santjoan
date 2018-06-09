<?php
  //calcula nombre de pesones que han pagat
  $han_pagat=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE pagat is TRUE')));

  //query all assistents per ordre d'apuntats
  $sql="SELECT * FROM assistents ORDER BY id";
  $res=$mysql->query($sql) or die(mysqli_error($mysql));
?>
<h3>
  Llista boreal &mdash;
  Han pagat:
  <?php echo $han_pagat ?> de <?php echo mysqli_num_rows($res)?>
  assistents totals
</h3>

<!--taula assistents-->
<table border=1><tr>
    <th>Nom
    <th>Mail
    <th>Pagat
    <?php if($admin)echo "<th colspan=2>Admin</th>"?>
  </tr><!--end header start content-->
  <?php
    while($row=mysqli_fetch_assoc($res)){
      //estructura assistent
      $id    = $row['id'];
      $nom   = $row['nom'];
      $mail  = $row['mail'];
      $pagat = $row['pagat'];

      //colors casella "pagat"
      $pagat_style = $pagat ? "'background:#af0;'":"'background:red;color:white'";

      //dibuixa fila assistent
      echo "<tr assistent=$id>
        <td>$nom
        <td><a href=mailto:$mail>$mail</a>
        <td style=$pagat_style >".($pagat?"Sí":"No")."
      ";

      //admin editar taula asssistents
      if($admin){
        echo "
          <td><button onclick=Admin.update('assistents',$id,'pagat',".($pagat?0:1).")>Pagat</button>
          <td><button onclick=Admin.delete('assistents',$id)>Esborrar</button>
        ";
      }
    }
  ?>
</table><hr>
