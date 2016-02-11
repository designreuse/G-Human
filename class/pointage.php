<?php

require_once("DataBase.php");

class pointage {

    public $now;
    public $mois;

    function __construct() {
        $this->now = date("Y-m-d");
        $this->mois = date("m", strtotime($this->now));
        $this->annes = date("Y", strtotime($this->now));
        $this->jour = date("d", strtotime($this->now));
        $this->day = date("l", strtotime($this->now));
    }

    public function day($day) {
        switch ($day) {
            case "Monday":
                $day = "Lundi";
                break;
            case "Tuesday":
                $day = "Mardi";
                break;
            case "Wednesday":
                $day = "Mercredi";
                break;
            case "Thursday":
                $day = "Jeudi";
                break;
            case "Friday":
                $day = "Vendredi";
                break;
            case "Saturday":
                $day = "Samedi";
                break;
            case "Sunday":
                $day = "Dimanche";
                ;
                break;
        }
        return $day;
    }

    public function liste_pointage($id) {
        $select = DataBase::connect()->query("select * from pointage where id_personnel=$id ORDER BY id_pointage DESC");
        $row = $select->rowCount();
        if ($row > 0) {

            echo " <table class='table table-responsive table-bordered table-hover' id='tab'>
        <thead>
            <tr>
                <td>Jour</td><td>Date</td><td>Heur d'entrée</td> <td>Heur de sortie</td> <td></td>
            </tr>
        </thead>
        <tbody>";
            while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
                $id_pointage = $donnees->id_pointage;
                $date_t = $donnees->date_t;
                $heur_e = $donnees->heur_e;
                $heur_s = $donnees->heur_s;
                $day = $donnees->day;
                $id_personnel = $donnees->id_personnel;

                echo"<tr>";
                echo"<td>";
                echo $day;
                echo"</td>";
                echo"<td>";
                echo $date_t;
                echo"</td>";

                echo"<td>";
                echo $heur_e;
                echo"</td>";


                echo"<td>";
                if ($heur_s != "00:00:00") {
                    echo $heur_s;
                }
                echo"</td>";

                echo "<td>";
                echo "<a href='supprimer_pointage.php?id=$id_pointage&id_personnel=$id_personnel'   onclick='if (confirm(&quot;Voulez vous vraiment supprimer le Pointage ? &quot;)) { return true; } return false;'>";
                echo " <img src='img/del.png' width='30' height='30'></img> </a>";
                echo "</td>";
                echo"</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<center><h3>Aucun pointage</h3></center>";
        }
    }

    public function pointage_entre($id, $heur_e) {
        $date = $this->now;
        $ndate = $date[8] . $date[9] . "/" . $date[5] . $date[6] . "/" . $date[0] . $date[1] . $date[2] . $date[3];
        $date = $ndate;
        $jour = $this->jour;
        $day = $this->day($this->day);

        $insert = DataBase::connect()->prepare('insert into pointage VALUES
		(NULL,:date_t,:day,:jour,:mois,:annes,:heur_e,:heur_s,:id_personnel)');
        try {
            $ins = $insert->execute(
                    array(
                        'date_t' => $date,
                        'day' => $day,
                        'jour' => $jour,
                        'mois' => $this->mois,
                        'annes' => $this->annes,
                        'heur_e' => $heur_e,
                        'heur_s' => '',
                        'id_personnel' => $id
                    )
            );
        } catch (Exception $e) {

            echo 'Erreur de requète : ', $e->getMessage();
        }

        return true;
    }

    public function dernier_pointage($id) {
        $select = DataBase::connect()->query("select * from pointage where id_personnel=$id  ORDER BY id_pointage DESC limit 1");
        while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
            $id_pointage = $donnees->id_pointage;
        }

        return $id_pointage;
    }

