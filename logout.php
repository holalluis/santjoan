<?php
//esborra cookie
setcookie("admin",'',time()+86400*30,'/');
//torna
header('Location: index.php');
?>
