<?php 
require_once("DataBase.php");
class salaire 
{
	public $now;
	
	function __construct()
	{
			$this->now = date("Y-m-d");
	}
	
	public function liste_salaire()
	{
		
		$select = DataBase::connect()->query("select * from personnel ORDER BY id_personnel DESC");

        while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
            $id_personnel = $donnees->id_personnel;
            $nom = $donnees->nom;
            $prenom = $donnees->prenom;
            $poste = $donnees->poste;
            $salaire = $donnees->salaire;
            $archive = $donnees->archive;
            if ($archive == 0) {
                echo "<tr>";
                echo "<td>";
                echo $id_personnel;
                echo "</td>";
                echo "<td>";
                echo $nom . " " . $prenom;
                echo "</td>";
                echo "<td>";
                echo $salaire;
                echo "</td>";
            
                echo "<td>";
                echo "<a href='modifier_salaire.php?id=$id_personnel'>";
                echo " <img src='img/modif.jpg' width='30' height='30'></img> </a>";
                echo "</td>";
              
                echo "</tr>";
            }
		
        }
        
        
            }
	
		public function select_salaire_id($id)
			{
		
	        $select = DataBase::connect()->query("select * from salaire where id_salaire='$id'");
			$salaire = $select->fetchAll(PDO::FETCH_ASSOC);
			return $salaire;
			}
			
			
			
			
			public function modifier_salaire($id_c,$salaire)
	{
		
		$insert = DataBase::connect()->prepare('update salaire SET
		salaire=:salaire where id_salaire=:id_c');
try {		
	$ins = $insert->execute(
	array(
	'salaire'=>$salaire,
	'id_c'=>$id_c
	)
	);
}
		catch( Exception $e )
			{
	  
					echo 'Erreur de requète : ', $e->getMessage();
	
			}
			
		return true;
	}
	
	
	public function calcul_salaire($id_user)
	{
		$select = DataBase::connect()->query("select * from personnel where id_user='$id_user' ORDER BY id_personnel DESC");
		
		while($donnees = $select->fetch(PDO::FETCH_OBJ))
		{
			$id_personnel  = $donnees->id_personnel;
			$nom = $donnees->nom;
			$prenom = $donnees->prenom;
			$poste= $donnees->poste;
			
			$select_poste = DataBase::connect()->query("select * from poste as p inner join salaire as s on p.id_poste=s.id_poste where p.poste='$poste'");
		while($donnees_poste = $select_poste->fetch(PDO::FETCH_OBJ))
		{
			$salaire = $donnees_poste->salaire;
		}
		$select_pointage = DataBase::connect()->query("select distinct*, count(date_t) as nbr from pointage  where id_personnel='$id_personnel'");
		while($donnees_pointage = $select_pointage->fetch(PDO::FETCH_OBJ))
		{
			$mois = $donnees_pointage->mois;
			$nbr = $donnees_pointage->nbr;
		}
		$total=$salaire*$nbr;
			
			
			echo "<tr>";
			echo "<td>";
			echo $id_personnel;
			echo "</td>";
			echo "<td>";
			echo $nom." ".$prenom;
			echo "</td>";
			echo "<td>";
			echo $poste;
			echo "</td>";
			echo "<td>";
			echo $mois;
			echo "</td>";
			echo "<td>";
			echo $total." DT";
			echo "</td>";
			
			echo "</tr>";
			
			
		}
		
	}
	
	
}


?>