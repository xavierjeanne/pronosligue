<?php if(isset($_POST['valider_avatar']))
		{
		$avatar=htmlspecialchars($_POST['avatar']);
		if(!empty($avatar))
			{
			$requete=$bdd->prepare("UPDATE membre SET avatar='$avatar'WHERE pseudo='$pseudo'");
			$requete->execute();
			print("<script type=\"text/javascript\">setTimeout('location=(\"index.php?page=profil\")' ,1000);</script>");	
			}
		else
			{
			$erreur="Merci de choisir un maillot !!";
			print("<script type=\"text/javascript\">setTimeout('location=(\"index.php?page=modifier_avatar&erreur=$erreur\")' ,1000);</script>");	
			}
		}
	else
		{
		?>
			<?php if(isset($_GET['erreur'])){$erreur=$_GET['erreur'];echo"<div class=\"alert alert-danger\">$erreur</div>";}?>
			<form action="" method="post">
			<?php
			$requete=$bdd->prepare("SELECT * FROM club ORDER BY nom_club ASC");
			$requete->execute();
			while($donnees=$requete->fetch())
				{
				?>
				<div class="col-xs-8 col-md-4" style="margin-top:20px;"><?php Maillot($donnees['id_club']);?> <?php echo $donnees['nom_club'];?>
				<input type="radio" name="avatar" value="<?php echo $donnees['id_club'];?>"/></div>
				<?php
				}
			?>
			<div class="col-xs-8 col-md-4" style="margin-top:20px;"><img src="../css/image/avatar/pronosligue.png"/>pas de club de coeur.
			<input type="radio" name="avatar" value="21"/></div>
			<input type="submit" name="valider_avatar" value="valider" class="btn btn-primary btn-lg col-xs-offset-3 col-md-offset-3 col-xs-3 col-md-6" style="margin-top:20px;"/>
			</form>
		</fieldset>
		<?php
		}
	echo"</div>";
?>