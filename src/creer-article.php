<?php
	$bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage;charset=utf8", "root", "");
	if(isset($_POST['article_titre'], $_POST['article_contenu'])) {
	   if(!empty($_POST['article_titre']) && !empty($_POST['article_contenu'])) {
	      
	      $article_titre = htmlspecialchars($_POST['article_titre']);
	      $article_contenu = htmlspecialchars($_POST['article_contenu']);
	      $req = $bdd->prepare('INSERT INTO articles (titre, article, date_post) VALUES (?, ?, NOW())');
	      $req->execute(array($article_titre, $article_contenu));
	      $message = 'Votre article est maintenant disponible sur le blog. Allez voir si quelqu\'un y a répondu !';
	   } else {
	      $message = 'Veuillez remplir tous les champs pour compléter la création de l\'article.';
	   }
	}
	?>

	<!DOCTYPE html>
	<html>
	<head>
	   <title>Créer votre propre article !</title>
	   <meta charset="utf-8">
	</head>
	<body>
	   <form method="POST">
	      <input type="text" name="article_titre" placeholder="Titre" /><br />
	      <textarea name="article_contenu" placeholder="Contenu de l'article..."></textarea><br />
	      <input type="submit" value="Valider" />
	   </form>
	   <br />
	   <?php if(isset($message)) { echo $message; } ?>
	</body>
	</html>