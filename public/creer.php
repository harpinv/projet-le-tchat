<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Créer un pseudo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <header>
       <h1>Le tchat</h1>
   </header>
   <div class="page">
       <h3>Créer un pseudo</h3>
       <form action="/user/nouveau.php" method="post">
           <div class="formule">
               <label for="nom">Nom:</label>
               <input type="text" name="nom" id="nom">
           </div>
           <div class="formule">
               <label for="prenom">Prénom:</label>
               <input type="text" name="prenom" id="prenom">
           </div>
           <div class="formule">
               <label for="pseudo">Pseudo:</label>
               <input type="text" name="pseudo" id="pseudo">
           </div>
           <div class="formule">
               <label for="password">password:</label>
               <input type="text" name="password" id="password">
           </div>
           <div>
               <button type="submit" name="button" id="submit">Enregistrer</button>
           </div>
       </form>
   </div>
</body>
</html>

