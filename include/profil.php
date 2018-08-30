<?php
if(empty($id_membre))
{?>
  	<div class="alert alert-danger">
     <span class="glyphicon glyphicon-alert"></span> <strong>Connecte toi pour accédér à cette partie <a href="index.php?page=connexion&chemin=profil">ici</a></strong>
		</div>
<?php
}
else
{
	?>
	<div class="row"  class="col-xs-12 col-sm-12 col-md-12">
	<div class="col-xs-12 col-sm-4 col-md-4">
	<legend>Avatar</legend>
	<?php $requete=$bdd->prepare("SELECT * FROM membre WHERE id_membre='$id_membre'");
		$requete->execute();
		$donnees=$requete->fetch();
	?>
	<p><?php echo Maillot($donnees['avatar']);?></p>
	<p><a href="index.php?page=modifier_avatar">Modifier son avatar</a></p>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4">
	<legend>Podium</legend>
	<p>1: <?php echo Fanion($donnees['podium_1']);?> <?php echo Nom_club($donnees['podium_1']);?></p>
	<p>2: <?php echo Fanion($donnees['podium_2']);?> <?php echo Nom_club($donnees['podium_2']);?></p>
	<p>3: <?php echo Fanion($donnees['podium_3']);?> <?php echo Nom_club($donnees['podium_3']);?></p>
	<?php 
	$date_limite="2018-09-01";
	Arebour($date_limite);
	$date_limite=strtotime($date_limite);
	$now=time();
	if($date_limite>=$now){echo "<div class=\"row\"><div class=\"col-md-offset-3 col-md-6 col-md-offset-3\"><a href=\"index.php?page=modifier_bonus\" class=\"btn btn-primary center-block\">Modifier le podium</a></div></div>";}
	?>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4">
	<legend>Relégable</legend>
	<p>18: <?php echo Fanion($donnees['relegable_1']);?> <?php echo Nom_club($donnees['relegable_1']);?></p>
	<p>19: <?php echo Fanion($donnees['relegable_2']);?> <?php echo Nom_club($donnees['relegable_2']);?></p>
	<p>20: <?php echo Fanion($donnees['relegable_3']);?> <?php echo Nom_club($donnees['relegable_3']);?></p>
	<?php 
	$date_limite="2018-09-01";
	Arebour($date_limite);
	$date_limite=strtotime($date_limite);
	$now=time();
	if($date_limite>=$now){echo "<div class=\"row\"><div class=\"col-md-offset-3 col-md-6 col-md-offset-3\"><a href=\"index.php?page=modifier_bonus\" class=\"btn btn-primary center-block\">Modifier les relégables</a></div></div>";}
	?>
	</div>
</div>
<div class="row"  class="col-xs-12 col-sm-12 col-md-12">
	<div class="table-responsive">
			<?php 
		$requete=$bdd->prepare("SELECT * FROM membre WHERE id_membre='$id_membre' ");
		$requete->execute();
		$i=1;
		?>
		<table class="table table-striped" style="font-weight:normal;">
				<thead>
				<tr>
				<th style="text-align:center;">Points par journée</th>
				<?php for($j=1;$j<20;$j++)
				{
					echo "<th style=\"text-align:center;\">J$j</th>";
				}
				?>
				</tr>
				</thead>
				<tbody>
		<?php
		while($donnees=$requete->fetch())
			{
			$membre_class=$donnees['id_membre'];
			?>	
				<tr <?php if($i<6){echo "class=\"success\"";}?>>
				<td><?php echo $i;?><?php echo Maillot($donnees['avatar']);?> <?php echo $donnees['pseudo'];?></td>
				
				<?php for($k=1;$k<20;$k++)
				{
					$requetebis=$bdd->prepare("SELECT * FROM point_journee WHERE id_membre='$membre_class' AND id_journee='$k'");
					$requetebis->execute();
					$donneesbis=$requetebis->fetch();
					$point_journee=$donneesbis['point_journee'];
					?><td style="text-align:center;"><span <?php if($point_journee>6){echo "style=\"color:red\"";}?>><?php echo $point_journee;?></span></td>
					<?php
				}
				?>
				</tr>
			<?php
			$i++;
			}
		?>
				</tbody>
			</table>
		</div>	
</div>
<?php
}
?>