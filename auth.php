<?php
require_once 'class/class.php';
$log = $_POST["login"];
$pass = $_POST["pass"];

if ($user->login($log, $pass)) {
    $id_u = $user->select_id($log);
    session_name('K1Q');
    session_start() ; 
    $_SESSION['SUCe']= "xx88xxc1r123yyI;;::!!1a" ; 
    $_SESSION['l'] = $log;
    echo 1 ;
} else {
    echo 0 ;
}




?>