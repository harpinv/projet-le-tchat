<?php
session_start();

//We verify that a session is open
if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
    //We check that the user has written a message
    if(isset($_POST['message'])) {
        //We check that the size of the message does not exceed 3000 characters
        if(strlen($_POST['message']) < 3001) {
            //We create a function to clean up the data
            function sanitize($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                $data = addslashes($data);
                return $data;
            }

            $server = 'localhost';
            $user = 'root';
            $pwd = '';
            $db = 'mon tchat';

            try {
                //We connect to the database
                $connect = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

                //We create the variables of the query and we delete the content of the second variable
                $id = $_SESSION['id'];
                $text = sanitize($_POST['message']);

                //We prepare the request and execute it
                $message = $connect->prepare("
                    INSERT INTO message (text, fk_abbonnee)
                    VALUES (:text, :id)
                ");

                $message->bindParam(':text', $text);
                $message->bindParam(':id', $id);

                $message->execute();

                //We create a redirect to go back to the main page
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = '../public/index.php';
                header("Location: http://$host$uri/$extra");
            }
            catch (PDOException $exception) {
                echo "Erreur de connexion: " . $exception->getMessage();
            }
        }
        else {
            echo "Erreur: La taille du texte dépasse la taille maximum autorisé";
        }
    }
    else {
        echo "Erreur: il n'y a pas de texte";
    }
}
else {
    echo "Vous n'étes pas connecté";
}