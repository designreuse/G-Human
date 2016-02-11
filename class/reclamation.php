<?php
require_once("DataBase.php");
class reclamation
{
	
	
	public function __construct()
	{
	
	}
	
	public function ajouter_reclamation($sujet,$texte,$id_user)
	{
		
		$insert = DataBase::connect()->prepare('insert into reclamation VALUES
		(NULL,:etat,:sujet,:texte,NULL,:id)');
try {		
	$ins = $insert->execute(
	array(
	
	'etat'=>"en cours de traitement",
	'sujet'=>$sujet,
	'texte'=>$texte,
	'id'=>$id_user
	
	
	)
	);
}
		catch( Exception $e )
			{
	  
					echo 'Erreur de requète : ', $e->getMessage();
	
			}
			
		return true;
	}


 
 public function liste_reclamation($id)
 {
	 $select = DataBase::connect()->query("select * from reclamation where id_user='$id' order by id_rec DESC");
	$liste = $select->fetchAll(PDO::FETCH_ASSOC);
	return $liste;
 }
	
 public function afficher_reclamation($id)
 {
	$select = DataBase::connect()->query("select * from reclamation where id_rec='$id' order by id_rec DESC");
	$liste = $select->fetchAll(PDO::FETCH_ASSOC);
	return $liste;
 }	
	
}




 
?>