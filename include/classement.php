<div class="col-xs-12 col-sm-12  col-md-12" >
  <h2 style="text-align:center;border-radius:10px 10px;"><span class="glyphicon glyphicon-th-list"></span> Classement <span class="glyphicon glyphicon-th-list"></span></h2>
  <table class="table table-striped">
  <thead>
    <tr style="text-align:center;">
      <th></th>
      <th class="hidden-xs"></th>
      <th>Pseudo</th>
      <th>Total</th>
      <th>Pt pronos</th>
      <th>B.class.</th>
      <th>J<?php echo $journee;?></th>
      <th>B.10</th>
      <th>B.9</th>
      <th>B.8</th>
      <th>B.7</th>
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
    <tr  <?php echo Color_classement($j);?>><td><?php echo $j;?></td><td class="hidden-xs"><?php echo Avatar($donnees_tempo['avatar']);?></td><td> <?php echo $donnees_tempo['pseudo'];?></td><td><?php echo $donnees_tempo['total_bonus']; ?></td><td><?php echo $donnees_tempo['point'];?></td><td><?php echo $bonus;?></td><td><span <?php if($donnees_point['point_journee'] >7){echo "style=\"color:red;\"";}?>> + <?php echo $donnees_point['point_journee'];?></span> </td><td><?php echo $donnees_tempo['bonus_10'];?></td><td><?php echo $donnees_tempo['bonus_9'];?></td><td><?php echo $donnees_tempo['bonus_8'];?></td><td><?php echo $donnees_tempo['bonus_7'];?></td></tr>
    <?php
      $j++;
    }?>
  </tbody>
  </table>
</div>