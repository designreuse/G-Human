<?php 
include('header.php') ;
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Liste Personnel (Congé)</li>
			</ol>
		</div><!--/.row-->
		
		<br>

 

 <?php 

 
 $per->affichage();
 

 ?>

 <br>
 
		   <?php
    $id = $_GET['id'];
    $liste = $per->select_personnel($id);
    foreach ($liste as $row) {
        ?>

        <br>
        <table class="table table-responsive table-bordered">
            <tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>NCIN</th><th>Poste</th></tr>
            <tr>

                <td>
                    <?php echo $row['id_personnel']; ?>
                </td>


                <td>
                    <?php echo $row['nom']; ?>	
                </td>

                <td>
                    <?php echo $row['prenom']; ?>
                </td>

                <td>
                    <?php echo $row['ncin']; ?>
                </td>

                <td>
                    <?php echo $row['poste']; ?>
                </td>
            </tr>

        </table>

    <?php } ?>	
        <br>
       <a href="ajouter_conge.php?id=<?php echo $id ?>"><img src='img/ajout.png' width='30' height='30'></img> </a>
		
        <br><br>

		<table class="table table-responsive table-bordered table-hover">
		<thead>
		<tr>
		<th>Type</th><th>Date de debut</th><th>Date de fin</th><th></th><th></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$cong->liste_conge_id($id);
		?>
		</tbody>
		</table>
					
				
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		
	</script>	
</body>

</html>
