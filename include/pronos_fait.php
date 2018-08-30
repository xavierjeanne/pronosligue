<?php
$r96=$bdd->prepare("SELECT * FROM membre WHERE etape=4 ORDER BY pseudo ASC");
$r96->execute();
while($d96=$r96->fetch())
	{
	$membre=$d96['id_membre'];
	$pseudo=$d96['pseudo'];
	echo"<p>";
	echo $pseudo;
	echo " : ";
	$now=time();
	$now=date("Y-m-d",$now);
	$r97=$bdd->prepare("SELECT * FROM journee WHERE date_limite>'$now' ORDER BY date_limite ASC LIMIT 1");
	$r97->execute();
	$d97=$r97->fetch();
	$journee=$d97['journee'];
	$id_match=$d97['id_match'];
	$r98=$bdd->prepare("SELECT count(id_pronostic) AS nb_entree FROM pronostic WHERE id_membre='$membre' AND id_match='$id_match'");
	$r98->execute();
	$d98=$r98->fetch();
	$nb_entree=$d98['nb_entree'];
	if($nb_entree !=0)	
		{
		echo "ok";
		}
	else
		{
		echo "non validée";
		}
	echo"</p>";
	}
?>