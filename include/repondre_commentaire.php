<div id="repondre_commentaire">
<?php
if(isset($_POST['commentaire']))
	{
	$commentaire=nl2br(htmlentities($_POST['commentaire'],ENT_QUOTES,'UTF-8'));
	$commentaire=stripslashes($commentaire);
	$id_reponse=$_POST['id_reponse'];
	$membre_com=$_POST['membre_com'];
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
				$message="Vous avez été identifiez dans un message, <a href=\"index.php?page=repondre_commentaire&id_commentaire=$id_reponse\">répondre</a>";
				$r15->execute(array('id_membre' =>$membre,'type'=>1,'message'=>$message));
				}
			}
		}
	$date_com=date("Y-m-d H:i:s");
	$requete_bar=$bdd->prepare("UPDATE membre SET bar=bar+1");
			$requete_bar->execute();
	$r8=$bdd->prepare("INSERT INTO commentaire (date_com,id_membre,commentaire,id_reponse)VALUES(:date_com,:id_membre,:commentaire,:id_reponse)");
	$r8->execute(array('date_com'=>$date_com,'id_membre'=>$id_membre,'commentaire'=>$commentaire,'id_reponse'=>$id_reponse));
	$r9=$bdd->prepare("UPDATE membre SET notification=notification+1 WHERE id_membre=:id_membre");	
	$r9->execute(array('id_membre'=>$membre_com));
	$r10=$bdd->prepare("INSERT INTO tableau_bord (id_membre,type,message) VALUES (:id_membre,:type,:message)");
	$message="Quelqu'un à répondu à votre message <a href=\"index.php?page=repondre_commentaire&id_commentaire=$id_reponse\">voir</a>";
	$r10->execute(array('id_membre' =>$membre_com,'type'=>2,'message'=>$message));
				
	echo "<p>Traitement en cours</p>";
	print("<script type=\"text/javascript\">setTimeout('location=(\"index.php?page=bar\")' ,1000);</script>");	
	}
else
	{
	$id_commentaire=htmlspecialchars($_GET['id_commentaire']);
	$r9=$bdd->prepare("SELECT * FROM commentaire INNER JOIN membre ON commentaire.id_membre = membre.id_membre WHERE id_commentaire='$id_commentaire'");
	$r9->execute();
	if($d9=$r9->fetch())
	{
	echo"<div class=\"panel panel-primary\">";
	echo"<div class=\"panel-body\">";
	$avatar=$d9['avatar'];
	$membre_com=$d9['id_membre'];
	$pseudo=$d9['pseudo'];
	$id_commentaire=$d9['id_commentaire'];
	$id_reponse=$d9['id_reponse'];
	$commentaire=$d9['commentaire'];
	$date=$d9['date_com'];
	if($id_reponse!=0)
	{
		$id_commentaire=$id_reponse;
		$r9bis=$bdd->prepare("SELECT * FROM commentaire INNER JOIN membre ON commentaire.id_membre = membre.id_membre WHERE id_commentaire='$id_commentaire'");
		$r9bis->execute();
		$d9bis=$r9bis->fetch();
		$avatar=$d9bis['avatar'];
		$pseudo=$d9bis['pseudo'];
		$commentaire=$d9bis['commentaire'];
		$date=$d9bis['date_com'];
	}
	?>
	<div class="alert alert-success"><?php echo Maillot($avatar);?> <?php echo $pseudo;?> <?php Format_date($date);?></div>
		<?php if(strstr($commentaire, 'https://www.youtube')OR (strstr($commentaire,'https://www.dailymotion')))
				{
				$commentaire=substr($commentaire,6);
				?>
				<div class="embed-responsive embed-responsive-16by9"><iframe width="560" height="315" src="<?php echo $commentaire;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
				<?php
				}
				else
				{?>
				<div class="panel-content"><?php echo $commentaire;?></div>
				<?php
				}?>
	</div>
	</div>
	<?php 
	$r10=$bdd->prepare("SELECT * FROM commentaire INNER JOIN membre ON commentaire.id_membre = membre.id_membre WHERE id_reponse='$id_commentaire' ORDER BY id_commentaire ASC");
	$r10->execute();
	while($d10=$r10->fetch())
		{
		echo"<div class=\"ecart\">";
		echo"</div>";
		echo"<div class=\"panel panel-primary\">";
		echo"<div class=\"panel-body\">";
		$membre=$d10['id_membre'];
		$pseudo=$d10['pseudo'];
		$avatar=$d10['avatar'];
		$commentaire=$d10['commentaire'];
		$date=$d10['date_com'];
		?>
		<div class="alert alert-success"><?php echo Maillot($avatar);?> <?php echo $pseudo;?> <?php Format_date($date);?></div>
			<?php if(strstr($commentaire, 'https://www.youtube')OR (strstr($commentaire,'https://www.dailymotion')))
				{
				$commentaire=substr($commentaire,6);
				?>
				<div class="embed-responsive embed-responsive-16by9"><iframe width="560" height="315" src="<?php echo $commentaire;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
				<?php
				}
				else
				{?>
				<div class="panel-content"><?php echo $commentaire;?></div>
				<?php
				}?>
		</div>
		</div>
		<?php 
		}
		
	?>
	<form action="index.php?page=repondre_commentaire" method="post">
		<label>Commentaire :</label>
		<textarea name="commentaire"rows=3 COLS=70 ></textarea>
		<input type="hidden" name="id_reponse" value="<?php echo $id_commentaire;?>"/>
		<input type="hidden" name="membre_com" value="<?php echo $membre_com;?>"/>
		<input type="submit" value="Envoyer"/>
		<div class="alert alert-warning" style="margin:20px;">Pour "tagger" un autre joueur dans ton message, commence par @ puis son pseudo (par ex: @xavier,@salou ...). Il recevra une notification.</div>
	</form>
	<?php
	}
	else
	{?>
		<div class="alert alert-danger">
     <span class="glyphicon glyphicon-alert"></span> <strong>Le commentaire à été effacé ;-(</strong>
		</div>
	<?php
	}
}
echo"</div>";
?>