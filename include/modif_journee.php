<?php
if(isset($_POST['valider_journee']))
{
  $jour=$_POST['jour'];
	$mois=$_POST['mois'];
  $heure=$_POST['heure'];
  $journee=$_POST['journee'];
	if($mois<10)
		{
		$mois="0".$mois;
		}
	else
		{
		$mois=$mois;
		}
  $date_limite="2018-".$mois."-".$jour." ".$heure."";
  $requete=$bdd->prepare("UPDATE journee SET date_limite='$date_limite' WHERE journee='$journee'");
  $requete->execute();
  print("<script type=\"text/javascript\">setTimeout('location=(\"index.php\")' ,1000);</script>");
}
else
{
  ?>
<form method="POST" action="">
  <label>Journee</label>
  <select name="journee">
  <?php $requete=$bdd->prepare("SELECT DISTINCT journee FROM journee WHERE score=0 ORDER BY journee ASC");
  $requete->execute();
  while($donnees=$requete->fetch())
  {
  ?>
    <option value="<?php echo $donnees['journee'];?>"><?php echo $donnees['journee'];?></option> 
  <?php
  }
    ?>
  </select>
<br/>
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
			<option value="18-00-00">18h</option>
			<option value="19-00-00">19h</option>
			<option value="20-00-00">20h</option>
		</select>
		<br/>
  <input type="submit" name="valider_journee" value="valider"/>
	</form>
  <?php
}
?>