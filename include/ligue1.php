<div class="col-xs-12 col-sm-12  col-md-12" >
  <h2 style="text-align:center;border-radius:10px 10px;"><span class="glyphicon glyphicon-equalizer"></span> Ligue 1 <span class="glyphicon glyphicon-equalizer"></span></h2>
  <table class="table table-striped">
  <thead>
    <tr style="text-align:center;">
      <th></th>
      <th>Club</th>
      <th>Pts</th>
      <th>J</th>
      <th>V</th>
      <th>N</th>
      <th>D</th>
      <th>Bp</th>
      <th>Bc</th>
      <th>Diff</th>
   </tr>
  </thead>
  <tbody>
    <?php 
    $requete=$bdd->prepare("SELECT * FROM club ORDER BY point DESC,difference_but DESC");
    $requete->execute();
    $j=1;
    while($donnees=$requete->fetch())
     {
    ?>
    <tr><td><?php echo $j;?></td><td><?php echo Club_domicile($donnees['id_club']);?></td><td> <?php echo $donnees['point'];?></td><td><?php echo $donnees['journee'];?></td><td><?php echo $donnees['victoire'];?> </td><td><?php echo $donnees['match_nul'];?></td><td><?php echo $donnees['defaite'];?></td><td><?php echo $donnees['but_pour'];?></td><td><?php echo $donnees['but_contre'];?></td><td><?php echo $donnees['difference_but'];?></td></tr>
    <?php
      $j++;
    }?>
  </tbody>
  </table>
</div>