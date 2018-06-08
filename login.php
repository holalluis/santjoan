<!doctype html><html><head>
<?php include'imports.php'?>
</head><body>
<?php include'navbar.php'?>

<form method=post>
  <table border=1>
    <tr>
      <th>Pass admin
      <td><input name=pass type=password required placeholder="Pass admin" autocomplete=off>
      <td><button>ok</button>
  </table>
</form>

<?php
//check post pass
if(!isset($_POST['pass'])){die();}

//input
$pass=$_POST['pass'];

//set cookie admin (==password)
setcookie("admin",$pass,time()+86400*30,'/');

echo "cookie admin set to $pass";
header('Location: index.php');

?>
