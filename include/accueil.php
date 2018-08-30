<?php
?>


<div class="col-xs-12 col-sm-12  col-md-12 col-lg-8" style="background-color:white;" >
 <h2 style="text-align:center"><span class="glyphicon glyphicon-align-left"></span> Pronostic <span class="glyphicon glyphicon-align-right"></span></h2>
  <nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item">
    <a class="page-link" href="index.php?page=accueil&journee=<?php echo $journee-1;?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
    <?php for($i=1;$i<20;$i++)
      {?>
       <li class="page-item"><a class="page-link" href="index.php?page=accueil&journee=<?php echo $i;?>"><?php echo $i;?></a></li>
      <?php      
      }?>
    <li class="page-item"><a class="page-link" href="index.php?page=accueil&journee=<?php echo $journee+1;?>" aria-label="Next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
  </ul>
</nav>
  <table class="table table-striped">
  <thead>
    <tr>
      <th>Domicile</th>
      <th>Résultat</th>
      <th style="text-align:center;">pronostic</th>
      <th style="text-align:right;">Extérieur</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $requete_journee=$bdd->prepare("SELECT * FROM journee WHERE journee='$journee'");
    $requete_journee->execute();
    while($donnees_journee=$requete_journee->fetch())
    {
    $date_limite=$donnees_journee['date_limite'];
    ?>
      <tr class="align-middle"><td><?php echo Club_domicile($donnees_journee['club_domicile']);?></td><td><?php echo Resultat($donnees_journee['id_match']);?></td><td  <?php echo Apparence($donnees_journee['id_match'],$id_membre);?>><?php Prono($donnees_journee['id_match'],$id_membre);?></td><td><?php echo Club_exterieur($donnees_journee['club_exterieur']);?> </td></tr>
    <?php
    }
     
     Arebour($date_limite);
     $date_limite=strtotime($date_limite);
    $now=time();
    if($date_limite>=$now)
    {
      echo "<div class=\"row\"><div class=\"col-md-offset-3 col-md-6 col-md-offset-3\"><a href=\"index.php?page=pronostic&journee=$journee\" class=\"btn btn-primary center-block\">Pronostiquer</a></div></div>";
    }
    ?>
  </tbody>
  </table>
</div>
<div class="col-xs-12 col-sm-12  col-md-12 col-lg-4" style="border:1px solid gray;border-radius:20px 20px;background-color:white;">
  <h2 style="text-align:center;border-radius:10px 10px;"><span class="glyphicon glyphicon-th-list"></span> Classement <span class="glyphicon glyphicon-th-list"></span></h2>
  <table class="table table-striped">
  <thead>
    <tr>
      <th></th>
      <th class="hidden-xs"></th>
      <th>Pseudo</th>
      <th>Total (avec bonus) </th>
      <th>J<?php echo $journee;?></th>
      <th>Pt pronos</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $requete_tempo=$bdd->prepare("SELECT * FROM membre WHERE etape=4 ORDER BY total_bonus DESC,total_bonus-point DESC,bonus_10 DESC,bonus_9 DESC,bonus_8 DESC,bonus_7 DESC");
    $requete_tempo->execute();
    $j=1;
    while($donnees_tempo=$requete_tempo->fetch())
     {
    $membre_classement=$donnees_tempo['id_membre'];
    $requete_point=$bdd->prepare("SELECT * FROM point_journee WHERE id_journee='$journee' AND id_membre='$membre_classement'");
    $requete_point->execute();
    $donnees_point=$requete_point->fetch();
    $membre=$donnees_point['id_membre'];
    $total_bonus=$donnees_tempo['total_bonus'];
    $point=$donnees_tempo['point'];
     $bonus=$total_bonus-$point;
    ?>
    <tr <?php echo Color_classement($j);?>><td><?php echo $j;?></td><td  class="hidden-xs"><?php echo Avatar($donnees_tempo['avatar']);?></td><td style="overflow:hidden;text-overflow:ellipsis;"> <?php echo $donnees_tempo['pseudo'];?></td><td><?php echo $donnees_tempo['total_bonus'];?>(<?php echo $bonus;?>)</td><td><span <?php if($donnees_point['point_journee'] >7){echo "style=\"color:red;\"";}?>><?php echo $donnees_point['point_journee'];?></span> </td><td><?php echo $donnees_tempo['point'];?></td></tr>
    <?php
      $j++;
    }?>
  </tbody>
  </table>
</div>

