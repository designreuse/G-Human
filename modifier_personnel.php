<?php 
include('header.php') ;
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Staff update</li>
			</ol>
		</div><!--/.row-->
		
		
		<?php 
		$id_g = $_GET['id'];
		$liste = $per->select_personnel($id_g);
		
		foreach($liste as $row)
		{
			$contrat = $row['contrat'];
			$nom = $row['nom'];
			$prenom = $row['prenom'];
			$poste = $row['poste'];
			$email = $row['email'];
			$tel = $row['tel'];
			$ncin = $row['ncin'];
                        $date_n = $row['date_n'];
                        $adresse = $row['adresse'];
                        $date_e = $row['date'];
                        
                        $etude = $row['etude'];
			$id_per = $row['id_personnel'];
			$salaire = $row['salaire'];
		}
		
		?>
		<br><br>
		
		
		<form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']."?id=".$_GET['id']; ?>">
 
  <input type="hidden" name="id_personnel" value="<?php echo $id_per; ?>">
 <?php
 
 $posteE=$ncinE=$emailE=$telE=$nomE=$prenomE=$dateE=$date_nE=$date_eE=$adresseE=$salaireE="";
 
	 if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			$erreur = true ; 
if( $controle->vide($_POST["poste"])) 
{
	$posteE=" * required";

}	
if( $controle->vide($_POST["date_n"])) 
{
	$date_nE=" * required";

}
if( $controle->vide($_POST["adresse"])) 
{
	$adresseE=" * required";

}
if( $controle->vide($_POST["ncin"])) 
{
	$ncinE=" * required";
}
if( $controle->vide($_POST["date"])) 
{
	$dateE=" * required";
}

if( $controle->vide($_POST["email"])) 
{
	$emailE=" * required";
}
if( $controle->vide($_POST["tel"])) 
{
	$telE=" * required";
}

if( $controle->vide($_POST["nom"])) 
{
	$nomE=" * required";
}
if( $controle->vide($_POST["prenom"])) 
{
	$prenomE=" * required";
}
if( $controle->vide($_POST["salaire"])) 
{
	$salaireE=" * required";
}

if($controle->no_vide($_POST["email"]) && $controle->no_email($_POST['email']))
{
	$emailE="  Incorrect email ";
	$erreur = false ;
}

if($controle->no_vide($_POST["ncin"]) && $controle->noNCIN($_POST['ncin']))
{
	$ncinE="  Incorrect ID Card";
	$erreur = false ;
}
if($controle->no_vide($_POST["tel"]) && $controle->noTEL($_POST['tel']))
{
	$telE="  Incorrect phone number";
	$erreur = false ;
}


    		
if($controle->no_vide($_POST["prenom"],$_POST["nom"],$_POST["poste"],$_POST["ncin"],$_POST["email"],$_POST["tel"]) && ($erreur==true))
{

			$poste = htmlentities($_POST['poste']);
			$ncin =  htmlentities($_POST['ncin']);
			$email = htmlentities($_POST['email']);
			$tel =   htmlentities($_POST['tel']);
			$nom =   htmlentities($_POST['nom']);
			$prenom =htmlentities($_POST['prenom']);
			$contrat=htmlentities($_POST['contrat']);
			$date =  htmlentities($_POST['date_n']);
                        $niveau= htmlentities($_POST['niveau']);
			$date_n= htmlentities($_POST['date_n']);
                        $adresse=htmlentities($_POST['adresse']);
                        $salaire=htmlentities($_POST['salaire']);
			$id_p =  htmlentities($_POST['id_personnel']);
			
			 
		
			$update = $per->modifier_personnel($id_p,$poste,$ncin,$email,$tel,$nom,$prenom,$contrat,$date_n,$adresse,$etude,$salaire);
			if($update)
			{
				$link='consulter_personnel.php?message=update&id='.$id_p;
				$user->location($link);
			}
		}}
	?>	
 <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">First name</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" value="<?php echo $nom; ?>"  name="nom" placeholder="">
      <span class="error"><?php echo $nomE; ?></span>
   
	  </div>
	   </div>
	  
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Last name</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" name="prenom" value="<?php echo $prenom; ?>" placeholder="">
      <span class="error"><?php echo $prenomE;?></span>
	  </div>
	   </div>
	   
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Date of birth : </label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="calendar1" name="date_n" value="<?php echo $date_n; ?>" placeholder="">
      <span class="error"><?php echo $date_nE;?></span>
	  </div>
	   </div>
	    <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Adress </label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" name="adresse" value="<?php echo $adresse; ?>" placeholder="">
      <span class="error"><?php echo $adresseE; ?>
      
      </span>
	  </div>
	   </div>
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">ID Card</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" value="<?php echo $ncin; ?>" name="ncin" placeholder="">
      <span class="error"><?php echo $ncinE;?></span>
	  </div>
	   </div>
	   
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Pone number</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" value="<?php echo $tel; ?>" name="tel" placeholder="">
      <span class="error"><?php echo $telE;?></span>
	  </div>
	   </div>
	    <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Hiring date</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="calendar" value="<?php echo $date_e; ?>" name="date_e" placeholder="">
      <span class="error"><?php echo $date_eE;?></span>
	  </div>
	   </div>
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">E-MAIL</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" value="<?php echo $email; ?>"  name="email" placeholder="">
      <span class="error"><?php echo $emailE;?></span>
	  </div>
	   </div>
    
	   <div class="form-group">
      <label class="col-sm-2 control-label">Contract type</label>
	  <div class="col-sm-6">
	    <?php 
		$per->check_contrat($contrat);
		?>
    
   </div>
   </div>
  <div class="form-group">
      <label class="col-sm-2 control-label">Study level</label>
	  <div class="col-sm-6">
	    <?php 
		$per->check_etude($etude);
		?>
    
   </div>
   </div>
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Work position</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" value="<?php echo $poste; ?>" id="firstname" name="poste" placeholder="">
     <span class="error"><?php echo $posteE;?></span>
	 </div>
	   </div>
	    <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Salary (DT)</label>
      <div class="col-sm-6">
         <input type="number" class="form-control" value="<?php echo $salaire; ?>" id="firstname" name="salaire" placeholder="" >
     <span class="error"><?php echo $salaireE;?></span>
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
            $('#calendar').datepicker({});
            $('#calendar1').datepicker({});
        </script>
</body>

</html>
