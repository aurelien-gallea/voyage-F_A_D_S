<?php
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage;charset=utf8", "root", "");
    if(isset($_POST['id']) && !empty($_POST['id'])) {
       $get_id = htmlspecialchars($_POST['id']);
       $articles = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
       $articles->execute(array($get_id));
       if($articles->rowCount() == 1) {
          $articles = $articles->fetch();
          $titre = $articles['titre'];
          $contenu = $articles['contenu'];
       } else {
          die('Cet article n\'existe pas...peut-être un jour ?');
       }
    } else {
       die('Erreur d\'affichage.');
    }
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <h1><?= $titre ?></h1>
       <p><?= $contenu ?></p>
    <body>
    <!DOCTYPE html>
<html>
<head>
  <title>Articles</title>
  <style>
    
  </style>
</head>
<body>
  <h1>Articles</h1>
  <?php
    // Connexion à la base de données
    $conn = mysqli_connect("mysql:host=127.0.0.1", "root", "", "dbname=blog_voyage;charset=utf8");

    // Requête SQL pour récupérer les articles
    $sql = "SELECT * FROM articles ORDER BY date DESC";
    $result = mysqli_query($conn, $sql);

    // Boucle pour afficher chaque article
    while ($article = mysqli_fetch_assoc($result)) {
      echo "<h2>" . $article['titre'] . "</h2>";
      echo "<p>" . $article['contenu'] . "</p>";
      echo "<p>Publié le " . $article['date'] . "</p>";
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($conn);
  ?>
</body>
</html>
