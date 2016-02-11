<?php 
include('header.php') ;
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Consulter présence</li>
			</ol>
		</div><!--/.row-->
		
		
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
               <h3>
        <?php 
        $point->jour();
        ?>
        
       
    </h3>
                <br>
                <div id="resultat">
		<table class="table table-responsive table-bordered" id="liste_s">
		<thead>
		<tr>
		<th>Jour</th><th>Date</th><th></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$point->afficher_presence($id);
		?>
		</tbody>
		</table>
                </div>			
			
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	 <script>
 
     
          


$("#btn-sub").click(function(){
	 
        
   var formData=$("#recherche").serialize();
	
	
	$.ajax({
		type: "POST",
		url: "filtre_presence.php",
		cache:false,
		data: formData,
                
		success:onSucces,
		error:onErro 
			
  });
	function onSucces(data,status){
          
             $("#liste_s").hide('slow');
		$("#resultat").html(data);
               
                
			}
	function onErro(data,status){
		alert('erreur');
			}
	
	});
 </script>
</body>

</html>
