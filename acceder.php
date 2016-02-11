<!DOCTYPE html>
<?php 

 require_once("class/class.php");

?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RH | auth</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<div class="row">
	
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
	
			<div class="login-panel panel panel-primary">
				<div class="panel-heading">Inscription</div>
				<br><br>
				<div class="panel-body">
				<?php 
				  session_name('SESSION1');
				session_start();
				$log=$_SESSION['l'];
				
				$id_u=$user->select_id($log);
				$user->acceder($id_u,$log);
				
				?>
				<h4><p class="text-success">Votre compte a eté creer avec succées <a href="accueil.php">Acceder au espace de gestion</a></p></h4>
<br><br><br><br>
					
				</div>
		</div>
		
		
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
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
