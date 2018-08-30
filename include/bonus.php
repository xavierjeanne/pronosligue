<table class="table table-striped">
	<thead><tr><th>Pseudo</th><th style="text-align:center;">Podium</th><th style="text-align:center;"> Relégable</th><th style="text-align:right;">Total</th></tr></thead>
</table>
<table class="table table-striped" >
	<thead>
<tr>
<th></th>
<?php 
	
	$requete=$bdd->prepare("SELECT * FROM club WHERE classement=1");
	$requete->execute();
	$donnees=$requete->fetch();
	$id_club=$donnees['id_club'];
	$fanion=Fanion($id_club);
	echo "<th>". $fanion ."</th>";
	$podium_ligue1=$id_club;
	$requete=$bdd->prepare("SELECT * FROM club WHERE classement=2 ");
	$requete->execute();
	$donnees=$requete->fetch();
	$id_club=$donnees['id_club'];
	$fanion=Fanion($id_club);
	echo "<th>". $fanion ."</th>";
	$podium_ligue2=$id_club;
	$requete=$bdd->prepare("SELECT * FROM club WHERE classement=3 ");
	$requete->execute();
	$donnees=$requete->fetch();
	$id_club=$donnees['id_club'];
	$fanion=Fanion($id_club);
	echo "<th>". $fanion ."</th>";
	$podium_ligue3=$id_club;
?>	

<?php 
	
	$requete=$bdd->prepare("SELECT * FROM club WHERE classement=18 ");
	$requete->execute();
	$donnees=$requete->fetch();
	$id_club=$donnees['id_club'];
	$fanion=Fanion($id_club);
	echo "<th>". $fanion ."</th>";
	$relegable_ligue1=$id_club;
	$requete=$bdd->prepare("SELECT * FROM club WHERE classement=19 ");
	$requete->execute();
	$donnees=$requete->fetch();
	$id_club=$donnees['id_club'];
	$fanion=Fanion($id_club);
	echo "<th>". $fanion ."</th>";
	$relegable_ligue2=$id_club;
	$requete=$bdd->prepare("SELECT * FROM club WHERE classement=20 ");
	$requete->execute();
	$donnees=$requete->fetch();
	$id_club=$donnees['id_club'];
	$fanion=Fanion($id_club);
	echo "<th>". $fanion ."</th>";
	$relegable_ligue3=$id_club;
?>
<th></th></tr>
</thead>
<tbody>

<?php
	$requete2=$bdd->prepare("SELECT * FROM membre WHERE etape=4 ORDER BY total_bonus-point DESC");
	$requete2->execute();
	while($donnees2=$requete2->fetch())
	{
		$pseudo=$donnees2['pseudo'];
		$id_membre=$donnees2['id_membre'];
		$podium_1=$donnees2['podium_1'];
		$podium_2=$donnees2['podium_2'];
		$podium_3=$donnees2['podium_3'];
		if($podium_1==$podium_ligue1)
		{
			$couleur_1='#AAFFAA';
		}
		else
		{
			$couleur_1='#FFAAAA';
		}
		if($podium_2==$podium_ligue2)
		{
			$couleur_2='#AAFFAA';
		}
		else
		{
			$couleur_2='#FFAAAA';
		}
		if($podium_3==$podium_ligue3)
		{
			$couleur_3='#AAFFAA';
		}
		else
		{
			$couleur_3='#FFAAAA';
		}
		$podium_1=Fanion($podium_1);
		$podium_2=Fanion($podium_2);
		$podium_3=Fanion($podium_3);
		$point_bonus=Bonus($id_membre);
		
		echo "<tr><td>$pseudo</td><td style=\"background-color:$couleur_1;\">$podium_1</td><td style=\"background-color:$couleur_2;\">$podium_2</td><td style=\"background-color:$couleur_3;\">$podium_3</td>";
		$requete3=$bdd->prepare("SELECT * FROM membre WHERE id_membre='$id_membre'");
		$requete3->execute();
		while($donnees3=$requete3->fetch())
		{
		$pseudo=$donnees3['pseudo'];
		$id_membre=$donnees3['id_membre'];
		$relegable_1=$donnees3['relegable_1'];
		$relegable_2=$donnees3['relegable_2'];
		$relegable_3=$donnees3['relegable_3'];
		if($relegable_1==$relegable_ligue1)
		{
			$couleur_4='#AAFFAA';
		}
		else
		{
			$couleur_4='#FFAAAA';
		}
			if($relegable_2==$relegable_ligue2)
		{
			$couleur_5='#AAFFAA';
		}
		else
		{
			$couleur_5='#FFAAAA';
		}
			if($relegable_3==$relegable_ligue3)
		{
			$couleur_6='#AAFFAA';
		}
		else
		{
			$couleur_6='#FFAAAA';
		}
		$relegable_1=Fanion($relegable_1);
		$relegable_2=Fanion($relegable_2);
		$relegable_3=Fanion($relegable_3);
		$point_bonus=Bonus($id_membre);
		echo "<td style=\"background-color:$couleur_4;\">$relegable_1</td><td style=\"background-color:$couleur_5;\">$relegable_2</td><td style=\"background-color:$couleur_6;\">$relegable_3</td>";
		}
		echo"<td>$point_bonus</td></tr>";
		}
?>
</tbody>
</table>