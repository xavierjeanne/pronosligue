<?php
echo "<div class=\"container\">";
	if(isset($_POST['valider_groupe']))
		{
		$podium_1=$_POST['podium_1'];
		$podium_2=$_POST['podium_2'];
		$podium_3=$_POST['podium_3'];
		$relegable_1=$_POST['relegable_1'];
		$relegable_2=$_POST['relegable_2'];
		$relegable_3=$_POST['relegable_3'];
		$_SESSION['podium_1']=$podium_1;
		$_SESSION['podium_2']=$podium_2;
		$_SESSION['podium_3']=$podium_3;
		$_SESSION['relegable_1']=$relegable_1;
		$_SESSION['relegable_2']=$relegable_2;
		$_SESSION['relegable_3']=$relegable_3;
		if((($podium_1===$podium_2) OR ($podium_1===$podium_3) OR ($podium_2===$podium_3)) OR (($relegable_1===$relegable_2) OR ($relegable_1===$relegable_3) OR ($relegable_2===$relegable_3)))
			{
			$erreur="Vous avez choisit deux fois la même équipe à des places différentes !!";
			print("<script type=\"text/javascript\">setTimeout('location=(\"index.php?&erreur=$erreur\")' ,1000);</script>");	
			}
		else
			{
			$requete=$bdd->prepare("UPDATE membre SET podium_1='$podium_1',podium_2='$podium_2',podium_3='$podium_3',relegable_1='$relegable_1',relegable_2='$relegable_2',relegable_3='$relegable_3' WHERE pseudo='$pseudo'");
			$requete->execute();
			print("<script type=\"text/javascript\">setTimeout('location=(\"index.php\")' ,1000);</script>");	
			}
		}
	else
		{
		?>
		<fieldset>
		<legend>Modifier le classement </legend>
		<h3>Bonus podium et relégable</h3>
		<p>Choisir dans le bon ordre les équipes sur le podium à la fin des matchs aller.1 point pour une équipe bien placée, 3 pour 2 et 5 pour les trois équipes dans le bon ordre.idem pour les relégables.</p>
		<?php if(isset($_GET['erreur'])){$erreur=$_GET['erreur'];echo"<div class=\"alert alert-danger\">$erreur</div>";}?>
			<form action="" method="post">
			<?php
			$requete=$bdd->prepare("SELECT * FROM club ORDER BY nom_club ASC");
			$requete->execute();
			echo "<legend>Premier : </legend>";
			echo"<div class=\"col-xs-12 col-md-12\">";
			?><select name="podium_1"><?php
				while($donnees=$requete->fetch())
					{
					$nom_club=$donnees['nom_club'];
					$id_club=$donnees['id_club'];
					$classement=$donnees['classement'];
					?>
						<option value="<?php echo $id_club;?>" <?php if ( isset ($_SESSION['podium_1']) && $id_club == $_SESSION['podium_1'] ) {echo ' selected';}?>><?php echo $nom_club.' , classement :'.$classement;?></option>
					<?php
					}
				echo"</select>";
				echo"</div>";
			$requete1=$bdd->prepare("SELECT * FROM club ORDER BY nom_club ASC");
			$requete1->execute();
			echo "<legend>Deuxiéme : </legend>";
			echo"<div class=\"col-xs-12 col-md-12\">";
			?><select name="podium_2"><?php
				while($donnees1=$requete1->fetch())
					{
					$nom_club=$donnees1['nom_club'];
					$id_club=$donnees1['id_club'];
					$classement=$donnees1['classement'];
					?>
						<option value="<?php echo $id_club;?>" <?php if ( isset ($_SESSION['podium_2']) && $id_club == $_SESSION['podium_2'] ) {echo ' selected';}?>><?php echo $nom_club.' , classement :'.$classement;?></option>
					<?php
					}
				echo"</select>";
				echo"</div>";		
				$requete2=$bdd->prepare("SELECT * FROM club ORDER BY nom_club ASC");
			$requete2->execute();
			echo "<legend>Troisième : </legend>";
			echo"<div class=\"col-xs-12 col-md-12\">";
			?><select name="podium_3"><?php
				while($donnees2=$requete2->fetch())
					{
					$nom_club=$donnees2['nom_club'];
					$id_club=$donnees2['id_club'];
					$classement=$donnees2['classement'];
					?>
						<option value="<?php echo $id_club;?>" <?php if ( isset ($_SESSION['podium_3']) && $id_club == $_SESSION['podium_3'] ) {echo ' selected';}?>><?php echo $nom_club. ' ,classement :'.$classement;?></option>
					<?php
					}
				echo"</select>";
				echo"</div>";
				$requete3=$bdd->prepare("SELECT * FROM club ORDER BY nom_club ASC");
			$requete3->execute();
			echo "<legend>Dix huitième: </legend>";
			echo"<div class=\"col-xs-12 col-md-12\">";
			?><select name="relegable_1"><?php
				while($donnees3=$requete3->fetch())
					{
					$nom_club=$donnees3['nom_club'];
					$id_club=$donnees3['id_club'];
					$classement=$donnees3['classement'];
					?>
						<option value="<?php echo $id_club;?>" <?php if ( isset ($_SESSION['relegable_1']) && $id_club == $_SESSION['relegable_1'] ) {echo ' selected';}?>><?php echo $nom_club.' ,classement :'.$classement;?></option>
					<?php
					}
				echo"</select>";
				echo"</div>";
				$requete4=$bdd->prepare("SELECT * FROM club ORDER BY nom_club ASC");
			$requete4->execute();
			echo "<legend>Dix neuvième : </legend>";
			echo"<div class=\"col-xs-12 col-md-12\">";
			?><select name="relegable_2"><?php
				while($donnees4=$requete4->fetch())
					{
					$nom_club=$donnees4['nom_club'];
					$id_club=$donnees4['id_club'];
					$classement=$donnees4['classement'];
					?>
						<option value="<?php echo $id_club;?>" <?php if ( isset ($_SESSION['relegable_2']) && $id_club == $_SESSION['relegable_2'] ) {echo ' selected';}?>><?php echo $nom_club.' ,classement :'.$classement;?></option>
					<?php
					}
		echo"</select>";
				echo"</div>";
				$requete5=$bdd->prepare("SELECT * FROM club ORDER BY nom_club ASC");
			$requete5->execute();
			echo "<legend>Vingtième : </legend>";
			echo"<div class=\"col-xs-12 col-md-12\">";
			?><select name="relegable_3"><?php
				while($donnees5=$requete5->fetch())
					{
					$nom_club=$donnees5['nom_club'];
					$id_club=$donnees5['id_club'];
					$classement=$donnees5['classement'];
					?>
						<option value="<?php echo $id_club;?>" <?php if ( isset ($_SESSION['relegable_3']) && $id_club == $_SESSION['relegable_3'] ) {echo ' selected';}?>><?php echo $nom_club.' ,classement :'.$classement;?></option>
					<?php
					}
				echo"</select>";
				echo"</div>";
			?>
			<input type="submit" name="valider_groupe" value="valider" class="btn btn-primary btn-lg col-xs-offset-3 col-md-offset-3col-xs-6 col-md-6" style="margin-top:20px;"/>
			</form>
		</fieldset>
		<?php
		}
	echo"</div>";