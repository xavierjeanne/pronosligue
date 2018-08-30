<?php 
$r1=$bdd->prepare("UPDATE membre SET notification=0 WHERE id_membre='$id_membre'");
$r1->execute();
$requete=$bdd->prepare("SELECT * FROM tableau_bord INNER JOIN membre ON tableau_bord.id_membre=membre.id_membre WHERE tableau_bord.id_membre='$id_membre' ORDER BY tableau_bord.id_tableau DESC");
$requete->execute();
echo "<table class=\"table\">";
while($donnees=$requete->fetch())
{
	$type=$donnees['type'];
	$message=$donnees['message'];
	?>
<tr style="margin:20px;"><td><?php echo Type_message($type);?></td><td><?php echo $message;?></td></tr>
	<?php
}
echo"</table>";
?>
