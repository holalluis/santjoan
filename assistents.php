<?php

  //query all assistents per ordre d'apuntats
  $sql="SELECT * FROM assistents ORDER BY nom";
  $res=$mysql->query($sql) or die(mysqli_error($mysql));
?>
<h3>
  Llista boreal &mdash;
  Assistents totals: <?php echo mysqli_num_rows($res)?>
</h3>

<!--taula assistents-->
<table id=assistents border=1>
  <tr>
    <th>Nom
    <!--<th>Mail-->
    <th>Pagat
    <th>Comissió
    <th>Ajuda a muntar
    <?php if($admin)echo "<th colspan=4>Admin</th>"?>
  </tr><!--end header start content-->
  <?php
    while($row=mysqli_fetch_assoc($res)){
      //estructura assistent
      $id    = $row['id'];
      $nom   = $row['nom'];
      $mail  = $row['mail'];
      $pagat = $row['pagat'];
      $comis = $row['comis'];
      $ajuda = $row['ajuda'];

      //casella "pagat"
      $pagat_style = $pagat ? "'background:#5cb85c;'":"'background:red;'";
      $pagat_text  = $pagat ? "Sí":"No";
      //casella "comis"
      $comis_style = $comis ? "'background:#5cb85c;'":"'background:red;'";
      $comis_text  = $comis ? "Sí":"No";

      //casella "ajuda"
      $ajuda_style = $ajuda ? "'background:#5cb85c;'":"'background:red;'";
      $ajuda_text  = $ajuda ? "Sí":"No";

      //dibuixa fila assistent
      echo "<tr assistent=$id>
        <td>$nom
        <td class=bool style=$pagat_style>$pagat_text
        <td class=bool style=$comis_style>$comis_text
        <td class=bool style=$ajuda_style>$ajuda_text
      ";

      //admin editar taula asssistents
      if($admin){
        echo "
          <td><button onclick=Admin.update('assistents',$id,'pagat',".($pagat?0:1).")>Pagat</button>
          <td><button onclick=Admin.update('assistents',$id,'comis',".($comis?0:1).")>Comissió</button>
          <td><button onclick=Admin.update('assistents',$id,'ajuda',".($ajuda?0:1).")>Ajuda</button>
          <td><button onclick=Admin.delete('assistents',$id)>Esborrar</button>
        ";
      }
    }
  ?>
  
  <!--resum-->
  <tbody id=resum>
    <tr><th>Total
    <?php
      //calcula nombre de pesones que han pagat
      $pagats=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE pagat is TRUE')));
      //calcula nombre de pesones que formen part d'alguna comissió
      $comiss=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE comis is TRUE')));
      //calcula nombre de pesones que ajuden
      $ajuden=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE ajuda is TRUE')));

      echo "
        <td>$pagats
        <td>$comiss
        <td>$ajuden
      ";
    ?>
  </tbody>
</table><hr>

<style>
  #assistents td.bool {
    text-align:center;
    color:white;
  }
  #assistents #resum td{
    text-align:center;
  }
</style>
