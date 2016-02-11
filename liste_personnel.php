<?php 
include('header.php') ;
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Liste personnel</li>
			</ol>
		</div><!--/.row-->
		
                <br>
		
             
		<div class="row">
		<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-user glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">
							<?php
							
							
							$nbr = $per->total_personnel();
							echo $nbr;
							?>
							</div>
							<div class="text-muted">Personnel</div>
						</div>
					</div>
				</div>
			</div>
			
					<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-time glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">
							<?php
							
							$nbr_c = $cong->total_conge();
							echo $nbr_c;
							?>
							</div>
							<div class="text-muted"> en congé</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-briefcase glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">
							<?php
							
							$nbr_c = $per->total_archive();
							echo $nbr_c;
							?>
							</div>
							<div class="text-muted"> en archive</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
				
                <br>
		
<a href="ajouter_personnel.php"><img src='img/ajout.png' width='30' height='30'></img> </a>

<br><br>

 <?php 

 
 $per->affichage();
 

 ?>

 <br>
 <form class="form-horizontal" id="recherche" role="form" method="post">
		<div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Chercher personnel</label>
      <div class="col-sm-9">
         <input type="text" class="form-control" id="personnel" name="personnel" placeholder="">
      <span class="error"></span>
	  </div>
	  <div class="col-sm-2">
	 
	
	  </div>
	   </div>
		</form>
 <br>
 <div id="affichage" class="affichage">
		<table class="table table-striped table-bordered" id="tab_s">
		<thead>
		<tr>
		<th>Matricule</th><th>Nom & Prenom</th><th>Poste</th><th></th><th></th><th></th><th></th> 
		</thead>
		<tbody>
		<?php
			
		

		$per->liste_personnel();
		?>
		</tbody>
		</table>
 </div>
					
				
	</div>	<!--/.mainaffichage-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script>
	
        $("#tab_s").show();
	$("#personnel").keyup(function(){
	  var formData=$("#recherche").serialize();
	
	var personnel = $("#personnel").val();
        load = "<div class='loading' id='load'> <img src='img/load.GIF' class='load-img'></div>"; 
  $("#affichage").html(load);
	$.ajax({
		type: "POST",
		url: "chercher.php",
		cache:false,
		data: formData,
		success:onSucces,
		error:onErro 
			
  });
        
       
	function onSucces(data,status){
            
                $("#tab_s").hide();
		$("#affichage").html(data);
                
			}
                        
	function onErro(data,status){
            
		alert('erreur de connexion');
                
			}
	
	});

		
	</script>	
</body>

</html>
