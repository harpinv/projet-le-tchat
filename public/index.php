<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Le tchat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>
   <header>
       <h1>Le tchat</h1>
       <div id="liens">
           <button class="bout"><a href="creer.php">Créer un pseudo</a></button>
           <button class="bout"><a href="connecter.php">Se connecter</a></button>
           <form action="../user/supprime.php" method="post" id="deconnecte">
               <button type="submit" name="submit" class="bout" id="supprime"> Se déconnecter</button>
           </form>
       </div>
   </header>
   <div>
       <h3>Messagere du tchat</h3>
       <?php
       $server = 'localhost';
       $user = 'root';
       $pwd = '';
       $db = 'mon tchat';

       try {
           //We connect to the database
           $connect = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

           //We prepare the request and execute it
           $message = $connect->prepare("
               SELECT message.text, message.date_publie, abonnee.pseudo
               FROM message
               INNER JOIN abonnee ON message.fk_abbonnee = abonnee.id
           ");

           $liste = $message->execute();

           //Results are displayed in div and paragraphs
           if($liste) {
               foreach ($message->fetchAll() as $user) {
                   echo "<div class='code'><p class='text'><span class='pseudo'>" . $user['pseudo'] . "</span>   " . $user['date_publie'] .  "</p><p class='text'>" . $user['text'] . "</p></div>";
               }
           }
       }
       catch (PDOException $exception) {
           echo "Erreur de connexion: " . $exception->getMessage();
       }
       ?>
   </div>
   <div id="bloc">
       <h3>Entrer un message</h3>
       <form action="../user/message.php" method="post">
           <textarea id="message" name="message"></textarea>
           <div>
               <button type="submit" name="button" id="submit">Valider</button>
           </div>
       </form>
   </div>
   <script src="methode.js"></script>
</body>
</html>



