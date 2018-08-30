<?php
if(isset($_POST['valider']))
	{
		$journee=$_POST['journee'];
		$id_match=$_POST['id_match'];
		$but_domicile=$_POST['but_domicile'];
		$but_exterieur=$_POST['but_exterieur'];
		$r1=$bdd->prepare("SELECT* FROM journee WHERE id_match='$id_match'");
		$r1->execute();
		$d1=$r1->fetch();
		$domicile=$d1['club_domicile'];
		$exterieur=$d1['club_exterieur'];
		$r2=$bdd->prepare("UPDATE club SET but_pour=but_pour+'$but_domicile',but_contre=but_contre+'$but_exterieur',journee='$journee' WHERE id_club='$domicile'");
		$r2->execute();
		$r3=$bdd->prepare("UPDATE club SET but_pour=but_pour+'$but_exterieur',but_contre=but_contre+'$but_domicile',journee='$journee' WHERE id_club='$exterieur'");
		$r3->execute();
		$r4=$bdd->prepare("UPDATE club SET difference_but=but_pour-but_contre WHERE id_club='$domicile'");
		$r4->execute();
		$r5=$bdd->prepare("UPDATE club SET difference_but=but_pour-but_contre WHERE id_club='$exterieur'");
		$r5->execute();
		if($but_domicile==$but_exterieur)
			{
			$r6=$bdd->prepare("UPDATE club SET point=point+1,match_nul=match_nul+1 WHERE id_club='$domicile'");
			$r6->execute();
			$r7=$bdd->prepare("UPDATE club SET point=point+1,match_nul=match_nul+1 WHERE id_club='$exterieur'");
			$r7->execute();
			$r8=$bdd->prepare("UPDATE journee SET score=2 WHERE id_match='$id_match'");
			$r8->execute();
			$r9=$bdd->prepare("UPDATE club SET serie1=serie2,serie2=serie3,serie3=serie4,serie4=serie5,serie5=2 WHERE id_club='$exterieur'");
			$r9->execute();
			$r10=$bdd->prepare("UPDATE club SET serie1=serie2,serie2=serie3,serie3=serie4,serie4=serie5,serie5=2 WHERE id_club='$domicile'");
			$r10->execute();
			$r11=$bdd->prepare("UPDATE club SET exterieur1=exterieur2,exterieur2=exterieur3,exterieur3=exterieur4,exterieur4=exterieur5,exterieur5=2 WHERE id_club='$exterieur'");
			$r11->execute();
			$r12=$bdd->prepare("UPDATE club SET domicile1=domicile2,domicile2=domicile3,domicile3=domicile4,domicile4=domicile5,domicile5=2 WHERE id_club='$domicile'");
			$r12->execute();
			$score=2;
			}
		elseif($but_domicile>$but_exterieur)
			{
			$r6=$bdd->prepare("UPDATE club SET point=point+3,victoire=victoire+1 WHERE id_club='$domicile'");
			$r6->execute();
			$r7=$bdd->prepare("UPDATE club SET defaite=defaite+1 WHERE id_club='$exterieur'");
			$r7->execute();
			$r8=$bdd->prepare("UPDATE journee SET score=1 WHERE id_match='$id_match'");
			$r8->execute();
			$r9=$bdd->prepare("UPDATE club SET serie1=serie2,serie2=serie3,serie3=serie4,serie4=serie5,serie5=3 WHERE id_club='$exterieur'");
			$r9->execute();
			$r10=$bdd->prepare("UPDATE club SET serie1=serie2,serie2=serie3,serie3=serie4,serie4=serie5,serie5=1 WHERE id_club='$domicile'");
			$r10->execute();
			$r11=$bdd->prepare("UPDATE club SET exterieur1=exterieur2,exterieur2=exterieur3,exterieur3=exterieur4,exterieur4=exterieur5,exterieur5=3 WHERE id_club='$exterieur'");
			$r11->execute();
			$r12=$bdd->prepare("UPDATE club SET domicile1=domicile2,domicile2=domicile3,domicile3=domicile4,domicile4=domicile5,domicile5=1 WHERE id_club='$domicile'");
			$r12->execute();
			$score=1;
			}
		elseif($but_domicile<$but_exterieur)
			{
			$r6=$bdd->prepare("UPDATE club SET point=point+3,victoire=victoire+1 WHERE id_club='$exterieur'");
			$r6->execute();
			$r7=$bdd->prepare("UPDATE club SET defaite=defaite+1 WHERE id_club='$domicile'");
			$r7->execute();
			$r8=$bdd->prepare("UPDATE journee SET score=3 WHERE id_match='$id_match'");
			$r8->execute();
			$r9=$bdd->prepare("UPDATE club SET serie1=serie2,serie2=serie3,serie3=serie4,serie4=serie5,serie5=1 WHERE id_club='$exterieur'");
			$r9->execute();
			$r10=$bdd->prepare("UPDATE club SET serie1=serie2,serie2=serie3,serie3=serie4,serie4=serie5,serie5=3 WHERE id_club='$domicile'");
			$r10->execute();
			$r11=$bdd->prepare("UPDATE club SET exterieur1=exterieur2,exterieur2=exterieur3,exterieur3=exterieur4,exterieur4=exterieur5,exterieur5=1 WHERE id_club='$exterieur'");
			$r11->execute();
			$r12=$bdd->prepare("UPDATE club SET domicile1=domicile2,domicile2=domicile3,domicile3=domicile4,domicile4=domicile5,domicile5=3 WHERE id_club='$domicile'");
			$r12->execute();
			$score=3;
			}
			$r12=$bdd->prepare("SELECT  id_membre FROM membre");
			$r12->execute();	
			while($d12=$r12->fetch())
				{
				$id_membre=$d12['id_membre'];
				$r13=$bdd->prepare("SELECT * FROM point_journee WHERE id_membre='$id_membre' AND id_journee='$journee'");
				$r13->execute();
				$d13=$r13->fetch();
				$point_journee=$d13['point_journee'];
				$r14=$bdd->prepare("SELECT * FROM pronostic WHERE id_membre='$id_membre' AND id_match='$id_match'");
				$r14->execute();
				$d14=$r14->fetch();
				$pronostic=$d14['pronostic'];
				$r15=$bdd->prepare("SELECT * FROM membre WHERE id_membre='$id_membre'");
				$r15->execute();
				$d15=$r15->fetch();
				$point=$d15['point'];
				$point=$point-$point_journee;
				$r16=$bdd->prepare("UPDATE membre SET point='$point' WHERE id_membre='$id_membre'");
				$r16->execute();
				if($score==$pronostic)
					{
					$point_journee++;
					}
				else
					{
					$point_journee=$point_journee;
					}
				if($point_journee==7)
					{
					$point_journee++;
					if($id_match % 10==0)
						{
						$rbis=$bdd->prepare("UPDATE membre SET bonus_7=bonus_7+1 WHERE id_membre='$id_membre'");
						$rbis->execute();
						}
					}
				elseif($point_journee==9)
				{
					$point_journee++;
					if($id_match % 10==0)
						{
						$rbis=$bdd->prepare("UPDATE membre SET bonus_8=bonus_8+1 WHERE id_membre='$id_membre'");
						$rbis->execute();
						}
				}
				elseif($point_journee==11)
				{
					if($id_match % 10==0)
						{
						$rbis=$bdd->prepare("UPDATE membre SET bonus_9=bonus_9+1 WHERE id_membre='$id_membre'");
						$rbis->execute();
						}
					$point_journee++;
				}
				elseif($point_journee==13)
				{
					if($id_match % 10==0)
						{
						$rbis=$bdd->prepare("UPDATE membre SET bonus_10=bonus_10+1 WHERE id_membre='$id_membre'");
						$rbis->execute();
						}
					$point_journee=+2;
				}
				$r17=$bdd->prepare("UPDATE point_journee SET point_journee='$point_journee' WHERE id_membre='$id_membre' AND id_journee='$journee'");
				$r17->execute();
				$total=Bonus($id_membre);
				$r18=$bdd->prepare("UPDATE membre SET point=point+'$point_journee',total_bonus=point+'$total' WHERE id_membre='$id_membre'");
				$r18->execute();
				$r19=$bdd->prepare("UPDATE membre SET classement_1=classement_2 WHERE id_membre='$id_membre'");
				$r19->execute();
				$r20=$bdd->prepare("SELECT * FROM membre ORDER BY point DESC,");
				$r20->execute();
				$j=1;
				while($d20=$r20->fetch())
					{
					$id_membre=$d20['id_membre'];
					$r21=$bdd->prepare("UPDATE membre SET classement_2='$j' WHERE id_membre='$id_membre'");
					$r21->execute();
					$j++;
					}
				}
		echo "<p>Traitement en cours</p>";
		print("<script type=\"text/javascript\">setTimeout('location=(\"index.php?page=admin\")' ,1000);</script>");			
	}
