<?php
require_once 'class/class.php';
$mois = $_POST["mois"];
$annes = $_POST["annes"];
$point->chercher_liste_jour_travail($mois,$annes);
?>