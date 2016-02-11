<?php 


 require_once("DataBase.php");
 require_once("user.php");
 require_once("personnel.php");
 require_once("ctrl.php");
 require_once("conge.php");
 require_once("pointage.php");
 require_once("salaire.php");
 require_once("reclamation.php");
 
 
  $user = new user();
  $rec = new reclamation();
  $controle = new ctrl();
  $db= new Database(); 
  $per= new personnel(); 
  $cong= new conge(); 
  $point= new pointage(); 
  $salaire= new salaire(); 


?>