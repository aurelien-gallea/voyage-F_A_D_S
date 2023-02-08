<?php
#On fait croire que l'utilisateur est connecté
session_start();

if(!isset($_SESSION['id'])) {
    header('location:connexion.php');
    exit();
}

require("classes/update.php");

//on se connecte à la bdd
$bdd = new PDO("mysql:host=localhost;dbname=blog_voyage;charset=utf8", "root", "");
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id=?');

//Si le titre et le contenu ont été rempli alors ça envoie l'article dans la bdd
if (isset($_POST['article_titre'], $_POST['article_contenu'], $_POST['categorie'])) {
	if (!empty($_POST['article_titre']) && !empty($_POST['article_contenu']) && !empty($_POST['categorie'])) {

		$article_titre = htmlspecialchars($_POST['article_titre']);
		$article_contenu = htmlspecialchars($_POST['article_contenu']);
		//Poste l'article 
		$req = $bdd->prepare('INSERT INTO articles (titre, article, date_post, id_utilisateur) VALUES (?, ?, NOW(), ?)');
		$req->execute(array($article_titre, $article_contenu, $_SESSION['id']));

		$lastID = $bdd->lastInsertId();
		foreach ($_POST['categorie'] as $value) {
			$categorie = htmlspecialchars($value);
			Update::insertIntoCatArt($lastID, $categorie);
		}

		$message = 'Votre article est maintenant disponible sur le blog. Allons voir si quelqu\'un y a répondu !';
	}
	else { //Si le texte ou/et le titre ne sont pas rentrés, alors ça affiche une erreur
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
	<form method="POST"> <!-- formulaire d'envoi-->
		<input type="text" name="article_titre" placeholder="Titre" /><br />
		<textarea name="article_contenu" placeholder="Contenu de l'article..."></textarea><br />
		<!--Bouton catégorie avec le menu déroulant-->
		<button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Catégories<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
			</svg></button>
		<!-- Dropdown menu Je dois faire marcher la barre de recherche -->
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
			<?php update::listOfCategories(); ?>
		</div>
		<br>
		<input type="submit" value="Valider" />
	</form>

	<?php if (isset($message)) {
		echo $message;
	} ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>