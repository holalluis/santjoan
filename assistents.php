<?php
  //calcula nombre de pesones que han pagat
  $han_pagat=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE pagat is TRUE')));
  $ajuden=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE ajuda is TRUE')));

  //query all assistents per ordre d'apuntats
  $sql="SELECT * FROM assistents ORDER BY nom";
  $res=$mysql->query($sql) or die(mysqli_error($mysql));
?>
<h3>
  Llista boreal &mdash;
  Han pagat: <?php echo $han_pagat ?> &mdash;
  Ajuden: <?php echo $ajuden ?> &mdash;
  Assistents totals: <?php echo mysqli_num_rows($res)?>
</h3>

<!--taula assistents-->
<table id=assistents border=1>
  <tr>
    <th>Nom
    <!--<th>Mail-->
    <th>Pagat
    <th>Ajuda a muntar
    <?php if($admin)echo "<th colspan=3>Admin</th>"?>
  </tr><!--end header start content-->
  <?php
    while($row=mysqli_fetch_assoc($res)){
      //estructura assistent
      $id    = $row['id'];
      $nom   = $row['nom'];
      $mail  = $row['mail'];
      $pagat = $row['pagat'];
      $ajuda = $row['ajuda'];

      //casella "pagat"
      $pagat_style = $pagat ? "'background:#5cb85c;'":"'background:red;'";
      $pagat_text  = $pagat ? "Sí":"No";

      //casella "ajuda"
      $ajuda_style = $ajuda ? "'background:#5cb85c;'":"'background:red;'";
      $ajuda_text  = $ajuda ? "Sí":"No";

      //dibuixa fila assistent
      echo "<tr assistent=$id title='$mail'>
        <td>$nom
        <td class=pagat style=$pagat_style>$pagat_text
        <td class=pagat style=$ajuda_style>$ajuda_text
      ";

      //admin editar taula asssistents
      if($admin){
        echo "
          <td><button onclick=Admin.update('assistents',$id,'pagat',".($pagat?0:1).")>Pagat</button>
          <td><button onclick=Admin.update('assistents',$id,'ajuda',".($ajuda?0:1).")>Ajuda</button>
          <td><button onclick=Admin.delete('assistents',$id)>Esborrar</button>
        ";
      }
    }
  ?>
</table><hr>

<style>
  #assistents td.mail {
    font-size:smaller;
  }
  #assistents td.pagat {
    text-align:center;
    color:white;
  }
</style>
