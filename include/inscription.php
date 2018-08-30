
<div class="inscription">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-8">
			<h1 class="col-xs-offset-2 col-md-offset-4"><span class="glyphicon glyphicon-user"></span> INSCRIPTION</h1>  
				<?php if(isset($_GET['alerteinscription']))
					{?>
					<div class="alert alert-danger">
						<strong><?php echo $_GET['alerteinscription'];?></strong>
					</div>
					<?php
					}?>
				<form action="include/verif.php" name="login" role="form" class="form-horizontal" method="post" accept-charset="utf-8">
					<div class="form-group">
					<div class="col-md-12"><input name="pseudo" placeholder="<?php if(isset($_GET['pseudo_inscription_temporaire'])){echo $_GET['pseudo_inscription_temporaire'];}else{echo "Pseudo";}?>" value="<?php if(isset($_GET['pseudo_inscription_temporaire'])){echo $_GET['pseudo_inscription_temporaire'];}?>" class="form-control" type="text" id="UserUsername"/></div>
					</div> 
					
					<div class="form-group">
					<div class="col-md-12"><input name="mdp" placeholder="Mot de passe" class="form-control" type="password" id="UserPassword"/></div>
					</div> 
					
					<div class="form-group">
					<div class="col-md-12"><input name="verif_mdp" placeholder="verifier le mot de passe" class="form-control" type="password" id="UserPassword"/></div>
					</div>
					
					<div class="form-group">
					<div class="col-md-12"><input name="email" placeholder="<?php if(isset($_GET['pseudo_email_temporaire'])){echo $_GET['email_inscription_temporaire'];}else{echo "Email";}?>" class="form-control" type="email" id="Useremail"/></div>
					</div> 
					
					<div class="form-group">
					<div class="col-md-8"><input  class="btn btn-success btn btn-success" type="submit" value="Insciption" name="inscription"/></div>
					</div>
				
				</form>
			</div>
	</div>
</div>