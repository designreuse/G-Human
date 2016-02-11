<?php 
include('header.php') ;
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Changer mot de passe</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Changer mot de passe</h1>
			</div>
		</div><!--/.row-->
		
		<br><br>
	<form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <?php
$passE=$npassE=$rnpassE= "";
 
	 if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{	
			$data = $user->value_session(); 

			$tpass= $data['pass'] ;
			
			$login= $data['login'] ;
			
			if($controle->vide($_POST['pass']))
			{
				$passE="* champ obligatoire";
			}
			if($controle->vide($_POST['npass']))
			{
				$npassE="* champ obligatoire";
			}
			if($controle->vide($_POST['rnpass']))
			{
				$rnpassE="* champ obligatoire";
			}
			
			
			
			if($controle->no_vide($_POST['pass'],$_POST['npass'],$_POST['rnpass']))
			{	
		$pass = $_POST['pass'];
				$npass = $_POST['npass'];
				$rnpass = $_POST['rnpass'];
		
		 if(($pass!=$tpass)){
			 	$passE="ancien mot de passe incorrecte";
				}
							
							

     if ($npass!=$rnpass){
    $rnpassE="retaper mot de passe correctement";
				
	}
								
		if (($pass==$tpass) && ($npass==$rnpass) ){
			
				
				
				if($user->changer_pass($npass,$login))
				{
				$link='suite.php';
				$user->location($link);
				}
			}
		}}
 
 ?>
		<div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Mot de passe</label>
      <div class="col-sm-6">
         <input type="password" class="form-control" id="firstname" name="pass" placeholder="">
      <span class="error"><?php echo $passE;  ?></span>
	  </div>
	   </div>
	   <br>
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Nouveau mot de passe</label>
      <div class="col-sm-6">
         <input type="password" class="form-control" id="firstname" name="npass" placeholder="">
      <span class="error"><?php echo $npassE;  ?></span>
	  </div>
	   </div>
	   <br>
	  <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Confirmation mot de passe</label>
      <div class="col-sm-6">
         <input type="password" class="form-control" id="firstname" name="rnpass" placeholder="">
      <span class="error"><?php echo $rnpassE;  ?></span>
	  </div>
	   </div>
	  
	  <div class="form-group">
      <label class="col-sm-2 control-label"></label>
	  <input type="submit" value="Valider" class="btn btn-primary">
	
   </div>
			</form>	
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
