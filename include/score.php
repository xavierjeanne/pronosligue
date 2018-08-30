<div id="score_tempo">
		<div class="row" class="col-xs-12 col-md-12">
			 <nav aria-label="...">
  				<ul class="pagination pagination-sm">
   				 <li class="page-item">
  				  <a class="page-link" href="index.php?page=score&journee=<?php echo $journee-1;?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
    				<?php for($i=1;$i<20;$i++)
      			{?>
      				 <li class="page-item"><a class="page-link" href="index.php?page=score&journee=<?php echo $i;?>"><?php echo $i;?></a></li>
     				 <?php      
     				 }?>
    				<li class="page-item"><a class="page-link" href="index.php?page=score&journee=<?php echo $journee+1;?>" aria-label="Next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
				  </ul>
				</nav>
			<?php if(isset($_GET['journee']))
				{
				$journee=$_GET['journee'];
				}
			?>
			<div class="table-responsive">
			<?php 
			$requete=$bdd->prepare("SELECT * FROM membre INNER JOIN point_journee ON membre.id_membre=point_journee.id_membre WHERE membre.etape=4 AND point_journee.id_journee='$journee' ORDER BY point_journee.point_journee DESC ");
			$requete->execute();
			$i=1;
			?>
			<table class="table table-striped" style="font-weight:normal;">
				<thead>
				<tr><th></th><th></th><th>J<?php echo $journee;?></th><th style="text-align:center;">Pts par journée</th><th>Total</th></tr>
				</thead>
				<tbody>
				<?php
				$i=1;
				while($donnees=$requete->fetch())
				{
				$point_journee=$donnees['point_journee'];		
        ?>	
				<tr <?php if($i<6){echo "class=\"success\"";}?>><td><?php echo $i;?></td><td><?php echo Avatar($donnees['avatar']);?></td><td> <?php echo $donnees['pseudo'];?></td><td style="text-align:center;"><span <?php if($point_journee>6){echo "style=\"color:red;weight:bold;\"";}?>><?php echo $point_journee;?></span></td><td><?php echo $donnees['point'];?></td>	</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
			</div>
		</div>
	</div>