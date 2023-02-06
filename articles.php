<?php
session_start();
$id = 33;

$bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage;charset=utf8", "root", "");
$req = $bdd->prepare('SELECT * FROM articles WHERE id=?');

$req->execute([$id]);
$result = $req->fetch(); 
$titre = $result['titre'];
$article = $result['article'];
$date = $result['date'];

try {
    $stmt = $bdd->query('SELECT * FROM articles ORDER BY date DESC');
    $articles = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des articles : " . $e->getMessage());
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
        h1 {
            font-size: 45px;
            text-align: center;
            margin-top: 50px;
        }
        h2 {
            font-size: 29px;
            text-align: center;
            margin-top: 50px;
        }
        h3 {
            font-size: 10px;
            text-align: center;
            margin-top: 50px;
        }
        p {
            font-size: 25px;
            line-height: 1.5;
            padding: 20px;
            text-align: justify;
        }

        .articles {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 50px;
        }

        .article {
            width: 30%;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 50px;
            text-align: center;
        }

        .article h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .article p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .article span {
            font-size: 14px;
            color: #333;
            margin-bottom: 20px;
        }

        .article a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000f08;
            color: #f4fff8;
            border-radius: 25px;
            text-decoration: none;
        }
    </style>
    <h1><?= $titre ?></h1>
    <p><?= $article ?></p>

    <h1>Articles</h

  <div class="articles">
    <?php foreach ($articles as $article) : 
      ?>
        <div class="article">
            <h2><?= htmlspecialchars($article['titre']) ?></h2>
            <h3><?= htmlspecialchars($article['date']) ?></h3>
            <p><?= htmlspecialchars($article['article']) ?></p>

            <a href="#">Afficher plus</a>
        </div>
    <?php endforeach;
     ?>
  </div>
</body>
</html>


