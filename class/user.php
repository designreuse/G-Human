<?php

require_once("DataBase.php");
require_once("crypt.php");

class user extends Crypt {

    public function __construct() {
        
    }

    public function inscription($email, $tel, $entreprise, $login, $pass, $rpass) {
        $insert = DataBase::connect()->prepare('insert into user VALUES
		(NULL,:email,:tel,:entreprise,:login,:pass)');
        try {
            $ins = $insert->execute(
                    array(
                        'email' => $email,
                        'tel' => $tel,
                        'entreprise' => $entreprise,
                        'login' => $login,
                        'pass' => $pass
                    )
            );
        } catch (Exception $e) {

            echo 'Erreur de requète : ', $e->getMessage();
        }

        return true;
    }

    public function select_id($login) {
        $select = DataBase::connect()->query("select * from user where login='$login'");
        while ($donnees = $select->fetch(PDO::FETCH_OBJ)) {
            $id = $donnees->id_user;
        }


        
        return $id;
    }

    public function login($login, $pass) {
        $pass = parent::encrypt($pass);
        $e = DataBase::connect()->query("select * from user where login='$login' and pass='$pass' ");
        $e = $e->rowCount();
        if ($e > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function changer_pass($npass, $login) {
        $npass = parent::encrypt($npass);
      

        $MODIFIER = DataBase::connect()->prepare('UPDATE user SET
pass=:pass where login=:login');

        try {

            $success = $MODIFIER->execute(array(
                'pass' => $npass,
                'login' => $login
            ));
        } catch (Exception $e) {

            echo 'Erreur de requète : ', $e->getMessage();
        }
        return true;
    }

    public function location($link) {

        header('Location: ' . $link);
    }

    public function value_session() {
        session_name('SESSION1');
        session_start();
        $data = array();
        $data['pass'] = $_SESSION['p'];
        $data['login'] = $_SESSION['l'];
        $data['id'] = $_SESSION['id'];


        return $data;
    }

    public function get_id() {

        session_name('SESSION1');
        session_start();

        $id_user = $_SESSION['id'];

        return $id_user;
    }

    public function logout() {

        session_name('K1Q');
        session_start();
        session_destroy();
        header('location:../');
    }

    public function acceder($log, $id_u) {

        session_name('SESSION1');

        $_SESSION['l'] = $log;
        $_SESSION['id'] = $id_u;
    }

    public function contact($email, $sujet, $texte) {

        $insert = DataBase::connect()->prepare('insert into contact 
VALUES (NULL,:email,:sujet,:texte)');

        try {

            $success = $insert->execute(array(
                'email' => $email,
                'sujet' => $sujet,
                'texte' => $texte
            ));
        } catch (Exception $e) {

            echo 'Erreur de requète : ', $e->getMessage();
        }
        return true;
    }

}

?>