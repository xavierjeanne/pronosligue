<div id="modifier_commentaire">
<?php
if(isset($_POST['modifier_commentaire']))
	{
	$commentaire=nl2br(htmlentities($_POST['modifier_commentaire'],ENT_QUOTES,'UTF-8'));
	$commentaire=stripslashes($commentaire);
	$id_commentaire=$_POST['id_commentaire'];
	$morceau=explode(" ",$commentaire);
	foreach($morceau as $morceaux)
		{
		$premiere_lettre=$morceaux[0];
		if($premiere_lettre=='@')
			{
			$pseudo_com=substr($morceaux,1);
			$r13=$bdd->prepare("SELECT count(id_membre) AS nb_entree,id_membre FROM membre WHERE pseudo=:pseudo");
			$r13->execute(array('pseudo' => $pseudo_com));
			$d13=$r13->fetch();
			$nb_entree=$d13['nb_entree'];
			$membre=$d13['id_membre'];
			if($nb_entree!=0)
				{
				$r14=$bdd->prepare("UPDATE membre SET notification=notification+1 WHERE id_membre=:id_membre");	
				$r14->execute(array('id_membre'=>$membre));
				$r15=$bdd->prepare("INSERT INTO tableau_bord (id_membre,type,message) VALUES (:id_membre,:type,:message)");
				$message="Vous avez été identifiez dans un message, <a href=\"index.php?page=repondre_commentaire&id_commentaire=$id_commentaire\">répondre</a>";
				$r15->execute(array('id_membre' =>$membre,'type'=>1,'message'=>$message));
				}
			}
		}
	$date=date("Y-m-d H:i:s");
	$requete_bar=$bdd->prepare("UPDATE membre SET bar+=1");
			$requete_bar->execute();
	$r12=$bdd->prepare("UPDATE commentaire SET commentaire='$commentaire' WHERE id_commentaire='$id_commentaire'");
	$r12->execute();
	echo "<p>Traitement en cours</p>";
	print("<script type=\"text/javascript\">setTimeout('location=(\"index.php?page=bar\")' ,1000);</script>");	
	}

else
	{
	$id_commentaire=$_GET['id_commentaire'];
	$r11=$bdd->prepare("SELECT commentaire FROM commentaire WHERE id_commentaire='$id_commentaire'");
	$r11->execute();
	$d11=$r11->fetch();
	$commentaire=$d11['commentaire'];
	$commentaire=str_replace("<br />","",$commentaire);
	?>
	<form action="index.php?page=modifier_commentaire" method="post">
		<label>Commentaire :</label>
		<textarea name="modifier_commentaire"  rows=3 COLS=70 ><?php echo $commentaire;?></textarea>
		<input type="hidden" name="id_commentaire" value="<?php echo $id_commentaire;?>"/>
		<input type="submit" value="Envoyer"/>
		<div class="alert alert-warning" style="margin:20px;">Pour "tagger" un autre joueur dans ton message, commence par @ puis son pseudo (par ex: @xavier,@salou ...). Il recevra une notification.</div>
	</form>
	<?php
	}
echo"</div>";
?>