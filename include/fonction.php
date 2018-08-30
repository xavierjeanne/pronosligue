<?php
function Maillot($id_club)
	{
	include("global/connexion.msi.php");
	if(($id_club==0)OR($id_club==21))
		{
		echo "<img src=\"../css/image/avatar/pronosligue.png\"/>";
		}
	else
	{
	$requete=$bdd->prepare("SELECT maillot FROM club WHERE id_club='$id_club'");
	$requete->execute();
	$donnees=$requete->fetch();
	$maillot= $donnees['maillot'];
	echo "<img src=\"../css/$maillot\"/>";
	}
	}
function Type_message($type)
{
	if($type==1)
	{
		echo "<span class=\"bg-danger\" >Tag :</span>";
	}
	elseif($type==2)
	{
		echo "<span class=\"bg-info\" >Réponse :</span>";
	}
}
function Format_date($date)
	{
	sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute,$seconde);
	echo 'le '.$jour.'/'.$mois.'/'.$annee.' à '.$heure.':'.$minute.':'.$seconde;
	}
function Club_domicile($id_club)
{
  include("global/connexion.msi.php");
  $requete=$bdd->prepare("SELECT * FROM club WHERE id_club='$id_club'");
  $requete->execute();
  $donnees=$requete->fetch();
  $nom_club=$donnees['nom_club'];
  $fanion=$donnees['fanion'];
  echo" <img src=\"../css/$fanion\" style=\"width:40px;\"/><span class=\"hidden-xs\">$nom_club</span>";
}  
function Fanion($id_club)
	{
	include("global/connexion.msi.php");
	$requete=$bdd->prepare("SELECT fanion,nom_club FROM club WHERE id_club='$id_club'");
	$requete->execute();
	$donnees=$requete->fetch();
	$fanion=$donnees['fanion'];
	$nom_club=$donnees['nom_club'];
	return "<img title=\"$nom_club\" style=\"width:40px;\" src=\"../css/$fanion\" />";
	}
function Nom_club($id_club)
	{
	include("global/connexion.msi.php");
	$requete=$bdd->prepare("SELECT nom_club FROM club WHERE id_club='$id_club'");
	$requete->execute();
	$donnees=$requete->fetch();
	return $donnees['nom_club'];
	}
