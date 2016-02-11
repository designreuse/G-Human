<?php

require_once('class/class.php');
$id = $_GET['id'];
$bol = $per->supprimer_personnel($id);
if ($bol == 1) {
    $link = 'liste_personnel.php?message=delete';
    $user->location($link);
} else {
    $link = 'liste_personnel.php?message=erreur';
    $user->location($link);
}
?>