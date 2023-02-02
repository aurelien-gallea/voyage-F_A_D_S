<?php
#On fait croire que l'utilisateur est connecté
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login'] = "elis";
}

$bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage;charset=utf8", "root", "");
if (isset($_POST['article_titre'], $_POST['article_contenu'])) {
	if (!empty($_POST['article_titre']) && !empty($_POST['article_contenu'])) {

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
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Créér votre propre article</title>
</head>

<body>
	<form method="POST">
		<input type="text" name="article_titre" placeholder="Titre" /><br />
		<textarea name="article_contenu" placeholder="Contenu de l'article..."></textarea><br />
		<input type="submit" value="Valider" />
	</form>
	<br />
	<?php if (isset($message)) {
		echo $message;
	} ?>
</body>

</html>