    public function pointage_sortie($id_pointage, $heur_s) {

        $update = DataBase::connect()->prepare("update pointage SET
		heur_s=:heur_s where id_pointage=:id_pointage");
        try {
            $upd = $update->execute(
                    array(
                        'heur_s' => $heur_s,
                        'id_pointage' => $id_pointage
                    )
            );
        } catch (Exception $e) {

            echo 'Erreur de requète : ', $e->getMessage();
        }

        return true;
    }

    public function supprimer_pointage($id) {
        $delete = DataBase::connect()->query("delete from pointage where id_pointage=$id");
        if ($delete) {
            return true;
        }
    }

    public function total_heur($id_user) {
        $nbr_h = 0;
        $select = DataBase::connect()->query("select *,sum(heur_s-heur_e) as nbr  from pointage as p inner join personnel as pl on p.id_personnel=pl.id_personnel  ORDER BY id_pointage DESC");
        while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
            $id_pointage = $donnees->id_pointage;
            $date_t = $donnees->date_t;
            $heur_e = $donnees->heur_e;
            $heur_s = $donnees->heur_s;
            $nbr = $donnees->nbr;
            $mois = $donnees->mois;
        }
    }

    public function nbrDaysMonth() {
        return $this->mois == 2 ? ($this->annes % 4 ? 28 : ($this->annes % 100 ? 29 : ($this->annes % 400 ? 28 : 29))) : (($this->mois - 1) % 7 % 2 ? 30 : 31);
    }

