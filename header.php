<!DOCTYPE html>
<?php
session_name('K1Q');
session_start() ; 
if (empty($_SESSION['l']) || empty($_SESSION['SUCe']) || $_SESSION['SUCe'] != "xx88xxc1r123yyI;;::!!1a") {
header('location:./') ; 
}
require_once('class/class.php');
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>G-Human</title>
        <link rel="icon" href="../img/logo.ico">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/base/jquery-ui.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/datepicker.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        
           
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="liste_personnel.php"><span><strong>G-Human (Demo)</strong></span></a>
                    <ul class="user-menu">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><strong> Utilisateur</strong> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href=""><span class="glyphicon glyphicon-cog"></span> Mot de passe</a></li>
                                <li><a href="class/logout.php"><span class="glyphicon glyphicon-log-out"></span> Deconnexion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.container-fluid -->
        </nav>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <br>
            <ul class="nav menu">
                <li><a href="calendrier.php"><span class="glyphicon glyphicon-calendar"></span>Calendrier de travail</a></li>

                <li><a href="liste_personnel.php"><span class="glyphicon glyphicon-user"></span> Gestion personnel</a></li>

                <li><a href="chercher_liste_pointage.php"><span class="glyphicon glyphicon-hand-down"></span> Pointage personnel</a></li>
                <li><a href="liste_conge.php"><span class="glyphicon glyphicon-time"></span> Gestion de congé</a></li>
                <li><a href="liste_presence.php"><span class="glyphicon glyphicon-filter"></span> Gestion de présence</a></li>
                <li><a href="liste_salaire.php"><span class="glyphicon glyphicon-euro"></span> Liste de salaire</a></li>


                <li><a href="class/logout.php"><span class="glyphicon glyphicon-log-out"></span> Deconnexion</a></li>


            </ul>
        </div><!--/.sidebar-->