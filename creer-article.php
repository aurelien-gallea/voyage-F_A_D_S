<?php
#On fait croire que l'utilisateur est connecté
session_start();
$id = 33;
#$_SESSION['login'] = $login;

$bdd = new PDO("mysql:host=localhost;dbname=blog_voyage;charset=utf8", "root", "");
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id=?');

$req->execute([$id]);
$result = $req->fetch();

$req2 = $bdd->prepare('SELECT id, nom FROM categories');
$req2->execute();
#$result2 = $req2->fetchAll();
#var_dump($result2);

if (isset($_POST['article_titre'], $_POST['article_contenu'])) {
	if (!empty($_POST['article_titre']) && !empty($_POST['article_contenu'])) {

		$article_titre = htmlspecialchars($_POST['article_titre']);
		$article_contenu = htmlspecialchars($_POST['article_contenu']);
		#article_categorie = htmlspecialchars($_POST['article_categorie']);
		$req = $bdd->prepare('INSERT INTO articles (titre, article, date_post, id_utilisateur) VALUES (?, ?, NOW(), ?)');
		#en front on le mettra en fr
		$req->execute(array($article_titre, $article_contenu, $id));

		#$req = $bdd->prepare('INSERT INTO cat_art (id_art ,id_cat) VALUES (?, ?)');
		#$req->execute(array($id, $));

		$message = 'Votre article est maintenant disponible sur le blog. Allons voir si quelqu\'un y a répondu !';
	} else {
		$message = 'Veuillez remplir tous les champs pour compléter la création de l\'article.';
	}
}; ?>

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

	<br>

		<?php
		$compteur = $req2->rowCount();
		$arrayCat = [];
		while ($ligne = $req2->fetch(PDO::FETCH_ASSOC)) {
			array_push($arrayCat, $ligne);
		}
		while ($compteur > 0) {
			echo "<select>";
			echo "<option value=''> </option>";
			$compteur--;
		for ($i = 0 ; $i < count($arrayCat) ; $i++) {
		echo "<option name=" . $arrayCat[$i]['id'] . " value='" . $arrayCat[$i]['id'] . "'>" . $arrayCat[$i]['nom'] . "</option>";
		}
		echo "</select>";
	}
		?>

	<br />
	<?php if (isset($message)) {
		echo $message;
	} ?>
</body>

</html>