<?php 
require_once('class/class.php');
$id = $_GET['id'];
$id_personnel = $_GET['id_personnel'];
$point->supprimer_pointage($id);
$link="afficher_pointage.php?message=delete&id=$id_personnel";
$user->location($link);

?>