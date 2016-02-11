<?php 
require_once('class/class.php');
$id = $_GET['id'];
$per->archiver_personnel($id);
$link='liste_personnel.php?message=archive';
$user->location($link);

?>