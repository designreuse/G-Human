<?php

require 'class/class.php';


$id = $_POST["id"];

$heur_s = $_POST["sortie"];
$id_pointage = $point->dernier_pointage($id);
$point->pointage_sortie($id_pointage, $heur_s);



