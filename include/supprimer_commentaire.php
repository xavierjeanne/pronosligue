<div id="acceuil">
<?php
	$id_commentaire=$_GET['id_commentaire'];
	$requete_bar=$bdd->prepare("UPDATE membre SET bar+=1");
	$requete_bar->execute();
	$r12=$bdd->prepare("DELETE FROM commentaire WHERE id_commentaire='$id_commentaire'");
	$r12->execute();
	echo "<p>Traitement en cours</p>";
	print("<script type=\"text/javascript\">setTimeout('location=(\"index.php?page=bar\")' ,1000);</script>");	
?>
</div>