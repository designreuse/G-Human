<?php

require_once("DataBase.php");

class personnel {

    public function __construct() {
        $this->now = date("Y-m-d");
    }

    public function ajouter_personnel($poste, $ncin, $email, $tel, $nom, $prenom, $contrat, $niveau, $date, $date_n, $adresse,$salaire) {
        $np = $nom . " " . $prenom;

       

        $archive = 0;
        $insert = DataBase::connect()->prepare('insert into personnel VALUES
		(NULL,:poste,:ncin,:email,:tel,:nom,:prenom,:np,:contrat,:archive,:etude,:date,:date_n,:adresse,:salaire)');
        try {
            $ins = $insert->execute(
                    array(
                        'poste' => $poste,
                        'ncin' => $ncin,
                        'email' => $email,
                        'tel' => $tel,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'contrat' => $contrat,
                        'archive' => $archive,
                        'etude' => $niveau,
                        'np' => $np,
                        'date' => $date,
                        'date_n' => $date_n,
                        'adresse' => $adresse,
                        'salaire' => $salaire
                    )
            );
        } catch (Exception $e) {

            echo 'Erreur de requète : ', $e->getMessage();
        }

        return true;
    }

    public function modifier_personnel($id_p, $poste, $ncin, $email, $tel, $nom, $prenom, $contrat, $date_n, $adresse, $etude, $salaire) {

        $up = DataBase::connect()->prepare('update  personnel SET
		poste=:poste,ncin=:ncin,email=:email,tel=:tel,nom=:nom,prenom=:prenom,contrat=:contrat,date_n=:date_n,adresse=:adresse,etude=:etude,salaire=:salaire where id_personnel=:id_personnel');
        try {
            $update = $up->execute(
                    array(
                        'poste' => $poste,
                        'ncin' => $ncin,
                        'email' => $email,
                        'tel' => $tel,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'contrat' => $contrat,
                        'id_personnel' => $id_p,
                        'date_n' => $date_n,
                        'etude' => $etude,
                        'adresse' => $adresse,
                        'salaire' => $salaire
                    )
            );
        } catch (Exception $e) {

            echo 'Erreur de requète : ', $e->getMessage();
        }

        return true;
    }

    public function select_departement() {
        $select = DataBase::connect()->query('select * from departement');

        echo "<select class='form-control' name='departement'>";
        while ($donnes = $select->fetch(PDO::FETCH_OBJ)) {
            $id_departement = $donnes->id_departement;
            $departement = $donnes->departement;


            echo "<option value=$id_departement>" . $departement . "</option>";
        }
        echo "</select>";
    }

    public function check_contrat($contrat) {


        echo "<select class='form-control' name='contrat'>";


        if ($contrat == "SIVP") {
            echo "<option selected value=SIVP>SIVP</option>";
            echo "<option  value=CDD>CDD</option>";
            echo "<option value=CDI>CDI</option>";
        }

        if ($contrat == "CDD") {
            echo "<option  value=SIVP>SIVP</option>";
            echo "<option selected value=CDD>CDD</option>";
            echo "<option value=CDI>CDI</option>";
        }

        if ($contrat == "CDI") {
            echo "<option  value=SIVP>SIVP</option>";
            echo "<option  value=CDD>CDD</option>";
            echo "<option selected value=CDI>CDI</option>";
        }
        echo "</select>";
    }

    public function check_etude($etude) {

        $tab = array("Doctorat", "Mastére", "Ingéniera", "Licence fendamentale", "Licence appliquée",
            "Technicien supérieur", "Technicien", "Baccalauréat +2", "Baccalauréat +1", "Baccalauréat"
            , "Secondaire", "Primaire");

        echo "<select class='form-control' name='niveau'>";

        foreach ($tab as $row) {
            if ($etude == $row) {
                echo "<option selected value=" . $row . ">" . $row . "</option>";
            } else {
                echo "<option value=" . $row . ">" . $row . "</option>";
            }
        }

        echo "</select>";
    }

    public function liste_personnel() {
        $select = DataBase::connect()->query("select * from personnel ORDER BY id_personnel DESC");

        while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
            $id_personnel = $donnees->id_personnel;
            $nom = $donnees->nom;
            $prenom = $donnees->prenom;
            $poste = $donnees->poste;
            $archive = $donnees->archive;
            if ($archive == 0) {
                echo "<tr>";
                echo "<td>";
                echo $id_personnel;
                echo "</td>";
                echo "<td>";
                echo $nom . " " . $prenom;
                echo "</td>";
                echo "<td>";
                echo $poste;
                echo "</td>";
                echo "<td>";
                echo "<a href='consulter_personnel.php?id=$id_personnel'>";
                echo " <img src='img/chercher.png' width='30' height='30'></img> </a>";
                echo "</td>";
                echo "<td>";
                echo "<a href='modifier_personnel.php?id=$id_personnel'>";
                echo " <img src='img/modif.jpg' width='30' height='30'></img> </a>";
                echo "</td>";
                echo "<td>";
                echo "<a href='archiver_personnel.php?id=$id_personnel'  onclick='if (confirm(&quot;Voulez vous vraiment archiver le Personnel: " . $nom . " " . $prenom . " ?&quot;)) { return true; } return false;'>";
                echo " <img src='img/archiver.png' width='30' height='30'></img> </a>";
                echo "</td>";
                echo "<td>";
                echo "<a href='supprimer_personnel.php?id=$id_personnel'  onclick='if (confirm(&quot;Voulez vous vraiment supprimer le Personnel: " . $nom . " " . $prenom . " ?&quot;)) { return true; } return false;'>";
                echo " <img src='img/del.png' width='30' height='30'></img> </a>";
                echo "</td>";
                echo "</tr>";
            }
        }
    }

    public function liste_personnel_pointage() {
        $select = DataBase::connect()->query("select * from personnel ORDER BY id_personnel DESC");

        while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
            $id_personnel = $donnees->id_personnel;
            $nom = $donnees->nom;
            $prenom = $donnees->prenom;
            $poste = $donnees->poste;
            $archive = $donnees->archive;
            $select_c = DataBase::connect()->query("select * from conge where id_personnel='$id_personnel'");
            $c = 0;
            if ($archive == 0) {
                echo "<tr>";
                echo "<td>";
                echo $id_personnel;
                echo "</td>";
                echo "<td>";
                echo $nom . " " . $prenom;
                echo "</td>";
                echo "<td>";
                echo $poste;
                echo "</td>";
                while ($donnees_c = $select_c->fetch(PDO::FETCH_OBJ)) {
                    $fin = $donnees_c->fin;
                    $debut = $donnees_c->debut;
                    $c = $c + 1;

                    if (($this->now > $fin) && ($this->now < $debut)) {
                        echo "<td>";
                        echo "Disponible";
                        echo "</td>";
                    } else {
                        echo "<td>";
                        echo "En congé";
                        echo "</td>";
                    }
                }
                if ($c == 0) {
                    echo "<td>";
                    echo "Disponible";
                    echo "</td>";
                }
                echo "<td>";
                echo "<a href='afficher_pointage.php?id=$id_personnel'>";
                echo " <img src='img/pointage.png' width='30' height='30'></img> </a>";
                echo "</td>";

                echo "</tr>";
            }
        }
    }

