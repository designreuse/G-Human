<?php 
include('header.php') ;
?>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Modifier Congé</li>
			</ol>
		</div><!--/.row-->
		
		
		
		<br><br>
		<?php 
		$id=$_GET['id'];
		$id_c=$_GET['id_c'];
		$liste=$cong->select_conge_id($id_c);
		
		foreach($liste as $row)
		{
			$debut=$row['debut'];
			$fin=$row['fin'];
			$type=$row['type'];
		}
		?>
		<form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']."?id=".$_GET['id']."&id_c=".$_GET['id_c']; ?>">
	  <input type="hidden" name="id" value="<?php echo $id; ?>">
	  <input type="hidden" name="id_c" value="<?php echo $id_c; ?>">
		<?php
 
 $typeE=$debutE=$finE="";
 
	 if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			$erreur = true ; 
if( $controle->vide($_POST["debut"])) 
{
	$debutE=" * champ obligatoire";

}	

if( $controle->vide($_POST["fin"])) 
{
	$finE=" * champ obligatoire";
}

if( $controle->vide($_POST["type"])) 
{
	$typeE=" * champ obligatoire";
}



if($controle->no_vide($_POST["debut"],$_POST["fin"],$_POST["type"]))
{		

			$debut = $_POST['debut'];
			$fin = $_POST['fin'];
			$type = $_POST['type'];
			$id_c = $_POST['id_c'];
			$id= $_POST['id'];
			$id_c= $_POST['id_c'];
			
			$update = $cong->modifier_conge($id_c,$debut,$fin,$type,$id);
			if($update)
			{
				$link="afficher_conge.php?message=update&id=$id";
				$user->location($link);
			}
		}
	}
	?>	
 <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Debut</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" value="<?php echo $debut; ?>" id="calendar"  name="debut" placeholder="date de debut">
      <span class="error"><?php echo $debutE;?></span>
	  </div>
	   </div>
	   
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Fin</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" value="<?php echo $fin; ?>" id="calendar1"  name="fin" placeholder="date de fin">
      <span class="error"><?php echo $finE;?></span>
	  </div>
	   </div>
	   
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Type</label>
      <div class="col-sm-6">
         <input type="text" class="form-control"  value="<?php echo $type; ?>" id="firstname" name="type" placeholder="">
      <span class="error"><?php echo $typeE;?></span>
	  </div>
	   </div>
	
	   <br><br>
	    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
	  <input type="submit" value="Modifier" class="btn btn-primary">
	
   </div>
   
</form>	   
				
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});
                 $('#calendar1').datepicker({
		});
		
	</script>	
</body>

</html>
