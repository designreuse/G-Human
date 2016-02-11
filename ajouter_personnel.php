<?php 
include('header.php') ;
?>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Ajouter Personnel</li>
			</ol>
		</div><!--/.row-->
		
		<br>
		<form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
 <?php
 
 $posteE=$ncinE=$emailE=$telE=$nomE=$prenomE=$dateE=$date_nE=$adresseE=$salaireE="";
 
	 if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			$erreur = true ; 
if( $controle->vide($_POST["poste"])) 
{
	$posteE=" * champ obligatoire";

}	
if( $controle->vide($_POST["date_n"])) 
{
	$date_nE=" * champ obligatoire";

}
if( $controle->vide($_POST["adresse"])) 
{
	$adresseE=" * champ obligatoire";

}
if( $controle->vide($_POST["ncin"])) 
{
	$ncinE=" * champ obligatoire";
}
if( $controle->vide($_POST["date"])) 
{
	$dateE=" * champ obligatoire";
}

if( $controle->vide($_POST["email"])) 
{
	$emailE=" * champ obligatoire";
}
if( $controle->vide($_POST["tel"])) 
{
	$telE=" * champ obligatoire";
}

if( $controle->vide($_POST["nom"])) 
{
	$nomE=" * champ obligatoire";
}
if( $controle->vide($_POST["prenom"])) 
{
	$prenomE=" * champ obligatoire";
}
if( $controle->vide($_POST["salaire"])) 
{
	$salaireE=" * champ obligatoire";
}

if($controle->no_vide($_POST["email"]) && $controle->no_email($_POST['email']))
{
	$emailE="  Email incorrecte";
	$erreur = false ;
}

if($controle->no_vide($_POST["ncin"]) && $controle->noNCIN($_POST['ncin']))
{
	$ncinE="  NCIN incorrecte";
	$erreur = false ;
}
if($controle->no_vide($_POST["tel"]) && $controle->noTEL($_POST['tel']))
{
	$telE="  Num tel incorrecte";
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
			$date =  htmlentities($_POST['date']);
                        $niveau= htmlentities($_POST['niveau']);
			$date_n= htmlentities($_POST['date_n']);
                        $adresse=htmlentities($_POST['adresse']);
			$salaire=htmlentities($_POST['salaire']);
			
			
			$ajout=$per->ajouter_personnel($poste,$ncin,$email,$tel,$nom,$prenom,$contrat,$niveau,$date,$date_n,$adresse,$salaire);
			
			if($ajout)
			{
				$link='liste_personnel.php?message=add';
				$user->location($link);
			}
		}}
	?>	
 <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Nom</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" name="nom" placeholder="">
      <span class="error"><?php echo $nomE;?></span>
	  </div>
	   </div>
	   
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Prénom</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" name="prenom" placeholder="">
      <span class="error"><?php echo $prenomE;?></span>
	  </div>
	   </div>
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Date de naissance : </label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="calendar" name="date_n" placeholder="">
     <span class="error"><?php echo $date_nE;?></span>
	 </div>
	   </div>
        <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Adresse : </label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" name="adresse" placeholder="">
     <span class="error"><?php echo $adresseE;?></span>
	 </div>
	   </div>
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">NCIN</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" name="ncin" placeholder="">
      <span class="error"><?php echo $ncinE;?></span>
	  </div>
	   </div>
	   
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Teléphone</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" name="tel" placeholder="">
      <span class="error"><?php echo $telE;?></span>
	  </div>
	   </div>
	   
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">E-MAIL</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" name="email" placeholder="">
      <span class="error"><?php echo $emailE;?></span>
	  </div>
	   </div>
	   <div class="form-group">
      <label class="col-sm-2 control-label">Type de contrat</label>
	  <div class="col-sm-6">
              <select class='form-control' name='contrat'>
                  <option value="SIVP">SIVP</option>
                  <option value="CDD">CDD</option>
                  <option value="CDI">CDI</option>
              </select>
   </div>
   </div>
  <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Niveau d'étude</label>
      <div class="col-sm-6">
          <select name="niveau" class="form-control">
              <option value="Doctorat">Doctorat</option>
              <option value="Mastére ">Mastére</option>
              <option value="Ingéniera">Ingéniera</option>
              <option value="Licence fendamentale">Licence fendamentale</option>
              <option value="Licence appliquée">Licence appliquée</option>
              
              <option value="Technicien supérieur">Technicien supérieur</option>
              <option value="Technicien">Technicien</option>
              
              <option value="Baccalauréat +2">Baccalauréat +2</option>
              <option value="Baccalauréat +1">Baccalauréat +1</option>
              <option value="Baccalauréat">Baccalauréat</option>
              <option value="Secondaire">Secondaire</option>
              <option value="Primaire">Primaire</option>
              
          </select>
	 </div>
	   </div>
                     <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Date d'embauche</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="calendar1" name="date" placeholder="">
        
     <span class="error"><?php echo $dateE;?></span>
	 </div>
	   </div>
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Poste</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" name="poste" placeholder="">
     <span class="error"><?php echo $posteE;?></span>
	 </div>
	   </div>
	   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">Salaire en DT</label>
      <div class="col-sm-6">
         <input type="number" class="form-control" id="firstname" name="salaire" placeholder="">
     <span class="error"><?php echo $salaireE;?></span>
	 </div>
	   </div>
	    
	   <br>
	    <div class="form-group">
      <label class="col-sm-7 control-label"></label>
	  <input type="submit" value="Ajouter" class="btn btn-primary">
	
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
