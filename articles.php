<?php
// Connexion à la base de données
session_start();
try {
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage;charset=utf8", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$id = (int)$_POST['id'] ?? 0;
if ($id) {
    try {
        $stmt = $bdd->prepare('SELECT * FROM articles WHERE id = :id');
        $stmt->execute(['id' => $id]);
        if ($stmt->rowCount() == 1) {
            $article = $stmt->fetch();
            $titre = htmlspecialchars($article['titre']);
            $contenu = htmlspecialchars($article['contenu']);
        } else {
            throw new Exception('Cet article n\'existe pas...peut-être un jour ?');
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else {
    die('Erreur d\'affichage.');
}

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
    <title>Document</title>
</head>
<body>
    <h1><?= $titre ?></h1>
    <p><?= $contenu ?></p>

  <style>
  </style>
<body>
  <h1>Articles</h1>
</body>
</html>

