<?php
require_once 'class/class.php';

    $now = date("Y-m-d");
    $mois = date("m", strtotime($now));
    $annes = date("Y", strtotime($now));
    $jour = date("d", strtotime($now));
    $day = date("l", strtotime($now));
    
    
    $ajout = $point->pointage_travail($day,$jour,$mois,$annes);
    
   if($ajout)
   {
       echo 1  ;
   }