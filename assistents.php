<?php
  //filtres
  $order_by = isset($_GET['ordre'])    ? "id":"nom";
  $impagats = isset($_GET['impagats']) ? "pagat=0 AND":"";
  $pagats   = isset($_GET['pagats'])   ? "pagat=1 AND":"";

  //query all assistents per ordre d'apuntats
  //millorar aquesta part
  $sql="SELECT * FROM assistents 
    WHERE $pagats $impagats 1
    ORDER BY $order_by";
  $res=$mysql->query($sql) or die(mysqli_error($mysql));
?>
<h3>
  Llista boreal &mdash;
  Persones:
  <?php 
    //nombre total de persones
    $persones = mysqli_num_rows($res);
    echo $persones;
  ?>
</h3>

<code style=display:none;font-size:small><?php echo $sql?></code>

<!--taula assistents-->
<table id=assistents border=1>
  <tr>
    <th id=columna_nom>Nom
      <?php
        //botons admin: ordenar per nom o id
        if($order_by=='id'){
          ?><button title="ordre d'arribada" onclick=window.location="index.php">&darr;123</button><?php
        }elseif($order_by=='nom'){
          ?><button title="ordre alfabètic"  onclick=window.location="index.php?ordre">&darr;ABC</button><?php
        }
      ?>
      <style>#columna_nom button {font-size:smaller }</style>
    <?php if($admin) echo "<th>Mail</th>"?>
    <th>Pagat
      <?php
        //filtre pagats impagats
        if($impagats=='' && $pagats==''){
          ?>
            <button onclick=window.location='index.php?impagats'>tots</button>
          <?php
        }else if($impagats!=''){
          ?>
            <button onclick=window.location='index.php?pagats'>impagats</button>
          <?php
        }else if($pagats!=''){
          ?>
            <button onclick=window.location='index.php'>pagats</button>
          <?php
        }
      ?>
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
      $mail_td = $admin ? "<td><small title='id $id'>$mail</small>":"";

      //casella "pagat"
      $pagat_style = $pagat ? ($pagat=="1" ? "'background:#5cb85c;'" : "'background:orange'" ) : "'background:red;'";
      $pagat_text  = $pagat ? "Sí":"No";
      $pagat_admin = "<button onclick=Admin.update('assistents',$id,'pagat',".($pagat?0:1).")>$pagat_text</button>";
      $pagat_html  = $admin ? $pagat_admin : $pagat_text;

      //casella "comis"
      $comis_style = $comis ? "'background:#5cb85c;'":"'background:red;'";
      $comis_text  = $comis ? "Sí":"No";
      $comis_admin = "<button onclick=Admin.update('assistents',$id,'comis',".($comis?0:1).")>$comis_text</button>";
      $comis_html  = $admin ? $comis_admin : $comis_text;

      //casella "ajuda a muntar"
      $ajuda_style = $ajuda ? "'background:#5cb85c;'":"'background:red;'";
      $ajuda_text  = $ajuda ? "Sí":"No";
      $ajuda_admin = "<button onclick=Admin.update('assistents',$id,'ajuda',".($ajuda?0:1).")>$ajuda_text</button>";
      $ajuda_html  = $admin ? $ajuda_admin : $ajuda_text;

      //casella "ajuda a desmuntar"
      $desmu_style = $desmu ? "'background:#5cb85c;'":"'background:red;'";
      $desmu_text  = $desmu ? "Sí":"No";
      $desmu_admin = "<button onclick=Admin.update('assistents',$id,'desmuntar',".($desmu?0:1).")>$desmu_text</button>";
      $desmu_html  = $admin ? $desmu_admin : $desmu_text;

      //dibuixa fila assistent
      echo "
        <tr assistent=$id>
          <td><small>$nom</small>
          $mail_td
          <td class=bool style=$pagat_style>$pagat_html
          <td class=bool style=$comis_style>$comis_html
          <td class=bool style=$ajuda_style>$ajuda_html
          <td class=bool style=$desmu_style>$desmu_html
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
      $euros=$pagats*25;
      //calcula nombre de pesones que formen part d'alguna comissió
      $comiss=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE comis is TRUE')));
      //calcula nombre de pesones que ajuden a muntar
      $ajuden=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE ajuda is TRUE')));
      //calcula nombre de pesones que ajuden a desmuntar
      $desmunten=current(mysqli_fetch_assoc($mysql->query('SELECT COUNT(1) FROM assistents WHERE desmuntar is TRUE')));

      echo "
        <th>$pagats ($euros eur)
        <th>$comiss
        <th>$ajuden
        <th>$desmunten
      ";
      if($admin)echo "<th>"; //columna admin final
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
  #assistents tr:hover td:first-child {
    text-decoration:underline;
  }
</style>