function Club_exterieur($id_club)
{
  include("global/connexion.msi.php");
  $requete=$bdd->prepare("SELECT * FROM club WHERE id_club='$id_club'");
  $requete->execute();
  $donnees=$requete->fetch();
  $nom_club=$donnees['nom_club'];
  $fanion=$donnees['fanion'];
  echo"<div style=\"text-align:right;\"><span class=\"hidden-xs\">$nom_club</span> <img src=\"../css/$fanion\" style=\"width:40px;\" /></div>";
}  
function Resultat($id_match)
{
   include("global/connexion.msi.php");
  $requete=$bdd->prepare("SELECT * FROM journee WHERE id_match='$id_match'");
  $requete->execute();
  $donnees=$requete->fetch();
  $score=$donnees['score'];
  if($score==0)
  { 
    echo"<img class=\"img-responsive\" src=\"../css/image/pasdeprono.png\" width=\"80%\"/>";
  }
  elseif($score==1)
  {
    echo"<img class=\"img-responsive\" src=\"../css/image/victoire.png\" width=\"80%\"/>";
  }
  elseif($score==2)
  {
    echo"<img class=\"img-responsive\" src=\"../css/image/match_nul.png\" width=\"80%\"/>";
  }
  elseif($score==3)
  {
    echo"<img class=\"img-responsive\" src=\"../css/image/defaite.png\" width=\"80%\"/>";
  }
}
function Prono($id_match,$id_membre)
{
   include("global/connexion.msi.php");
  $requete=$bdd->prepare("SELECT * FROM  pronostic WHERE id_match='$id_match' AND id_membre='$id_membre'");
  $requete->execute();
  $donnees=$requete->fetch();
  $pronostic=$donnees['pronostic'];
  if($pronostic==0)
  {
    echo"<img class=\"img-responsive\" src=\"../css/image/pasdeprono.png\" width=\"80%\"/>";
  }
  elseif($pronostic==1)
  {
    echo"<img class=\"img-responsive\" src=\"../css/image/victoire.png\" width=\"80%\"/>";
  }
  elseif($pronostic==2)
  {
    echo"<img class=\"img-responsive\" src=\"../css/image/match_nul.png\" width=\"80%\"/>";
  }
  elseif($pronostic==3)
  {
    echo"<img class=\"img-responsive\" src=\"../css/image/defaite.png\" width=\"80%\"/>";
  }
}
function Apparence($id_match,$id_membre)
{
  include("global/connexion.msi.php");
  $requete=$bdd->prepare("SELECT * FROM  pronostic INNER JOIN journee ON pronostic.id_match=journee.id_match WHERE journee.id_match='$id_match' AND pronostic.id_membre='$id_membre'");
  $requete->execute();
  $donnees=$requete->fetch();
  $score=$donnees['score'];
  $pronostic=$donnees['pronostic'];
  if($score==0)
  {
    
  }
  elseif($score==$pronostic)
  {
    echo "style=\"background-color:#AAFFAA;\"";
  }
  else
  {
    echo "style=\"background-color:#FFAAAA;\"";
  }
}
function Avatar($avatar)
{
  include("global/connexion.msi.php");
  if(($avatar==0)OR($avatar==21))
		{
		echo "<img class=\"img-responsive\" src=\"../css/image/avatar/pronosligue.png\" width=\"30px\"/>";
		}
	else
	{
  $requete=$bdd->prepare("SELECT * FROM club WHERE id_club='$avatar'");
  $requete->execute();
  $donnees=$requete->fetch();
  $avatar=$donnees['maillot'];
    echo"<img class=\"img-responsive\" src=\"../css/$avatar\" width=\"30px\"/>";
  }
}
function Color_classement($j)
{
  if($j==1)
  {
    echo "class=\"warning\"";
  }
  elseif($j==2)
  {
    echo "class=\"active\"";
  }
  elseif($j==3)
  {
    echo "class=\"info\"";
  }
  elseif($j==4)
  {
    echo "class=\"danger\"";
  }
    elseif($j==5)
  {
    echo "class=\"success\"";
  }
}
function Arebour($date_limite)
{
	$date_limite=strtotime($date_limite);
	$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"); 
	$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
	$jour_limite=date('w',$date_limite);
	$numero_limite=date('d',$date_limite);
	$mois_limite=date('n',$date_limite);
	$heure_limite=date('H:i:s',$date_limite);
	$datefr = $jour[$jour_limite]." ".$numero_limite." ".$mois[$mois_limite]." ".date("Y")." à ".$heure_limite.""; 
	?><div class="alert alert-danger">
	<strong>Date limite</strong> <?php echo $datefr;?>
	</div>
	<?php
}	
function Classement($id_club)
{
	include("global/connexion.msi.php");
	$requete=$bdd->prepare("SELECT classement FROM club WHERE id_club='$id_club'");
	$requete->execute();
	$donnees=$requete->fetch();
	return $donnees['classement'];
}
function Seriedomicile($id_club,$numero)
	{
	include("global/connexion.msi.php");
	$requete=$bdd->prepare("SELECT * FROM club WHERE id_club='$id_club'");
	$requete->execute();
	$donnees=$requete->fetch();
	$serie=$donnees['domicile'.$numero.''];
	if($serie==1)
		{
		echo "<img src=\"../css/image/gagne.png\" title=\"Gagné\"/>";
		}
	elseif($serie==2)
		{
		echo "<img src=\"../css/image/nul_match.png\" title=\"Nul\"/>";
		}
	elseif($serie==3)
		{
		echo "<img src=\"../css/image/perdu.png\" title=\"Perdu\"/>";
		}
	else
		{
		echo "";
		}
	}
function Serieexterieur($id_club,$numero)
	{
	include("global/connexion.msi.php");
	$requete=$bdd->prepare("SELECT * FROM club WHERE id_club='$id_club'");
	$requete->execute();
	$donnees=$requete->fetch();
	$serie=$donnees['exterieur'.$numero.''];
	if($serie==1)
		{
		echo "<img src=\"../css/image/gagne.png\" title=\"Gagné\"/>";
		}
	elseif($serie==2)
		{
		echo "<img src=\"../css/image/nul_match.png\" title=\"Nul\"/>";
		}
	elseif($serie==3)
		{
		echo "<img src=\"../css/image/perdu.png\" title=\"Perdu\"/>";
		}
	else
		{
		echo "";
		}
	}
function Serie($id_club,$numero)
	{
	include("global/connexion.msi.php");
	$requete=$bdd->prepare("SELECT * FROM club WHERE id_club='$id_club'");
	$requete->execute();
	$donnees=$requete->fetch();
	$serie=$donnees['serie'.$numero.''];
	if($serie==1)
		{
		echo "<img src=\"../css/image/gagne.png\" title=\"Gagné\"/>";
		}
	elseif($serie==2)
		{
		echo "<img src=\"../css/image/nul_match.png\" title=\"Nul\"/>";
		}
	elseif($serie==3)
		{
		echo "<img src=\"../css/image/perdu.png\" title=\"Perdu\"/>";
		}
	else
		{
		echo "";
		}
	}
