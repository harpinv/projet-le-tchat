<?php
//We check that all the variables of the formulare exist
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pseudo']) && isset($_POST['password'])) {
    //We check that the size of the variables does not exceed 20 characters
    if(strlen($_POST['nom']) < 21 && strlen($_POST['prenom']) < 21 && strlen($_POST['pseudo']) < 21 && strlen($_POST['password']) < 21) {
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

            $nom = sanitize($_POST['nom']);
            $prenom = sanitize($_POST['prenom']);
            $pseudo = sanitize($_POST['pseudo']);
            $password = sanitize($_POST['password']);

            //We prepare the request and execute it
            $creer = $connect->prepare("
                    INSERT INTO abonnee (name, firstname, pseudo, password)
                    VALUES (:nom, :prenom, :pseudo, :password)
                ");

            $creer->bindParam(':nom', $nom);
            $creer->bindParam(':prenom', $prenom);
            $creer->bindParam(':pseudo', $pseudo);
            $creer->bindParam(':password', $password);

            $creer->execute();

            //We create a redirect to a confirmation page
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = '../public/confirmation.php';
            header("Location: http://$host$uri/$extra");
        }
        catch (PDOException $exception) {
            echo "Erreur de connexion: " . $exception->getMessage();
        }
    }
    else {
        echo "Erreur: une des chaine de caractère est trop longue";
    }
}
else {
    echo "Erreur: une des valeurs est manquante";
}
