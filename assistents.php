<?php

  //query all assistents per ordre d'apuntats
  $sql="SELECT * FROM assistents ORDER BY nom";
  $res=$mysql->query($sql) or die(mysqli_error($mysql));
?>
<h3>
  Llista boreal &mdash;
  Persones apuntades: <?php echo mysqli_num_rows($res)?>
</h3>

<!--taula assistents-->
<table id=assistents border=1>
  <tr>
    <th>Nom
    <?php if($admin) echo "<th>Mail</th>"?>
    <th>Pagat
    <th>Comissió
    <th>Muntar
    <th>Desmuntar
    <?php if($admin) echo "<th>Esborra</th>"?>
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
      $desmu = $row['desmuntar'];

      //casella "mail"
      $mail_td = $admin ? "<td><small><a href=mailto:$mail>$mail</a></small>":"";

      //casella "pagat"
      $pagat_style = $pagat ? "'background:#5cb85c;'":"'background:red;'";
      $pagat_text  = $pagat ? "Sí":"No";
      $pagat_admin = $admin ? "<button onclick=Admin.update('assistents',$id,'pagat',".($pagat?0:1).")>canvi</button>":"";
      //casella "comis"
      $comis_style = $comis ? "'background:#5cb85c;'":"'background:red;'";
      $comis_text  = $comis ? "Sí":"No";
      $comis_admin = $admin ? "<button onclick=Admin.update('assistents',$id,'comis',".($comis?0:1).")>canvi</button>":"";
      //casella "ajuda a muntar"
      $ajuda_style = $ajuda ? "'background:#5cb85c;'":"'background:red;'";
      $ajuda_text  = $ajuda ? "Sí":"No";
      $ajuda_admin = $admin ? "<button onclick=Admin.update('assistents',$id,'ajuda',".($ajuda?0:1).")>canvi</button>":"";
      //casella "ajuda a desmuntar"
      $desmu_style = $desmu ? "'background:#5cb85c;'":"'background:red;'";
      $desmu_text  = $desmu ? "Sí":"No";
      $desmu_admin = $admin ? "<button onclick=Admin.update('assistents',$id,'desmuntar',".($desmu?0:1).")>canvi</button>":"";

      //dibuixa fila assistent
      echo "
        <tr assistent=$id>
          <td title='$mail'><small>$nom</small>
          $mail_td
          <td class=bool style=$pagat_style>$pagat_text $pagat_admin
          <td class=bool style=$comis_style>$comis_text $comis_admin
          <td class=bool style=$ajuda_style>$ajuda_text $ajuda_admin
          <td class=bool style=$desmu_style>$desmu_text $desmu_admin
      ";

      //admin esborra asssistent
      if($admin){
        echo "
          <td><button onclick=Admin.delete('assistents',$id)>Esborra</button>
        ";
      }
    }
  ?>

  <!--resum-->
  <tbody id=resum>
    <tr><th colspan="<?php if($admin)echo'2'?>">Total
    <?php
      //calcula nombre de pesones que han pagat
      $pagats=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE pagat is TRUE')));
      //calcula nombre de pesones que formen part d'alguna comissió
      $comiss=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE comis is TRUE')));
      //calcula nombre de pesones que ajuden a muntar
      $ajuden=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE ajuda is TRUE')));
      //calcula nombre de pesones que ajuden a desmuntar
      $desmunten=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE desmuntar is TRUE')));

      echo "
        <th>$pagats
        <th>$comiss
        <th>$ajuden
        <th>$desmunten
      ";
    ?>
  </tbody>
</table><hr>

<style>
  #assistents th {
    font-size:smaller;
  }
  #assistents td.bool {
    text-align:center;
    color:white;
  }
  #assistents tr:hover td {
    text-decoration:underline;
  }
</style>