    public function liste_personnel_presence() {
        $select = DataBase::connect()->query("select * from personnel ORDER BY id_personnel DESC");

        while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
            $id_personnel = $donnees->id_personnel;
            $nom = $donnees->nom;
            $prenom = $donnees->prenom;
            $poste = $donnees->poste;
            $archive = $donnees->archive;
            if ($archive == 0) {
                echo "<tr>";
                echo "<td>";
                echo $id_personnel;
                echo "</td>";
                echo "<td>";
                echo $nom . " " . $prenom;
                echo "</td>";
                echo "<td>";
                echo $poste;
                echo "</td>";
                echo "<td>";
                echo "<a href='afficher_presence.php?id=$id_personnel'>";
                echo " <img src='img/presence.png' width='30' height='30'></img> </a>";
                echo "</td>";

                echo "</tr>";
            }
        }
    }

    public function liste_personnel_conge() {
        $select = DataBase::connect()->query("select * from personnel ORDER BY id_personnel DESC");

        while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
            $id_personnel = $donnees->id_personnel;
            $nom = $donnees->nom;
            $prenom = $donnees->prenom;
            $poste = $donnees->poste;
            $archive = $donnees->archive;
            $select_c = DataBase::connect()->query("select * from conge where id_personnel='$id_personnel'");
            $c = 0;
            if ($archive == 0) {
                echo "<tr>";
                echo "<td>";
                echo $id_personnel;
                echo "</td>";
                echo "<td>";
                echo $nom . " " . $prenom;
                echo "</td>";
                echo "<td>";
                echo $poste;
                echo "</td>";

                while ($donnees_c = $select_c->fetch(PDO::FETCH_OBJ)) {
                    $fin = $donnees_c->fin;
                    $debut = $donnees_c->debut;
                    $c = $c + 1;

                    if (($this->now > $fin) && ($this->now < $debut)) {
                        echo "<td>";
                        echo "Disponible";
                        echo "</td>";
                    } else {
                        echo "<td>";
                        echo "En congé";
                        echo "</td>";
                    }
                }
                if ($c == 0) {
                    echo "<td>";
                    echo "Disponible";
                    echo "</td>";
                }
                echo "<td>";
                echo "<a href='afficher_conge.php?id=$id_personnel'>";
                echo " <img src='img/conge.png' width='30' height='30'></img> </a>";
                echo "</td>";

                echo "</tr>";
            }
        }
    }

    public function select_personnel($id) {

        $select = DataBase::connect()->query("select * from personnel where id_personnel=$id");
        $liste = $select->fetchAll(PDO::FETCH_ASSOC);
        return $liste;
    }

    public function chercher_personnel($personnel) {


        $select = DataBase::connect()->query("select * from personnel where archive like '0' and (nom like '%$personnel%' or prenom like '%$personnel%' or np like '%$personnel%' or id_personnel='$personnel' or ncin like '%$personnel%')  ");
        if ($select->rowCount()> 0) {

            echo"<table class='table table-responsive table-bordered table-hover'>";
            echo "<thead>
		<tr>
		<th>Matricule </th><th>Nom & Prenom</th><th>Poste</th><th></th><th></th><th></th><th></th> 
		</tr>
		</tr>
		</thead>";
            while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
                $id_personnel = $donnees->id_personnel;

                $nom = $donnees->nom;
                $prenom = $donnees->prenom;
                $poste = $donnees->poste;
                $archive = $donnees->archive;
                if ($archive == 0) {
                    echo "<tr>";
                    echo "<td>";
                    echo $id_personnel;
                    echo "</td>";
                    echo "<td>";
                    echo $nom . " " . $prenom;
                    echo "</td>";
                    echo "<td>";
                    echo $poste;
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='consulter_personnel.php?id=$id_personnel'>";
                    echo " <img src='img/chercher.png' width='30' height='30'></img> </a>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='modifier_personnel.php?id=$id_personnel'>";
                    echo " <img src='img/modif.jpg' width='30' height='30'></img> </a>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='archiver_personnel.php?id=$id_personnel'  onclick='if (confirm(&quot;Voulez vous vraiment archiver le Personnel: " . $nom . " " . $prenom . " ?&quot;)) { return true; } return false;'>";
                    echo " <img src='img/archiver.png' width='30' height='30'></img> </a>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='supprimer_personnel.php?id=$id_personnel'  onclick='if (confirm(&quot;Voulez vous vraiment supprimer le Personnel: " . $nom . " " . $prenom . " ?&quot;)) { return true; } return false;'>";
                    echo " <img src='img/del.png' width='30' height='30'></img> </a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "<br><br><center><h3>Aucun résultat</center></h3>";
        }
    }

    public function archiver_personnel($id) {
        $archive = 1;
        $delete = DataBase::connect()->query("update personnel set archive=$archive where id_personnel=$id");
        if ($delete) {
            return true;
        }
    }

    public function chercher_personnel_presence($personnel) {
        $select = DataBase::connect()->query("select * from personnel  where archive like '0' and (nom like '%$personnel%' or np like '%$personnel%' or prenom like '%$personnel%' or id_personnel='$personnel' or ncin like '%$personnel%')  ");
        if ($select->rowcount() > 0) {

            echo"<table class='table table-responsive table-bordered table-hover'>";
            echo "<thead>
		<tr>
		<th>Matricule </th><th>Nom & Prenom</th><th>Poste</th><th>
		</tr>
		</thead>";
            while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
                $id_personnel = $donnees->id_personnel;

                $nom = $donnees->nom;
                $prenom = $donnees->prenom;
                $poste = $donnees->poste;
                $archive = $donnees->archive;
                if ($archive == 0) {
                    echo "<tr>";
                    echo "<td>";
                    echo $id_personnel;
                    echo "</td>";
                    echo "<td>";
                    echo $nom . " " . $prenom;
                    echo "</td>";
                    echo "<td>";
                    echo $poste;
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='afficher_presence.php?id=$id_personnel'>";
                    echo " <img src='img/presence.png' width='30' height='30'></img> </a>";
                    echo "</td>";

                    echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "<br><br><center><h3>Aucun résultat</center></h3>";
        }
    }

    public function chercher_personnel_conge($personnel) {


        $select = DataBase::connect()->query("select * from personnel  where archive like '0' and (nom like '%$personnel%' or np like '%$personnel%' or prenom like '%$personnel%' or id_personnel='$personnel' or ncin like '%$personnel%')  ");
        if ($select->rowcount() > 0) {

            echo"<table class='table table-responsive table-bordered table-hover'>";
            echo "<thead>
		<tr>
		<th>Matricule </th><th>Nom & Prenom</th><th>Poste</th><th></th><th></th>
		</tr>
		</thead>";
            while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
                $id_personnel = $donnees->id_personnel;

                $nom = $donnees->nom;
                $prenom = $donnees->prenom;
                $poste = $donnees->poste;
                $archive = $donnees->archive;
                $select_c = DataBase::connect()->query("select * from conge where id_personnel='$id_personnel'");
                $c = 0;
                if ($archive == 0) {
                    echo "<tr>";
                    echo "<td>";
                    echo $id_personnel;
                    echo "</td>";
                    echo "<td>";
                    echo $nom . " " . $prenom;
                    echo "</td>";
                    echo "<td>";
                    echo $poste;
                    echo "</td>";
                    while ($donnees_c = $select_c->fetch(PDO::FETCH_OBJ)) {
                        $fin = $donnees_c->fin;
                        $debut = $donnees_c->debut;
                        $c = $c + 1;

                        if (($this->now > $fin) && ($this->now < $debut)) {
                            echo "<td>";
                            echo "Disponible";
                            echo "</td>";
                        } else {
                            echo "<td>";
                            echo "En congé";
                            echo "</td>";
                        }
                    }
                    if ($c == 0) {
                        echo "<td>";
                        echo "Disponible";
                        echo "</td>";
                    }
                    echo "<td>";
                    echo "<a href='afficher_conge.php?id=$id_personnel'>";
                    echo " <img src='img/conge.png' width='30' height='30'></img> </a>";
                    echo "</td>";

                    echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "<br><br><center><h3>Aucun résultat</center></h3>";
        }
    }

    public function chercher_personnel_pointage($personnel) {


        $select = DataBase::connect()->query("select * from personnel  where archive like '0' and (nom like '%$personnel%' or np like '%$personnel%' or prenom like '%$personnel%' or id_personnel='$personnel' or ncin like '%$personnel%')  ");
        if ($select->rowcount() > 0) {

            echo"<table class='table table-responsive table-bordered table-hover'>";
            echo "<thead>
		<tr>
		<th>Matricule </th><th>Nom & Prenom</th><th>Poste</th><th></th><th>
		</tr>
		</thead>";
            while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
                $id_personnel = $donnees->id_personnel;

                $nom = $donnees->nom;
                $prenom = $donnees->prenom;
                $poste = $donnees->poste;
                $archive = $donnees->archive;
                $select_c = DataBase::connect()->query("select * from conge where id_personnel='$id_personnel'");
                $c = 0;
                if ($archive == 0) {
                    echo "<tr>";
                    echo "<td>";
                    echo $id_personnel;
                    echo "</td>";
                    echo "<td>";
                    echo $nom . " " . $prenom;
                    echo "</td>";
                    echo "<td>";
                    echo $poste;
                    echo "</td>";
                    while ($donnees_c = $select_c->fetch(PDO::FETCH_OBJ)) {
                        $fin = $donnees_c->fin;
                        $debut = $donnees_c->debut;
                        $c = $c + 1;

                        if (($this->now > $fin) && ($this->now < $debut)) {
                            echo "<td>";
                            echo "Disponible";
                            echo "</td>";
                        } else {
                            echo "<td>";
                            echo "En congé";
                            echo "</td>";
                        }
                    }
                    if ($c == 0) {
                        echo "<td>";
                        echo "Disponible";
                        echo "</td>";
                    }
                    echo "<td>";
                    echo "<a href='afficher_pointage.php?id=$id_personnel'>";
                    echo " <img src='img/pointage.png' width='30' height='30'></img> </a>";
                    echo "</td>";

                    echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "<br><br><center><h3>Aucun résultat</center></h3>";
        }
    }

    public function total_personnel() {
        $select = DataBase::connect()->query("select * from personnel where archive=0  ORDER BY id_personnel DESC");

        $nbr = $select->rowcount();

        return $nbr;
    }

    public function total_archive() {
        $select = DataBase::connect()->query("select * from personnel where archive=1  ORDER BY id_personnel DESC");

        $nbr = $select->rowcount();

        return $nbr;
    }

    public function affichage() {

        if (isset($_GET["message"])) {
            $msg = $_GET["message"];
            if ($msg == 'delete') {
                $message = "<div class='alert alert-success alert-dismissable'>
   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
      &times;
   </button>Supression avec succées</div>";
            }
            if ($msg == 'add') {

                $message = "<div class='alert alert-success alert-dismissable'>
   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
      &times;
   </button>Ajout avec succées</div>";
            }
            if ($msg == 'archive') {

                $message = "<div class='alert alert-success alert-dismissable'>
   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
      &times;
   </button>Archive avec succées</div>";
            }
            if ($msg == 'erreur') {

                $message = "<div class='alert alert-danger alert-dismissable'>
   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
      &times;
   </button>Suppression impossible </div>";
            }
            if ($msg == 'update') {

                $message = "<div class='alert alert-success alert-dismissable'>
   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
      &times;
   </button>Modification avec succées</div>";
            }
        } else {
            $message = "";
        }

        echo $message;
    }

    public function supprimer_personnel($id) {
        $select = DataBase::connect()->query("select count(*) as nbr from pointage where id_personnel=$id");
        while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
            $nbr = $donnees->nbr;
        }

        if ($nbr > 0) {
            return 0;
        }
        if ($nbr == 0) {
            $delete = DataBase::connect()->query("delete from personnel where id_personnel=$id");
            if ($delete) {
                return 1;
            }
        }
    }

}

?>