<meta charset=utf8>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css.css">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<title>Sant Joan Boreal</title>

<?php include'admin.php'?>

<?php
  /**connexió base de dades**/
  if(in_array($_SERVER['SERVER_NAME'],array('localhost'),true)){
    $mysql=mysqli_connect("127.0.0.1","root","","santjoan")         or die(mysqli_error($mysql));
  }else{
    $mysql=mysqli_connect("127.0.0.1","root","Bol729sh","santjoan") or die(mysqli_error($mysql));
  }
?>

