<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>connecter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Le tchat</h1>
</header>
<div class="page">
    <h3>Se connecter</h3>
    <form action="../user/entrer.php" method="post">
        <div class="formule">
            <label for="pseudo">Pseudo:</label>
            <input type="text" name="pseudo" id="pseudo">
        </div>
        <div class="formule">
            <label for="password">password:</label>
            <input type="text" name="password" id="password">
        </div>
        <div>
            <button type="submit" name="button" id="submit">Valider</button>
        </div>
    </form>
</div>
</body>
</html>
