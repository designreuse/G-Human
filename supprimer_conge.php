<?php 
require_once('class/class.php');
$id_conge = $_GET['id_conge'];
$id = $_GET['id'];
$cong->supprimer_conge($id_conge);
$link="afficher_conge.php?message=delete&id=$id";
$user->location($link);

?>