else
	{
	$requete=$bdd->prepare("SELECT * FROM journee WHERE score='0' ORDER BY journee ASC LIMIT 1");
	$requete->execute();
	$donnees=$requete->fetch();
	$journee=$donnees['journee'];
	echo "<form action=\"\" method=\"post\">";
	echo "<caption>Résultats journée n° $journee</caption>";
	$requetebis= $bdd->prepare("SELECT * FROM journee WHERE journee='$journee' AND score=0 ORDER BY id_match");
	$requetebis->execute();
	echo"<p><label>Choisir un match</label></p>";
	echo "<select name=\"id_match\">";
	while($donneesbis=$requetebis->fetch())
		{
		$domicile=$donneesbis['club_domicile'];
		$exterieur=$donneesbis['club_exterieur'];
		$id_match=$donneesbis['id_match'];
		?>
		<option value=" <?php echo $id_match; ?>"> <?php echo Nom_club($domicile);?> : <?php echo Nom_club($exterieur); ?></option>
		<?php
		}
		echo "</select>";
		echo"<p><label>But_domicile</label></p>";
		echo "<select name=\"but_domicile\">";
		echo"<option value=\"0\">0</option>";
		echo"<option value=\"1\">1</option>";
		echo"<option value=\"2\">2</option>";
		echo"<option value=\"3\">3</option>";
		echo"<option value=\"4\">4</option>";
		echo"<option value=\"5\">5</option>";
		echo"<option value=\"6\">6</option>";
		echo"<option value=\"7\">7</option>";
		echo"<option value=\"8\">8</option>";
		echo"<option value=\"9\">9</option>";
		echo "</select>";
		echo"<p><label>But_exterieur</label></p>";
		echo "<select name=\"but_exterieur\">";
		echo"<option value=\"0\">0</option>";
		echo"<option value=\"1\">1</option>";
		echo"<option value=\"2\">2</option>";
		echo"<option value=\"3\">3</option>";
		echo"<option value=\"4\">4</option>";
		echo"<option value=\"5\">5</option>";
		echo"<option value=\"6\">6</option>";
		echo"<option value=\"7\">7</option>";
		echo"<option value=\"8\">8</option>";
		echo"<option value=\"9\">9</option>";
		echo "</select>";
		echo"<input type=\"hidden\" name=\"journee\" value=\"".$journee."\"/>";
		echo"<p><input type=\"submit\" value=\"valider\" name=\"valider\"/></p>";
		?>
		</form>
		<?php 
	}
?>