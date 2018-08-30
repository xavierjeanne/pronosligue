<?php 
if(isset($_POST['valider']))
	{
	$journee=$_POST['journee'];
	$choix1=$_POST['choix1'];
	$choix2=$_POST['choix2'];
	$choix3=$_POST['choix3'];
	$choix4=$_POST['choix4'];
	$choix5=$_POST['choix5'];
	$choix6=$_POST['choix6'];
	$choix7=$_POST['choix7'];
	$choix8=$_POST['choix8'];
	$choix9=$_POST['choix9'];
	$choix10=$_POST['choix10'];
	$id_match1=$_POST['id_match1'];
	$id_match2=$_POST['id_match2'];
	$id_match3=$_POST['id_match3'];
	$id_match4=$_POST['id_match4'];
	$id_match5=$_POST['id_match5'];
	$id_match6=$_POST['id_match6'];
	$id_match7=$_POST['id_match7'];
	$id_match8=$_POST['id_match8'];
	$id_match9=$_POST['id_match9'];
	$id_match10=$_POST['id_match10'];
	$requete=$bdd->prepare("SELECT * FROM pronostic WHERE id_membre='$id_membre' AND id_match='$id_match1'");
	$requete->execute();
	if($donnees=$requete->fetch())
		{
		$requetebis=$bdd->prepare("UPDATE pronostic SET	pronostic='$choix1' WHERE id_membre='$id_membre' AND id_match='$id_match1'");
		$requetebis->execute();	
		$requetebis=$bdd->prepare("UPDATE pronostic SET	pronostic='$choix2' WHERE id_membre='$id_membre' AND id_match='$id_match2'");
		$requetebis->execute();	
		$requetebis=$bdd->prepare("UPDATE pronostic SET	pronostic='$choix3' WHERE id_membre='$id_membre' AND id_match='$id_match3'");
		$requetebis->execute();	
		$requetebis=$bdd->prepare("UPDATE pronostic SET	pronostic='$choix4' WHERE id_membre='$id_membre' AND id_match='$id_match4'");
		$requetebis->execute();	
		$requetebis=$bdd->prepare("UPDATE pronostic SET	pronostic='$choix5' WHERE id_membre='$id_membre' AND id_match='$id_match5'");
		$requetebis->execute();	
		$requetebis=$bdd->prepare("UPDATE pronostic SET	pronostic='$choix6' WHERE id_membre='$id_membre' AND id_match='$id_match6'");
		$requetebis->execute();	
		$requetebis=$bdd->prepare("UPDATE pronostic SET	pronostic='$choix7' WHERE id_membre='$id_membre' AND id_match='$id_match7'");
		$requetebis->execute();	
		$requetebis=$bdd->prepare("UPDATE pronostic SET	pronostic='$choix8' WHERE id_membre='$id_membre' AND id_match='$id_match8'");
		$requetebis->execute();	
		$requetebis=$bdd->prepare("UPDATE pronostic SET	pronostic='$choix9' WHERE id_membre='$id_membre' AND id_match='$id_match9'");
		$requetebis->execute();	
		$requetebis=$bdd->prepare("UPDATE pronostic SET	pronostic='$choix10' WHERE id_membre='$id_membre' AND id_match='$id_match10'");
		$requetebis->execute();	
		echo "<p>Traitement en cours</p>";
		print("<script type=\"text/javascript\">setTimeout('location=(\"index.php?page=accueil\")' ,1000);</script>");
		}
	else
		{
		$requetebis=$bdd->prepare("INSERT INTO pronostic VALUES('','$id_match1','$id_membre','$choix1'),('','$id_match2','$id_membre','$choix2'),('','$id_match3','$id_membre','$choix3'),('','$id_match4','$id_membre','$choix4'),('','$id_match5','$id_membre','$choix5'),('','$id_match6','$id_membre','$choix6'),('','$id_match7','$id_membre','$choix7'),('','$id_match8','$id_membre','$choix8'),('','$id_match9','$id_membre','$choix9'),('','$id_match10','$id_membre','$choix10')");
		$requetebis->execute();
		$requeteter=$bdd->prepare("INSERT INTO point_journee VALUES('','$id_membre','$journee','0')");
		$requeteter->execute();
		echo "<p>Traitement en cours</p>";
		print("<script type=\"text/javascript\">setTimeout('location=(\"index.php?page=accueil\")' ,1000);</script>");
		}
	}
