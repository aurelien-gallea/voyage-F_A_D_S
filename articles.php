<?php
session_start();
$id = 33; 

$bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage;charset=utf8", "root", "");

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  try {
      $stmt = $bdd->prepare('SELECT * FROM articles WHERE id=?');
      $stmt->execute(array($id));
      $article = $stmt->fetch();
  } catch (PDOException $e) {
      die("Erreur lors de la récupération de l'article : " . $e->getMessage());
  }
}

try {
    // Requête pour récupérer les articles
    $stmt = $bdd->query('SELECT * FROM articles ORDER BY date DESC');
    $articles = $stmt->fetchAll();
    

    
} catch (PDOException $e) {
    die("Erreur lors de la récupération des logins : " . $e->getMessage());

 }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
<style>
        /* Ajoutez une couleur de fond pour le conteneur d'articles */
        .articles {
            background-color: #f2f2f2;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 50px;
        }

        /* Ajoutez une bordure pour les articles individuels */
        .article {
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
            background-color: #fff;
            margin: 0 auto;
        }

        /* Modifiez la taille de police et la police pour le titre de l'article */
        h1 {
            font-size: 35px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            text-align: center;
            margin-top: 10px;

        }
        .article h2 {
            font-size: 24px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin-bottom: 20px;
            text-align: center;
        }
        
        /* Modifiez la couleur du texte pour la date */
        .article h3 {
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            margin-bottom: 10px;
            text-align: right;
            color: #333;
        }

         /* Modifiez la couleur du texte pour le nom d'utilisateur */
         .article h4 {
            font-size: 18px;
            font-family: 'Georgia', sans-serif;
            margin-bottom: 10px;
            text-align: left;
            color: #333;
        }

        /* Modifiez la taille de police et la police pour le contenu de l'article */
        .article p {
            font-size: 16px;
            font-family: Georgia, serif;
            line-height: 1.5;
            margin-bottom: 20px;
            text-align: left;
        }

        /* Modifiez la couleur de fond pour le bouton "Afficher plus" */
        .article a {
            font-size: 18px;
            display: grid;
            padding: 5px 10px;
            background-color: #006699;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }
</style>

    <br>
    <br>
    <br>
    <h1>Articles</h1>
     <br>
  <div class="articles">
  </div>
    <?php foreach ($articles as $article) : 
    // Requête pour récupérer les logins des utilisateurs
    $user = $bdd->prepare('SELECT login FROM utilisateurs WHERE id= ?');
    $user->execute([$article['id_utilisateur']]);
    $result = $user->fetch();

      ?>
         <div class="article">
            <h2><?= htmlspecialchars($article['titre']) ?></h2>
            <h3><?= htmlspecialchars($article['date']) ?></h3>
            <h4><?= htmlspecialchars($result['login']) ?></h4>
            <p><?= htmlspecialchars($article['article']) ?></p>

            <a href="article.php?id=<?= $article['id'] ?>">Afficher plus</a>
        </div>
    <?php endforeach;
     ?>
  </div>
</body>
</html>


