<?php 
include('class/class.php');
$mois = $_POST['mois'] ; 
$annes = $_POST['annes']; 
$id = $_POST['id']; 
$point->filtre_presence($mois,$annes,$id);




?>
		
    