function Bonus($id_membre)
{
	include("global/connexion.msi.php");
	$requete=$bdd->prepare("SELECT * FROM membre WHERE id_membre='$id_membre'");
	$requete->execute();
	$donnees=$requete->fetch();
	$point=$donnees['point'];
	$podiummembre_1=$donnees['podium_1'];
	$podiummembre_2=$donnees['podium_2'];
	$podiummembre_3=$donnees['podium_3'];
	$relegablemembre_1=$donnees['relegable_1'];
	$relegablemembre_2=$donnees['relegable_2'];
	$relegablemembre_3=$donnees['relegable_3'];
	$bonus=0;
	$r2=$bdd->prepare("SELECT * FROM club ORDER BY point DESC,difference_but DESC");
	$r2->execute();
	$i=1;
	while($d2=$r2->fetch())
	{	
		$id_club=$d2['id_club'];
		$r3=$bdd->prepare("UPDATE club SET classement='$i' WHERE id_club='$id_club'");
		$r3->execute();
		$i++;
	}
	$r4=$bdd->prepare("SELECT * FROM club WHERE classement=1");
	$r4->execute();
	$d4=$r4->fetch();
	$podium_1=$d4['id_club'];
	$r4b=$bdd->prepare("SELECT * FROM club WHERE classement=2");
	$r4b->execute();
	$d4b=$r4b->fetch();
	$podium_2=$d4b['id_club'];
	$r4c=$bdd->prepare("SELECT * FROM club WHERE classement=3");
	$r4c->execute();
	$d4c=$r4c->fetch();
	$podium_3=$d4c['id_club'];
	$r4d=$bdd->prepare("SELECT * FROM club WHERE classement=18");
	$r4d->execute();
	$d4d=$r4d->fetch();
	$relegable_1=$d4d['id_club'];
	$r4e=$bdd->prepare("SELECT * FROM club WHERE classement=19");
	$r4e->execute();
	$d4e=$r4e->fetch();
	$relegable_2=$d4e['id_club'];
	$r4f=$bdd->prepare("SELECT * FROM club WHERE classement=20");
	$r4f->execute();
	$d4f=$r4f->fetch();
	$relegable_3=$d4f['id_club'];
	if($podium_1==$podiummembre_1)
	{
		$bonus=$bonus+1;
	}
	elseif($podium_2==$podiummembre_2)
	{
		$bonus=$bonus+1;
	}
	elseif($podium_3==$podiummembre_3)
	{
		$bonus=$bonus+1;
	}
	if(($podium_1==$podiummembre_1) AND ($podium_2==$podiummembre_2))
	{
		$bonus=$bonus+2;
	}
	elseif(($podium_1==$podiummembre_1) AND ($podium_3==$podiummembre_3))
	{
		$bonus=$bonus+2;
	}
	elseif(($podium_3==$podiummembre_3) AND ($podium_2==$podiummembre_2))
	{
		$bonus=$bonus+2;
	}
	if(($podium_1==$podiummembre_1) AND ($podium_2==$podiummembre_2) AND ($podium_3==$podiummembre_3))
	{
		$bonus=$bonus+2;
	}
	if($relegable_1==$relegablemembre_1)
	{
		$bonus=$bonus+1;
	}
	elseif($relegable_2==$relegablemembre_2)
	{
		$bonus=$bonus+1;
	}
	elseif($relegable_3==$relegablemembre_3)
	{
		$bonus=$bonus+1;
	}
	if(($relegable_1==$relegablemembre_1) AND ($relegable_2==$relegablemembre_2))
	{
		$bonus=$bonus+2;
	}
	elseif(($relegable_1==$relegablemembre_1) AND ($relegable_3==$relegablemembre_3))
	{
		$bonus=$bonus+2;
	}
	elseif(($relegable_3==$relegablemembre_3) AND ($relegable_2==$relegablemembre_2))
	{
		$bonus=$bonus+2;
	}
	if(($relegable_1==$relegablemembre_1) AND ($relegable_2==$relegablemembre_2) AND ($relegable_3==$relegablemembre_3))
	{
		$bonus=$bonus+2;
	}
	$total_bonus=$point+$bonus;
	$requete_bonus=$bdd->prepare("UPDATE membre SET total_bonus='$total_bonus' WHERE id_membre='$id_membre'");
	$requete_bonus->execute();
	return $bonus;
}