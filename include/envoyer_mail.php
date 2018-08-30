<?php
if(isset($_POST['envoyer_mail']))
{
  
}
elseif(isset($_GET['choix']))
{
  if($_GET['choix']==1)
  {
  $requete=$bdd->prepare("SELECT mail FROM membre WHERE etape='4'");
  $requete->execute();
  $liste_mail='xavier.jeanne@gmail.com';
    //while($donnees=$requete->fetch())
    //{
   // $liste_mail .= ','; //On sépare les adresses par une virgule.
   // $liste_mail .= $donnees['mail'];
   // }
    $fichier_message = '<html>
   <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pronosligue</title>
		<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="icon" href="../css/image/favicon.ico" />
	  </head>
    <body bgcolor="black">
    <div class="container-fluid" id="header">
			<p><img src="../css/image/logo.png"/></p>
		</div>
  
    <font face="verdana"><font color="white"><font size="5"><p align="center"><font color="red"><u>Balzac61</u></font></p></font>
    <font size="3">
    <p align="left">Voici les dernières news de MonSite.fr :<br /></body></html>'; // On termine le message.
    $message = $fichier_message;
    $objet = "Journée à pronostiquer"; // On définit l'objet qui contient la date.
    $headers  = 'MIME-Version: 1.0' . '\r\n';
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . '\r\n';
    $headers .= 'From: xavier.jeanne@gmail.com' . '\r\n'; // On définit l'expéditeur.
    $headers .= 'Bcc:' . $liste_mail . '' . '\r\n'; // On définit les destinataires en copie cachée pour qu'ils ne puissent pas voir les adresses des autres inscrits.
    mail($liste_mail, $objet, $fichier_message, $headers);
   }
  else
  {
    
  }
}
else
{
  ?>
<ul>
  <li><a href="index.php?page=envoyer_mail&choix=1">Mail collectif</a></li>
  <li><a href="index.php?page=envoyer_mail&choix=2">Choix des mails</a></li>
</ul>
<?php
}
?>