<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pronosligue</title>
		<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="icon" href="../css/image/favicon.ico" />
	</head>
	<body>
	<header>
		<?php
			$requete=$bdd->prepare("SELECT journee FROM journee WHERE score='0' ORDER BY id_match ASC LIMIT 1");
			$requete->execute();
			if($donnees=$requete->fetch())
			{
				$journee=$donnees['journee'];
			}
			else
			{
				$requete=$bdd->prepare("SELECT journee FROM journee ORDER BY id_match DESC LIMIT 1");
				$requete->execute();
				$donnees=$requete->fetch();
				$journee=$donnees['journee'];
			}
			if(isset($_GET['journee']))
			{
				$journee=$_GET['journee'];
			}
			?>
		<div class="container-fluid" id="header">
			<p><img src="../css/image/logo.png"/></p>
		</div>
		<div class="navbar navbar-inverse navbar-fixed_top" role="navigation">
		<!-- Partie de la barre toujours affich�e -->
			<div class="navbar-header">
			<!-- Bouton d'acc�s affich� � droite si la zone d'affichage est trop petite -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
				<span class="sr-only">Activer la navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			</div>
			<!-- Partie de la barre masqu�e si la surface d'affichage est insuffisante -->
			<div class="collapse navbar-collapse" id="navbar-collapse-target">
				<ul class="nav navbar-nav">
					<li <?php if(!isset($_GET['page'])OR ($_GET['page']=='accueil')){echo "class=\"active\"";}?>><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
					<li <?php if(($_GET['page']=='pronostic')){echo "class=\"active\"";}?>><a href="index.php?page=pronostic&journee=<?php echo $journee;?>">Pronostic</a></li>
					<li <?php if(($_GET['page']=='resultat')){echo "class=\"active\"";}?>><a href="index.php?page=resultat">Résultat</a></li>
					<li <?php if(($_GET['page']=='classement')){echo "class=\"active\"";}?>><a href="index.php?page=classement">Classement</a></li>
					<li <?php if(($_GET['page']=='ligue1')){echo "class=\"active\"";}?>><a href="index.php?page=ligue1">Ligue 1</a></li>
					<li <?php if(($_GET['page']=='bar')){echo "class=\"active\"";}?>><a href="index.php?page=bar">Bar des sports <span class="label label-danger"><?php echo $bar;?></span></a></li>
					<li <?php if(($_GET['page']=='bonus')){echo "class=\"active\"";}?>><a href="index.php?page=bonus">Bonus</a></li>
					<li <?php if(($_GET['page']=='defi')){echo "class=\"active\"";}?>><a href="index.php?page=defi">Défi</a></li>
					<li <?php if(($_GET['page']=='score')){echo "class=\"active\"";}?>><a href="index.php?page=score">Score</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li <?php if(($_GET['page']=='profil')){echo "class=\"active\"";}?>><a href="index.php?page=profil"><span class="glyphicon glyphicon-user"></span> <?php if(!empty($pseudo)){echo $pseudo;}else{echo "Connexion";}?></a></li>
					<li <?php if(($_GET['page']=='notification')){echo "class=\"active\"";}?>><a href="index.php?page=notification">Notification   <span class="label label-danger"><?php echo $notification;?></span></a></li>
                    <li><a href="index.php?page=inscription">inscription</a></li>
					<li <?php if(($_GET['page']=='deconnexion')){echo "class=\"active\"";}?>><a href="global/deconnexion.php" title="deconnexion"><span class="glyphicon glyphicon-log-out"></span> </a></li>
					
					<?php if($pseudo=='xavier'){echo"<li><a href=\"index.php?page=admin\">Admin</a></li>";}?>
				</ul>
			</div>
		</div>
	</header>