    public function selectItemsO($i) {
        $sql = Database::connect()->query("select * from jour_travail where jour =$i");
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $value) {
                echo"<tr>";
                $day = $value["day"];
                $jour = $value["jour"];
                $mois = $value["mois"];
                $annes = $value["annes"];
                echo"<td>";
                echo $day;
                echo"</td>";
                echo"<td>";
                echo $jour . "/" . $mois . "/" . $annes;
                echo"</td>";
                echo "<td><img src='img/oui.png' width='30' height='30'></img></td>";
                echo"</tr>";
            }
        }
    }

    public function selectItemsN($i) {
        $sql = Database::connect()->query("select * from jour_travail where jour =$i");
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $value) {
                echo "<tr>";
                $day = $value["day"];
                $jour = $value["jour"];
                $mois = $value["mois"];
                $annes = $value["annes"];
                echo"<td>";
                echo $day;
                echo"</td>";
                echo"<td>";
                echo $jour . "/" . $mois . "/" . $annes;
                echo"</td>";
                echo "<td><img src='img/non.png' width='30' height='30'></img></td>";
                echo"</tr>";
            }
        }
    }

    public function selectJourTravail($id) {
        $select = DataBase::connect()->query("select * from pointage where id_personnel=$id and mois like '$this->mois' and annes like '$this->annes' ORDER BY id_pointage DESC");
        $liste = array();
        if ($select->rowCount() > 0) {
            while ($ligne = $select->fetch(PDO::FETCH_OBJ)) {
                $liste[] = $ligne->jour;
            }
        }
        return $liste;
    }

    public function afficher_presence($id) {
        $liste = $this->selectJourTravail($id);
        $total_jour = 0;
        for ($i = 1; $i <= $this->nbrDaysMonth(); $i++) {
            $date = "$this->annes" . "-" . $this->mois . "-" . $i;
            $day = date("l", strtotime($date));
            $day = $this->day($day);
            $max = max($liste);

            echo"<tr>";
            echo "<td>";
            echo $day;
            echo "</td>";
            echo "<td>";
            echo $i . "/" . $this->mois . "/" . $this->annes;
            echo "</td>";
            echo"</td>";

            if (in_array($i, $liste)) {
                $total_jour++;
                echo "<td><img src='img/oui.png' width='30' height='30'></img></td>";
            } else {
                if ($day == "Dimanche") {
                    echo "<td class='np'></td>";
                } else {
                    if ($i > $max) {
                        echo "<td></td>";
                    } else {
                        echo "<td><img src='img/non.png' width='30' height='30'></img></td>";
                    }
                }
            }

            echo"</tr>";
        }


        $request = Database::connect()->query("select * from pointage where mois like '$this->mois' and annes like '$this->annes' and id_personnel=$id");
        $total = 0;
        if ($request->rowCount()) {
            while ($point = $request->fetch(PDO::FETCH_OBJ)) {
                $heur_e = $point->heur_e;
                $heur_s = $point->heur_s;
                $total = $total + (($heur_s - $heur_e) - 2);
            }
        }
        echo"<tr class=total>";
        echo"<tr class=total>";
        echo "<td colspan=2>";
        echo "Total herues";
        echo "</td>";
        echo "<td>";
        echo $total;
        echo "</td>";
        echo"</tr>";
        echo"<tr class=total>";
        echo"<tr class=total>";
        echo "<td colspan=2>";
        echo "Total jours";
        echo "</td>";
        echo "<td>";
        echo $total_jour;
        echo "</td>";
        echo"</tr>";
    }

    public function filtre_presence($mois, $annes, $id) {

        $select = DataBase::connect()->query("select * from pointage where id_personnel=$id and mois like '$mois' and annes like '$annes' ORDER BY id_pointage DESC");
        if ($select->rowCount() > 0) {

            while ($ligne = $select->fetch(PDO::FETCH_OBJ)) {
                $liste[] = $ligne->jour;
            }
        }

        $sql = Database::connect()->query("select * from jour_travail where mois=$mois and annes like '$annes' ");
        if ($mois != "" || $annes != "") {
            if ($sql->rowCount() > 0) {
                echo "<table class='table table-responsive table-bordered' id='liste_s'>
		<thead>
		<tr>
		<th>Jour</th><th>Date</th><th></th>
		</tr>
		</thead>";

                $total_jour = 0;
                while ($donnees = $sql->fetch(PDO::FETCH_OBJ)) {
                    $day = $donnees->day;
                    $jour = $donnees->jour;
                    $mois = $donnees->mois;
                    $annes = $donnees->annes;
                    echo"<tr>";
                    echo"<td>";
                    echo $day;
                    echo"</td>";
                    echo"<td>";
                    echo $jour . "/" . $mois . "/" . $annes;
                    echo"</td>";

                    if ($select->rowCount() == 0) {
                        echo "<td><img src='img/cn.png' width='30' height='30'></img></td>";
                    } else {
                        if (in_array($donnees->jour, $liste)) {
                            $total_jour = $total_jour + 1;
                            echo "<td><img src='img/ok.png' width='30' height='30'></img></td>";
                        } else {
                            echo "<td><img src='img/cn.png' width='30' height='30'></img></td>";
                        }
                    }

                    echo"</tr>";
                }
                $request = Database::connect()->query("select * from pointage where mois like '$mois' and annes like '$annes' and id_personnel=$id");
                $total = 0;
                while ($point = $request->fetch(PDO::FETCH_OBJ)) {
                    $heur_e = $point->heur_e;
                    $heur_s = $point->heur_s;
                    $total = $total + (($heur_s - $heur_e) - 2);
                }
                echo"<tr class=total>";
                echo"<tr class=total>";
                echo "<td colspan=2>";
                echo "Total herues";
                echo "</td>";
                echo "<td>";
                echo $total;
                echo "</td>";
                echo"</tr>";
                echo"<tr class=total>";
                echo"<tr class=total>";
                echo "<td colspan=2>";
                echo "Total jours";
                echo "</td>";
                echo "<td>";
                echo $total_jour;
                echo "</td>";
                echo"</tr>";
            } else {
                echo "<center><br><br><h3>Aucun résultat</h3></center>";
            }
        }
    }

    public function liste_jour_travail() {

        $select = Database::connect()->query("select jour from jour_travail where mois=$this->mois");
        $liste = array();
        echo "  <table class='table table-responsive table-bordered'>
        <thead>
            <tr>
                <th>Jour</th><th>Date</th><th>Jour de travail</th>
            </tr>
        </thead>
        <tbody>";
        while ($ligne = $select->fetch(PDO::FETCH_OBJ)) {
            $liste[] = $ligne->jour;
        }

        $mois = array('1', '3', '5', '7', '8', '10', '12');
        $moisx = array('4', '6', '9', '11');

        if (in_array($this->mois, $mois)) {
            $x = 32;
        }
        if (in_array($this->mois, $moisx)) {
            $x = 31;
        }
        if ($this->mois == 2) {
            $x = 30;
        }

        for ($i = 1; $i < $x; $i++) {

            echo"<tr>";
            echo "<td>";

            if ($i < 10) {
                $i = "0" . $i;
            }
            $date = "$this->annes" . "/" . $this->mois . "/" . $i;

            $day = date("l", strtotime($date));
            $day = $this->day($day);
            echo $day;

            echo "</td>";
            echo "<td>";
            $ndate = $date[8] . $date[9] . "/" . $date[5] . $date[6] . "/" . $date[0] . $date[1] . $date[2] . $date[3];
            $date = $ndate;
            echo $date;
            echo "</td>";

            if ($day == "Dimanche") {
                echo "<td class='np'></td>";
            } else {
                if ($i <= $this->jour) {

                    if (in_array($i, $liste)) {
                        echo "<td><img src='img/oui.png' width='30' height='30'></img></td>";
                    } else {
                        if ($i == $this->jour) {
                            echo "<td></td>";
                        } else {
                            echo "<td><img src='img/non.png' width='30' height='30'></img></td>";
                        }
                    }
                } else {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
        }
        echo "<tbody></table>";
    }

    public function chercher_liste_jour_travail($moisx, $annesx) {
        if ($moisx != "" && $annesx != "") {
            $where = " where";
            $c = 0;
            if ($moisx != "") {
                $where = $where . "  mois like '$moisx' ";
                $c++;
            }
            if ($annesx != "") {
                if ($c > 0) {
                    $where = $where . " and annes like '$annesx' ";
                } else {
                    $where = $where . "  annes like '$annesx' ";
                }
                $c++;
            }

            if ($c == 0) {
                $where = " ";
            }

            $sql = "select jour from jour_travail" . $where;
            $select = Database::connect()->query($sql);
            $liste = array();
            echo "  <table class='table table-responsive table-bordered'>
        <thead>
            <tr>
                <th>Jour</th><th>Date</th><th>Jour de travail</th>
            </tr>
        </thead>
        <tbody>";
            while ($ligne = $select->fetch(PDO::FETCH_OBJ)) {
                $liste[] = $ligne->jour;
            }

            $mois_31 = array('1', '3', '5', '7', '8', '10', '12');
            $mois_30 = array('4', '6', '9', '11');

            if (in_array($moisx, $mois_31)) {
                $x = 32;
            }
            if (in_array($moisx, $mois_30)) {
                $x = 31;
            }

            if ($moisx == 02) {
                $x = 30;
            }

            for ($i = 1; $i < $x; $i++) {

                echo"<tr>";
                echo "<td>";

                if ($i < 10) {
                    $i = "0" . $i;
                }


                $date = "$this->annes" . "/" . $this->mois . "/" . $i;

                $day = date("l", strtotime($date));

                $day = $this->day($day);
                echo $day;

                echo "</td>";
                echo "<td>";
                $ndate = $date[8] . $date[9] . "/" . $date[5] . $date[6] . "/" . $date[0] . $date[1] . $date[2] . $date[3];
                $date = $ndate;
                echo $date;
                echo "</td>";

                if ($day == "Dimanche") {
                    echo "<td class='np'></td>";
                } else {



                    if ($moisx == $this->mois && $annesx == $this->annes) {
                        $max = max($liste);
                        if ($i <= $max) {
                            if (in_array($i, $liste)) {
                                echo "<td><img src='img/oui.png' width='30' height='30'></img></td>";
                            } else {
                                echo "<td>2<img src='img/non.png' width='30' height='30'></img></td>";
                            }
                        } else {
                            echo "<td></td>";
                        }
                    } else {
                        if (in_array($i, $liste)) {
                            echo "<td><img src='img/oui.png' width='30' height='30'></img></td>";
                        } else {
                            echo "<td><img src='img/non.png' width='30' height='30'></img></td>";
                        }
                    }


                    echo "</tr>";
                }
            }
            echo "<tbody></table>";
        }
    }

    public function jour() {

        $now = date("Y-m-d");
        $mois = date("m", strtotime($now));
        $annes = date("Y", strtotime($now));
        $jour = date("d", strtotime($now));
        $day = date("l", strtotime($now));
        $day = $this->day($day);


        $NomDuMois = array('01' => "janvier", '02' => "février", '03' => "mars", '04' => "avril",
            '05' => "mai", '06' => "juin", '07' => "juillet", '08' => "août", '09' => "septembre", '10' => "octobre", '11' => "novembre", '12' => "décembre");

        echo $day . " " . $jour . " " . $NomDuMois[$mois] . " " . $annes;
    }

    public function pointage_travail($day, $jour, $mois, $annes) {
        $day = $this->day($day);
        $insert = DataBase::connect()->prepare('insert into jour_travail VALUES
		(NULL,:day,:jour,:mois,:annes)');
        try {
            $ins = $insert->execute(
                    array(
                        'day' => $day,
                        'jour' => $jour,
                        'mois' => $mois,
                        'annes' => $annes
                    )
            );
        } catch (Exception $e) {

            echo 'Erreur de requète : ', $e->getMessage();
        }

        return true;
    }

}

?>