<?php
if(empty($id_membre))
	{?>
  	<div class="alert alert-danger">
     <span class="glyphicon glyphicon-alert"></span> <strong>Connecte toi pour accédér à cette partie <a href="index.php?page=connexion&chemin=bar">ici</a></strong>
		</div>
	<?php
	}
	else
	{

?>
<div id="commentaire">
<div class="row" style="margin-top:50px;" class="col-xs-12 col-md-12">
		<?php
		if(isset($_POST['commentaire']))
			{
			$commentaire=htmlentities($_POST['commentaire'],ENT_QUOTES,'UTF-8');
			$commentaire=stripslashes($commentaire);
			$date=date("Y-m-d H:i:s");
			$requete_bar=$bdd->prepare("UPDATE membre SET bar=bar+1");
			$requete_bar->execute();
			$r5=$bdd->prepare("INSERT INTO commentaire(date_com,id_membre,commentaire,id_reponse)VALUES(:date_com,:id_membre,:commentaire,:id_reponse)");
			$r5->execute(array('date_com'=>$date,'id_membre'=>$id_membre,'commentaire'=>$commentaire,'id_reponse'=>0));
			$id_commentaire = $bdd->lastInsertId();
			$morceau=explode(" ",$commentaire);
			foreach($morceau as $morceaux)
			{
			$premiere_lettre=$morceaux[0];
			if($premiere_lettre=='@')
				{
				$pseudo_com=substr($morceaux,1);
				$r16=$bdd->prepare("SELECT count(id_membre) AS nb_entree,id_membre FROM membre WHERE pseudo=:pseudo");
				$r16->execute(array('pseudo' => $pseudo_com));
				$d16=$r16->fetch();
				$nb_entree=$d16['nb_entree'];
				$membre=$d16['id_membre'];
				if($nb_entree!=0)
					{
					$r17=$bdd->prepare("UPDATE membre SET notification=notification+1 WHERE id_membre=:id_membre");	
					$r17->execute(array('id_membre'=>$membre));
					$r18=$bdd->prepare("INSERT INTO tableau_bord (id_membre,type,message) VALUES (:id_membre,:type,:message)");
					$message="Vous avez été identifiez dans un message, <a href=\"index.php?page=repondre_commentaire&id_commentaire=$id_commentaire\">voir</a>";
					$r18->execute(array('id_membre' =>$membre,'type'=>1,'message'=>$message));
					}
				}
			}
			echo "<p>Traitement en cours</p>";
			print("<script type=\"text/javascript\">setTimeout('location=(\"index.php?page=bar\")' ,1000);</script>");	
			}
		else
			{
			$requete=$bdd->prepare("UPDATE membre SET bar=0 WHERE id_membre='$id_membre'");
			$requete->execute();
				?>
				<form action="index.php?page=bar" method="post">
				<label>Commentaire :</label>
				<textarea name="commentaire"rows=3 COLS=90 ></textarea>
				<input class="btn btn-primary" type="submit" value="Envoyer" class="envoyer"/>
				<div class="alert alert-warning" style="margin:20px;">Pour "tagger" un autre joueur dans ton message, commence par @ puis son pseudo (par ex: @xavier,@salou ...). Il recevra une notification.</div>
				</form>
				</div>
	
				<?php
			}
			$nombreDeMessagesParPage = 10; 
			$retour = $bdd->prepare("SELECT COUNT(*) AS nb_messages FROM commentaire WHERE id_reponse='0'");
			$retour ->execute();
			$donnees = $retour->fetch();
			$totalDesMessages = $donnees['nb_messages'];
			$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
			echo"<div clas=\"row\" style=\"text-align:center;\">";
			echo 'Page : ';
			echo"</div>";
			echo"<div clas=\"row\" style=\"text-align:center;\">";
			echo"<ul class=\"pagination\">";
			for ($i = 1 ; $i <= $nombreDePages ; $i++)
				{
				echo '<li><a href="index.php?page=forum&index=' . $i . '">' . $i . '</a></li> ';
				}
			?>
 			</ul>
			</div>
 			<?php
 			if (isset($_GET['index']))
				{
				$page = $_GET['index']; 
				}
			else 
				{
				$page = 1;
				}
			$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
 			$r6=$bdd->prepare("SELECT * FROM commentaire INNER JOIN membre ON commentaire.id_membre = membre.id_membre WHERE commentaire.id_reponse='0' ORDER BY commentaire.id_commentaire DESC LIMIT $premierMessageAafficher, $nombreDeMessagesParPage");
			$r6->execute();
			while($d6=$r6->fetch())
				{
				echo"<div class=\"panel panel-primary\">";
				echo"<div class=\"panel-body\">";
				$avatar=$d6['avatar'];
				$pseudo=$d6['pseudo'];
				$membre=$d6['id_membre'];
				$id_commentaire=$d6['id_commentaire'];
				$commentaire=$d6['commentaire'];
				$commentaire=preg_replace('#http://[a-z0-9._/-]+#i','<a href="$0" target="_blank">$0</a>',$commentaire);
				$date=$d6['date_com'];
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
				}
				echo"<div class=\"panel-footer col-xs-offset-10 col-md-offset-10\" style=\"text-align:center;\">";
				if(isset($_SESSION['id_membre']))
					{
					?>
						<a href="index.php?page=repondre_commentaire&id_commentaire=<?php echo $id_commentaire;?>"><span class="glyphicon glyphicon-share-alt" title="repondre"></span></a>
					<?php
					}
				if($id_membre==$membre)
					{
					?><a href="index.php?page=supprimer_commentaire&id_commentaire=<?php echo $id_commentaire;?>"><span class="glyphicon glyphicon-remove" title="supprimer"></span></a>
						<a href="index.php?page=modifier_commentaire&id_commentaire=<?php echo $id_commentaire;?>"><span class="glyphicon glyphicon-pencil" title="modifier"></span></a>
					<?php
					}
				echo"</div>";
				echo"</div>";
				echo"</div>";
				$r7=$bdd->prepare("SELECT * FROM commentaire INNER JOIN membre ON commentaire.id_membre = membre.id_membre WHERE id_reponse='$id_commentaire' ORDER BY id_commentaire ASC");
				$r7->execute();
				while($d7=$r7->fetch())
					{
					echo"<div class=\"panel panel-primary col-xs-offset-1 col-md-offset-1\">";
					echo"<div class=\"panel-body\">";
					$membre=$d7['id_membre'];
					$pseudo=$d7['pseudo'];
					$avatar=$d7['avatar'];
					$id_commentaire=$d7['id_commentaire'];
					$commentaire=$d7['commentaire'];
					$commentaire=preg_replace('#http://[a-z0-9._/-]+#i','<a href="$0" target="_blank">$0</a>',$commentaire);
					$date=$d7['date_com'];
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
				}
					echo"<div class=\"panel-footer col-xs-offset-10 col-md-offset-10\" style=\"text-align:center;\">";
					if(isset($_SESSION['id_membre']))
						{
						?>
						<a href="index.php?page=repondre_commentaire&id_commentaire=<?php echo $id_commentaire;?>"><span class="glyphicon glyphicon-share-alt" title="repondre"></span></a>
						<?php
						}
					if($id_membre==$membre)
						{
						?>
						<a href="index.php?page=supprimer_commentaire&id_commentaire=<?php echo $id_commentaire;?>"><span class="glyphicon glyphicon-remove" title="supprimer"></span></a>
						<a href="index.php?page=modifier_commentaire&id_commentaire=<?php echo $id_commentaire;?>"><span class="glyphicon glyphicon-pencil" title="modifier"></span></a>
						<?php
						}
					echo"</div>";
					echo"</div>";
					echo"</div>";
					}
				}
		?>
	</div>
</div>
<?php
	}?>