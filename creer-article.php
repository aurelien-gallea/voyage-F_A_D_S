<?php
#On fait croire que l'utilisateur est connecté
session_start();
$id = 33;
#$_SESSION['login'] = $login;
require("classes/update.php");

$bdd = new PDO("mysql:host=localhost;dbname=blog_voyage;charset=utf8", "root", "");
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id=?');

$req->execute([$id]);
$result = $req->fetch();

$req2 = $bdd->prepare('SELECT id, nom FROM categories');
$req2->execute();

if (isset($_POST['article_titre'], $_POST['article_contenu'])) {
	if (!empty($_POST['article_titre']) && !empty($_POST['article_contenu'])) {

		$article_titre = htmlspecialchars($_POST['article_titre']);
		$article_contenu = htmlspecialchars($_POST['article_contenu']);
		$article_categorie = htmlspecialchars($_POST['article_categorie']);
		$req = $bdd->prepare('INSERT INTO articles (titre, article, date_post, id_utilisateur) VALUES (?, ?, NOW(), ?)');
		$req->execute(array($article_titre, $article_contenu, $id));

		// foreach($article_categorie as ) {
		// 	$req3= #$req = $bdd->prepare('INSERT INTO cat_art (id_art ,id_cat) VALUES (?, ?) ');
		// 	#$req3->execute(array($id, $));
		// }

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
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
	<title>Créér votre propre article</title>
</head>

<body>
	<form method="POST">
		<input type="text" name="article_titre" placeholder="Titre" /><br />
		<textarea name="article_contenu" placeholder="Contenu de l'article..."></textarea><br />
		
	<button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Catégories<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
		</svg></button>

	<!-- Dropdown menu 
	Je dois faire marcher la barre de recherche -->
	<div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
		<div class="p-3">
			<label for="input-group-search" class="sr-only">Recherche</label>
			<div class="relative">
				<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
					<svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
					</svg>
				</div>
				<input type="text" id="input-group-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Recherchez une catégorie">
			</div>
		</div>
		<ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
			<?php
			$compteur = $req2->rowCount();
			$arrayCat = [];
			while ($ligne = $req2->fetch(PDO::FETCH_ASSOC)) {
				array_push($arrayCat, $ligne);
			}
			for ($i = 0; $i < count($arrayCat); $i++) {
				echo "<li>";
				echo '<div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">';
				$compteur--;
			?>
				<input id="checkbox-item-<?=$i?>" type="checkbox" name="categorie[]" value="<?= $arrayCat[$i]['id'] ?>" class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500'>
				<label for="checkbox-item-<?=$i?>" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"><?= $arrayCat[$i]['nom'] ?></label>
			<?php }
			echo '</div>';
			echo "</li>";
			?>
		</ul>
	</div>
	<br>
		<input type="submit" value="Valider" />
	</form>

	<?php var_dump($arrayCat);
	var_dump($i); ?>

	<?php if (isset($message)) {
		echo $message;
	} ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>