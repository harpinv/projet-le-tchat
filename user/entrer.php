<?php
session_start();
//We check that there is no open session
if(!isset($_SESSION['pseudo']) && !isset($_SESSION['password'])) {
    //We check that the variables of the form exist
    if(isset($_POST['pseudo']) && isset($_POST['password'])) {
        $server = 'localhost';
        $user = 'root';
        $pwd = '';
        $db = 'mon tchat';

        try {
            //We connect to the database
            $connect = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

            //We prepare the request and execute it
            $entrer = $connect->prepare("
                SELECT id, pseudo, password FROM abonnee
            ");

            $liste = $entrer->execute();

            if($liste) {
                //We retrieve the elements of the table thanks to a foreach loop and we store them in variables
                foreach ($entrer->fetchAll() as $user) {
                    $id = $user['id'];
                    $pseudo = $user['pseudo'];
                    $password = $user['password'];
                    //We compare the stoker values in the variables and the values enter in the form
                    if ($pseudo == $_POST['pseudo'] && $password == $_POST['password']) {

                        //We log in with the values of the form
                        $timeOfSession = time() + (60 * 60 * 24);


                        setcookie(session_name(), session_id(), $timeOfSession);

                        $_SESSION['id'] = $id;
                        $_SESSION['pseudo'] = $_POST['pseudo'];
                        $_SESSION['password'] = $_POST['password'];
                    }
                }
            }

            //We check that the session has been created
            if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
                //We create a redirect to a confirmation page
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = '../public/confirmation2.php';
                header("Location: http://$host$uri/$extra");
            }
            else {
                echo "identifient ou mots de passe incorrect";
            }
        }
        catch (PDOException $exception) {
            echo "Erreur de connexion: " . $exception->getMessage();
        }
    }
    else {
        echo "Erreur: une des valeurs est manquante";
    }
}
else {
    echo "Vous étes déjà connecté";
}