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