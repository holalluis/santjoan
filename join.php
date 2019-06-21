<!doctype html><html><head>
<?php include'imports.php'?>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head><body>
<?php include'navbar.php'?>
<h3>Nou assistent</h3>
<div>
  <p>
    Després d'apuntar-te ingressa
    <b>25€</b> a <b>ES87 2100 2904 0302 0213 1256</b>.
  </p>
  <p>
    <div><b>Molt important</b>: posa el <b>nom i COGNOMS</b> al concepte, així podrem verificar qui ha pagat.</div>
  </p>
</div>

<!--formulari-->
<form method=post>
  <table border=1>
    <tr><th>Nom <td><input name=name placeholder="Nom i cognoms" required max=50>
    <tr><th>Mail<td><input name=mail placeholder="Mail" required max=50>
    <tr><td colspan=2><div class="g-recaptcha" data-sitekey="6LcZE14UAAAAALFxofexh23_ZeKlierv9CMM0IaD"></div>
    <tr><th> Opcions<td>
      <ul style=padding:0;list-style-type:none>
        <li><input type=checkbox name=comis> Formo part d'una comissió d'organització
        <li><input type=checkbox name=ajuda> Vull ajudar a muntar
        <li><input type=checkbox name=desmu> Vull ajudar a desmuntar
      </ul>
    <tr><th><td><button>Apunta'm!</button>
  </table>
</form><hr>

<!--processa nou assistent-->
<p>
<?php
  if(count($_POST)==0){ die(); }

  //inputs
  $name=$mysql->escape_string($_POST['name']);
  $mail=$mysql->escape_string($_POST['mail']);
  $comis=isset($_POST['comis']);
  $ajuda=isset($_POST['ajuda']);
  $desmu=isset($_POST['desmu']);

  $response = $_POST["g-recaptcha-response"];

  //verify captcha
  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = array(
    'secret' => '6LcZE14UAAAAAHqgXsoDhm_LFEYGhEBiGBsizEQa',
    'response' => $_POST["g-recaptcha-response"]
  );
  $options = array(
    'http' => array (
      'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
      'method' => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context = stream_context_create($options);
  $verify = file_get_contents($url, false, $context);
  $captcha_success=json_decode($verify)->success; //boolean

  //comprova pass
  if($captcha_success==false){
    ?>
    <div style=padding:1em;background:red;color:black>Error! Captcha no verificat! Ets un robot!<div>
    <?php
    die();
  }

  //insert query
  $sql="INSERT INTO assistents (nom,mail,comis,ajuda,desmuntar) VALUES ('$name','$mail',$comis,$ajuda,$desmu)";
  $mysql->query($sql) or die(mysqli_error($mysql));

  //resultat query
  ?>
  <div style=padding:1em;background:#af0>Nou assistent apuntat correctament! <a href="index.php">Pàgina principal</a></div>
  <?php
?>
</p>