else
	{
	if(empty($id_membre))
	{?>
  	<div class="alert alert-danger">
     <span class="glyphicon glyphicon-alert"></span> <strong>Connecte toi pour accédér à cette partie <a href="index.php?page=connexion&chemin=pronostic">ici</a></strong>
		</div>
	<?php
	}
	else
	{
	$journee=$_GET['journee'];
	$requete_journee=$bdd->prepare("SELECT date_limite FROM journee WHERE journee='$journee'");
	$requete_journee->execute();
	$donnees_journee=$requete_journee->fetch();
	$date_limite=$donnees_journee['date_limite'];
	$date_limite=strtotime($date_limite);
	$now=time();
	if($date_limite<=$now)
	{
		$requete_journee=$bdd->prepare("SELECT journee,date_limite FROM journee WHERE score=0 ORDER BY id_match ASC LIMIT 1");
		$requete_journee->execute();
		$donnees_journee=$requete_journee->fetch();
		$journee=$donnees_journee['journee'];
			$date_limite=$donnees_journee['date_limite'];
		$date_limite=strtotime($date_limite);
	}
	?>
	<?php if(isset($_GET['erreur'])){$erreur=$_GET['erreur'];echo"<div class=\"alert alert-danger\">$erreur</div>";}?>
	<div class="panel panel-primary">
    <div class="panel-heading" style="text-align:center;">Journee n° <?php echo $journee;?></div>
	</div>
	<div class="col-xs-12 col-sm-12 " style="background-color:white;" >
	<?php
	echo"<table class=\"table table-striped\">";
	?>
	<form action="" method="post">
	<?php $requete=$bdd->prepare("SELECT * FROM journee WHERE journee='$journee' ORDER BY id_match ASC");
	$requete->execute();
	$i=1;
	while($donnees=$requete->fetch())
		{
		$domicile=$donnees['club_domicile'];
		$exterieur=$donnees['club_exterieur'];
		$id_match=$donnees['id_match'];
	
		$requetebis=$bdd->prepare("SELECT pronostic FROM pronostic WHERE id_membre='$id_membre' AND id_match='$id_match'");
		$requetebis->execute();
		if($donneesbis=$requetebis->fetch())
			{
			$pronos=$donneesbis['pronostic'];
			}
		?>
		<tr><td><?php echo Nom_club($domicile);?><?php echo Fanion($domicile);?><span class="hidden-xs">(<?php echo Classement($domicile);?>)</span></td><td></td><td style="text-align:right;"><?php echo Nom_club($exterieur);?><?php echo Fanion($exterieur);?><span class="hidden-xs">(<?php echo Classement($exterieur);?>)</span></td></tr>
		<tr class="hidden-xs"><td><?php echo Seriedomicile($domicile,1);?><?php echo Seriedomicile($domicile,2);?><?php echo Seriedomicile($domicile,3);?><?php echo Seriedomicile($domicile,4);?><?php echo Seriedomicile($domicile,5);?></td><td></td><td style="text-align:right;"><span class="hidden-xs"><?php echo Serieexterieur($exterieur,1);?><?php echo Serieexterieur($exterieur,2);?><?php echo Serieexterieur($exterieur,3);?><?php echo Serieexterieur($exterieur,4);?><?php echo Serieexterieur($exterieur,5);?></span></td></tr>
		<tr><td></td><td><input type="radio" name="choix<?php echo $i;?>" value="1" <?php if((isset($pronos))&& ($pronos==1)){echo 'checked="checked"';}?>/> 1 <input type="radio" name="choix<?php echo $i;?>" value="2" <?php if ((isset($pronos))&& ($pronos==2))  {echo 'checked="checked"';}?><?php if(!isset($pronos)){echo 'checked="checked"';}?>/> N <input type="radio" name="choix<?php echo $i;?>" value="3" <?php if ((isset($pronos))&& ($pronos==3))  {echo 'checked="checked"';}?>/> 2</td><td></td></tr>
		<p><input type="hidden" name="id_match<?php echo $i;?>" value="<?php echo $id_match;?>"/></p>
		<?php $i++;
		}
	echo"</table>";
	echo"<input type=\"hidden\" name=\"journee\" value=\"".$journee."\"/>";
	if($date_limite>$now)
	{
		echo"<p><input type=\"submit\" value=\"valider\" name=\"valider\" class=\"btn btn-primary center-block\"/></p>";
	}	
	echo"</form>";
	}
	echo"</div>";
}
?>