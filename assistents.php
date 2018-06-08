<?php
  $sql="SELECT * FROM assistents ORDER BY nom";
  $res=$mysql->query($sql) or die(mysqli_error($mysql));
?>
<h3>Llista assistents (<?php echo mysqli_num_rows($res)?>)</h3>

<table border=1>
  <tr>
    <th>Nom
    <th>Mail
    <th>Pagat
    <?php if($admin)echo "<th colspan=2>Admin</th>"?>
  </tr>
  <?php
    while($row=mysqli_fetch_assoc($res)){
      $id    = $row['id'];
      $nom   = $row['nom'];
      $mail  = $row['mail'];
      $pagat = $row['pagat'];

      //dibuixa fila assistent
      echo "<tr assistent=$id>
        <td>$nom
        <td><a href=mailto:$mail>$mail</a>
        <td style='background:".($pagat?'#af0':'red')."'>".($pagat?"Sí":"No")."
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
