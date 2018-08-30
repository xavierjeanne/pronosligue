 
<?php
if(empty($id_membre))
	{?>
  	<div class="alert alert-danger">
     <span class="glyphicon glyphicon-alert"></span> <strong>Connecte toi pour accédér à cette partie <a href="index.php?page=connexion&chemin=pronostic">ici</a></strong>
		</div>
	<?php
	}
	else
	{
  ?>
  <nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item">
    <a class="page-link" href="index.php?page=resultat&journee=<?php echo $journee-1;?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
    <?php for($i=1;$i<20;$i++)
      {?>
       <li class="page-item"><a class="page-link" href="index.php?page=resultat&journee=<?php echo $i;?>"><?php echo $i;?></a></li>
      <?php      
      }?>
    <li class="page-item"><a class="page-link" href="index.php?page=resultat&journee=<?php echo $journee+1;?>" aria-label="Next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
  </ul>
  </nav>
    <?php
    if(isset($_GET['journee']))
    {
      $journee=$_GET['journee'];
    }
    else
    {
      $requete=$bdd->prepare("SELECT * FROM journee WHERE score!=0 ORDER BY journee DESC LIMIT 1");
      $requete->execute();
      $donnees=$requete->fetch();
      $journee=$donnees['journee'];
    }
    $requete=$bdd->prepare("SELECT * FROM journee WHERE journee='$journee' ORDER BY id_match ASC");
		$requete->execute();
    $donnees=$requete->fetch();
		$date_limite=$donnees['date_limite'];
		$date_limite=strtotime($date_limite);
    $now=time();
		if($date_limite>$now)
		{?>
			<div class="alert alert-danger">
     <span class="glyphicon glyphicon-alert"></span> <strong>Attends le début des premiers match pour voir les résultats</strong>
		</div>
		<?php
		}
		else
		{
		$requete=$bdd->prepare("SELECT * FROM journee WHERE journee='$journee'");
		$requete->execute();
		echo"<table class=\"table table-striped\">";
		echo"<tr><th></th>";
		while($donnees=$requete->fetch())
			{
			$domicile=Nom_club($donnees['club_domicile']);
			$exterieur=Nom_club($donnees['club_exterieur']);
			$drapeaudomicile=Fanion($donnees['club_domicile']);
			$drapeauexterieur=Fanion($donnees['club_exterieur']);
			$resultat=$donnees['score'];
			$id_match=$donnees['id_match'];
			if($resultat==0)
			{
				$resultat_img="<img src=\"css/image/pasdeprono.png\" class=\"img-responsive\">";
			}
			elseif($resultat==1)
			{
				$resultat_img="<img src=\"css/image/victoire.png\" class=\"img-responsive\">";
			}
			elseif($resultat==2)
			{
				$resultat_img="<img src=\"css/image/match_nul.png\" class=\"img-responsive\">";
			}
			elseif($resultat==3)
			{
				$resultat_img="<img src=\"css/image/defaite.png\" class=\"img-responsive\">";
			}
			echo"<th>".$drapeaudomicile."-".$drapeauexterieur."".$resultat_img."</th>";
			}
			echo"</tr>";
			$r4=$bdd->prepare("SELECT * FROM membre INNER JOIN point_journee ON membre.id_membre=point_journee.id_membre WHERE point_journee.id_journee='$journee' ORDER BY membre.pseudo ASC");
			$r4->execute();
			while($d4=$r4->fetch())
			{
			echo"<tr>";
			$avatar=$d4['avatar'];
			$pseudo_prono=$d4['pseudo'];
			$id_membre=$d4['id_membre'];
			echo"<td>$pseudo_prono</td>";
			$requete=$bdd->prepare("SELECT * FROM journee WHERE journee='$journee'");
			$requete->execute();
				while($donnees=$requete->fetch())
			{
			$domicile=Nom_club($donnees['club_domicile']);
			$exterieur=Nom_club($donnees['club_exterieur']);
			$drapeaudomicile=Fanion($donnees['club_domicile']);
			$drapeauexterieur=Fanion($donnees['club_exterieur']);
			$resultat=$donnees['score'];
			$id_match=$donnees['id_match'];
			if($resultat==0)
			{
				$resultat_img="<img src=\"css/image/pasdeprono.png\" class=\"img-responsive\">";
			}
			elseif($resultat==1)
			{
				$resultat_img="<img src=\"css/image/victoire.png\" class=\"img-responsive\">";
			}
			elseif($resultat==2)
			{
				$resultat_img="<img src=\"css/image/match_nul.png\" class=\"img-responsive\">";
			}
			elseif($resultat==3)
			{
				$resultat_img="<img src=\"css/image/defaite.png\" class=\"img-responsive\">";
			}
			$r5=$bdd->prepare("SELECT * FROM pronostic  WHERE id_match='$id_match' AND id_membre='$id_membre' ORDER BY id_match ASC");
			$r5->execute();
			while($d5=$r5->fetch())
			{
			$pronostic=$d5['pronostic'];
			if($pronostic==0)
			{
				$pronostic_img="<img src=\"css/image/pasdeprono.png\" class=\"img-responsive\">";
			}
			elseif($pronostic==1)
			{
				$pronostic_img="<img src=\"css/image/victoire.png\" class=\"img-responsive\">";
			}
			elseif($pronostic==2)
			{
				$pronostic_img="<img src=\"css/image/match_nul.png\" class=\"img-responsive\">";
			}
			elseif($pronostic==3)
			{
				$pronostic_img="<img src=\"css/image/defaite.png\" class=\"img-responsive\">";
			}
			if(($pronostic==$resultat)AND($resultat!=0))
			{
				$couleur='#AAFFAA';
			}
			elseif(($pronostic!=$resultat)AND ($resultat!=0))
			{
				$couleur='#FFAAAA';
			}
			elseif($resultat==0)
			{
				$couleur='white';
			}
			echo"<td style=\"background-color:$couleur;\">$pronostic_img</td>";
			}
			}
			}
			echo"</tr>";
		
			echo"</table>";
  }
	}
?>
  </div>