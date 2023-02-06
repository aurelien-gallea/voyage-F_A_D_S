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
            font-size: 35px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            text-align: center;
            margin-top: 10px;
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
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
        }

        .article h2 {
            font-size: 24px;
            font-family: "Gill Sans", sans-serif;
            margin-bottom: 20px;
            text-align: center;
        }
        .article h3 {
            font-size: 14px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif, serif;
            margin-bottom: 10px;
            text-align: right;
        }

        .article p {
            font-size: 16px;
            font-family: Georgia, serif;
            line-height: 1.5;
            margin-bottom: 20px;
            text-align: left;
        }

        .article span {
            font-size: 14px;
            color: #333;
            margin-bottom: 20px;
        }

        .article a {
            font-size: 18px;
            display: inline-block;
            padding: 1px 5px;
            background-color: #000f08;
            color: #f4fff8;
            border-radius: 5px;
            text-decoration: none;
        }
        
    </style>
    <h1><?= $titre ?></h1>
    <p><?= $article ?></p>

    <h1>Articles</h

  <div class="articles">
  </div>
    <?php foreach ($articles as $article) : 
      ?>
        <div class="article">
            <h2><?= htmlspecialchars($article['titre']) ?></h2>
            <h3><?= htmlspecialchars($article['date']) ?></h3>
            <p><?= htmlspecialchars($article['article']) ?></p>

            
        </div>
    <?php endforeach;
     ?>
  </div>
</body>
</html>


