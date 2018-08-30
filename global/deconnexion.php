<?php 
ini_set("session.cookie_domain", ".pronosligue.fr");
 session_start();
 $_SESSION=array();
 setcookie('pseudo',null, time() - 365*24*3600,'/');
 setcookie('id_membre',null, time() - 365*24*3600,'/');
 session_destroy();
 header("Location:../index.php");
?>