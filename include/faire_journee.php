<?php
if(isset($_POST['valider_journee']))
	{
	$jour=$_POST['jour'];
	$mois=$_POST['mois'];
	if($mois<10)
		{
		$mois="0".$mois;
		}
	else
		{
		$mois=$mois;
		}
	$heure=$_POST['heure'];
	$date_limite="2018-".$mois."-".$jour." ".$heure."";
	$requete=$bdd->prepare("SELECT * FROM journee ORDER BY id_match DESC LIMIT 1");
	$requete->execute();
	$donnees=$requete->fetch();
	$id_match=$donnees['id_match'];
	$journee=$donnees['journee'];
	$id_match+=1;
	$journee+=1;
	for($m=1;$m<11;$m++)
		{
		$domicile=$_POST['domicile'.$m];
		$exterieur=$_POST['exterieur'.$m];
		$requete=$bdd->prepare("INSERT INTO journee VALUES ('','$journee','$id_match','$domicile','$exterieur','$date_limite','')");
		$requete->execute();
		$id_match+=1;
		}
	print("<script type=\"text/javascript\">setTimeout('location=(\"index.php\")' ,1000);</script>");
	}
else
	{

	?>
	<form method="POST" action="">
	<label>Jour</label>
	<select name="jour">
	<?php 
	for($i=1;$i<32;$i++)
		{
		?>
		<option value="<?php echo $i;?>"><?php echo $i;?></option>
		<?php
		}
	?>
	</select>
	<label>Mois</label>
	<select name="mois">
	<option value="1">JANVIER</option>
	<option value="2">FEVRIER</option>
	<option value="3">MARS</option>
	<option value="4">AVRIL</option>
	<option value="5">MAI</option>
	<option value="6">JUIN</option>
	<option value="7">JUILLET</option>
	<option value="8">AOUT</option>
	<option value="9">SEPTEMBRE</option>
	<option value="10">OCTOBRE</option>
	<option value="11">NOVEMBRE</option>
	<option value="12">DECEMBRE</option>
	</select>
	
	<label>Heure</label>
		<select name="heure">
			<option value="17-00-00">17h</option>
			<option value="18-00-00">18h</option>
			<option value="19-00-00">19h</option>
			<option value="20-00-00">20h</option>
		</select>
		<br/>
	<?php
		for($j=1;$j<11;$j++)
	{
		?>
		<label>Match<?php echo $j;?></label>
		<p><select name="domicile<?php echo $j;?>">
		<?php
		$requete=$bdd->prepare("SELECT nom_club,id_club FROM club ORDER BY nom_club ASC");
		$requete->execute();
		while($donnees=$requete->fetch())
			{
			?>
			<option value="<?php echo $donnees['id_club'];?>"><?php echo $donnees['nom_club'];?></option>
			<?php
			}
		?>
		</select>
		<select name="exterieur<?php echo $j;?>">
		<?php
		$requetebis=$bdd->prepare("SELECT nom_club,id_club FROM club ORDER BY nom_club ASC");
		$requetebis->execute();
		while($donneesbis=$requetebis->fetch())
			{
			?>
			<option value="<?php echo $donneesbis['id_club'];?>"><?php echo $donneesbis['nom_club'];?></option>
			<?php
			}
		?>
		</select></p>
	<?php
	}?>
	<input type="submit" name="valider_journee" value="valider"/>
	</form>
	<?php
	}
?>