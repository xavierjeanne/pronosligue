<?php
include("../global/connexion.msi.php");
ini_set("session.cookie_domain", ".pronosligue.fr");
session_start();
if(isset($_POST['inscription']))
{
	if(!empty($_POST['pseudo']))
	{
	$pseudo=htmlspecialchars($_POST['pseudo']);
	$pseudo_inscription_temporaire=$pseudo;
		if(!empty($_POST['email']))
			{
			$email=htmlspecialchars(strtolower($_POST['email']));
			$email_inscription_temporaire=$email;
			if(filter_var($email,FILTER_VALIDATE_EMAIL))
				{
				if(!empty($_POST['mdp']))
					{
					$mdp=htmlspecialchars(strtolower($_POST['mdp']));
					if(!empty($_POST['verif_mdp']))
						{
						$verif_mdp=htmlspecialchars(strtolower($_POST['verif_mdp']));
						if($mdp==$verif_mdp)
							{
							$requete=$bdd->prepare("SELECT count(id_membre) AS entree FROM membre WHERE pseudo = :pseudo");
							$requete->execute(array('pseudo' => $pseudo));
							$donnees=$requete->fetch();
							$entree=$donnees['entree'];
							if($entree==0)
								{
								$requete=$bdd->prepare("INSERT INTO membre (pseudo,email,mdp,etape) VALUES (:pseudo,:email,:mdp,:etape)");
								$requete->execute(array('pseudo'=>$pseudo,'email'=>$email,'mdp'=>$mdp,'etape'=>0));
								$id_membre = $bdd->lastInsertId();
								$_SESSION['id_membre']=$id_membre;
								$_SESSION['pseudo']=$pseudo;
			
								header("Location:../index.php?page=accueil");
								}
							else
								{
								$alerte="<p>Ce pseudo existe déjà, merci  d'en choisir un autre.</p>";
								header("Location:../index.php?page=inscription&alerteinscription=$alerte&email_inscription_temporaire=$email_inscription_temporaire");
								}
							}
						else
							{
							$alerte="<p>Les deux mots de passes ne sont pas identiques.</p>";
							header("Location:../index.php?page=inscription&alerteinscription=$alerte&pseudo_inscription_temporaire=$pseudo_inscription_temporaire&email_inscription_temporaire=$email_inscription_temporaire");
							}
						}
					else
						{
						$alerte="<p>La vérification du mot de passe est nécessaire.</p>";
						header("Location:../index.php?page=inscription&alerteinscription=$alerte&pseudo_inscription_temporaire=$pseudo_inscription_temporaire&email_inscription_temporaire=$email_inscription_temporaire");
						}
					}	
				else
					{
					$alerte="<p>Un mot de passe est nécessaire.</p>";
					header("Location:../index.php?page=inscription&alerteinscription=$alerte&pseudo_inscription_temporaire=$pseudo_inscription_temporaire&email_inscription_temporaire=$email_inscription_temporaire");
					}
				}
			else
				{
				$alerte="<p>L'email n'est pas valide.</p>";
				header("Location:../index.php?page=inscription&alerteinscription=$alerte&pseudo_inscription_temporaire=$pseudo_inscription_temporaire");
				}
			}
		else
			{
			$alerte="<p>Un email est nécessaire.</p>";
			header("Location:../index.php?page=inscription&alerteinscription=$alerte&pseudo_inscription_temporaire=$pseudo_inscription_temporaire");
			}
		}
	else
		{
		$alerte="<p>Un pseudo est nécessaire.</p>";
	  header("Location:../index.php?page=inscription&alerteinscription=$alerte");
		}
	}
elseif(isset($_POST['connexion']))
{
	if(!empty($_POST['pseudo']))
	{
	$pseudo=htmlspecialchars($_POST['pseudo']);
	$pseudo_inscription_temporaire=$pseudo;
		if(!empty($_POST['mdp']))
		{
		$mdp=htmlspecialchars(strtolower($_POST['mdp']));
		$requete=$bdd->prepare("SELECT count(id_membre) AS entree,mdp,id_membre,pseudo FROM membre WHERE pseudo = :pseudo");
		$requete->execute(array('pseudo' => $pseudo));
		$donnees=$requete->fetch();
		$entree=$donnees['entree'];
			if($entree!=0)
			{
			$mdp_base=$donnees['mdp'];
				if($mdp==$mdp_base)
				{
				$_SESSION['pseudo']=$donnees['pseudo'];
				$chemin=$_POST['chemin'];
				$_SESSION['id_membre']=$donnees['id_membre'];
				$id_membre=$donnees['id_membre'];
				$pseudo=$donnees['pseudo'];
					if(isset($_POST['sesouvenir']))
					{
					setcookie("id_membre",$id_membre,time()+60*60*24*30,'/');
					setcookie("pseudo",$pseudo,time()+60*60*24*30,'/');
					}
				header("Location:../index.php?page=$chemin");
				}
				else
				{
				$alerte="<p>Erreur de mot de passe.</p>";
				header("Location:../index.php?page=connexion&alerteconnexion=$alerte&pseudo_connexion_temporaire=$pseudo");
				}
			}
			else
			{
			$alerte="<p>Ce pseudo n'existe pas.</p>";
			header("Location:../index.php?page=connexion&alerteconnexion=$alerte");
			}
		}
		else
		{
		$alerte="<p>Un mot de passe est nécessaire.</p>";
		header("Location:../index.php?page=connexion&alerteconnexion=$alerte");
		}
	}
	else
	{
	$alerte="<p>Un pseudo est nécessaire.</p>";
	header("Location:../index.php?page=connexion&alerteconnexion=$alerte");
	
	}
}
?>