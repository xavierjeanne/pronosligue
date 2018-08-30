<?php 
ini_set("session.cookie_domain", ".pronosligue.fr");
session_start();

if(isset($_COOKIE['id_membre']) AND isset($_COOKIE['pseudo']) AND !empty($_COOKIE['id_membre']) AND !empty($_COOKIE['pseudo']))
{
	$_SESSION['id_membre']=$_COOKIE['id_membre'];
	$_SESSION['pseudo']=$_COOKIE['pseudo'];
}

require_once("global/connexion.msi.php");
include("include/fonction.php");
if(isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])AND !empty($_SESSION['id_membre']) AND !empty($_SESSION['pseudo']))
{
	$pseudo=$_SESSION['pseudo'];
	$id_membre=$_SESSION['id_membre'];
}
else
{
	$pseudo="";
	$id_membre="";
}
$requete_etape=$bdd->prepare("SELECT etape,notification,bar FROM membre WHERE id_membre='$id_membre'");
$requete_etape->execute();
$donnees_etape=$requete_etape->fetch();
$etape=$donnees_etape['etape'];
$notification=$donnees_etape['notification'];
$bar=$donnees_etape['bar'];
include("include/header.php");
echo "<div class=\"container-fluid\" style=\"background-color:#FEFEFE;border:0px;\">";
//On inclut le contrôleur s'il existe et s'il est spécifié
if(!empty($id_membre) AND ($etape==4))
{
	if (!empty($_GET['page']) && is_file('include/'.$_GET['page'].'.php'))
		{
		include 'include/'.$_GET['page'].'.php';
		}
	else
		{
		include 'include/accueil.php';
		} 
}
elseif(!empty($id_membre) AND (($etape==0) OR ($etape==2) OR($etape==3)))
{
	include 'include/etape.php';
}
else
{
	if (!empty($_GET['page']) && is_file('include/'.$_GET['page'].'.php'))
		{
		include 'include/'.$_GET['page'].'.php';
		}
	else
		{
		include 'include/accueil.php';
		} 
}
	
echo"</div>";
include("include/footer.php");
?>