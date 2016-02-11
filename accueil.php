<?php 
include('header.php') ;
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Liste Personnel</li>
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
				
                
                
                <br><br>
                
                
            
                
                
                
                
	
 </div>
					
				
	</div>	<!--/.mainaffichage-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>

</html>
