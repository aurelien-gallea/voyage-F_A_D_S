<?php
//On fait croire que l'utilisateur est connecté
session_start();

if (!isset($_SESSION['id'])) {
	header('location:connexion.php');
	exit();
}

//pour les fonctions static
require("classes/update.php");
//on se connecte à la bdd
require("src/connectionDB.php");

$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id=?');

//Si on clique sur le bouton valider, on entre dans la boucle
if ('POST' == $_SERVER['REQUEST_METHOD']) {
	//Si les trois existent et on une valeur (donc pas null)
	if (isset($_POST['article_titre'], $_POST['article_contenu'], $_POST['categorie'])) {
		//Si on a bien rentré une valeur pour le contenu ET le titre et que si au moins une catégorie est choisie
		if (!empty($_POST['article_titre']) && !empty($_POST['article_contenu']) && ($_POST['categorie']) > 0) {

			//variable avec le contenu du titre et de l'article
			$article_titre = htmlspecialchars($_POST['article_titre']);
			$article_contenu = htmlspecialchars($_POST['article_contenu']);

			//Poste l'article par rapport à l'utilisateur
			$req = $bdd->prepare('INSERT INTO `articles` (`titre`, `article`, `id_utilisateur`) VALUES (?, ?, ?)');
			$req->execute(array($article_titre, $article_contenu, $_SESSION['id']));

			$lastID = $bdd->prepare('SELECT MAX(id) FROM articles');
			$lastID->execute();
			$idArticle = $lastID->fetch();

			//lie les catégories choisit à l'article
			update::deleteCatArt($idArticle);
			foreach ($_POST['categorie'] as $value) {
				$categorie = htmlspecialchars($value);
				Update::insertIntoCatArt($idArticle["MAX(id)"], $categorie);
			}

			header('location:creer-article.php?success=1');
			exit; //redirection pour empécher le renvoie du formulaire via f5 et bug
		} else {
			//Si le texte ou/et le titre/catégories ne sont pas rentrés, alors ça affiche une erreur
			header('location:creer-article.php?error=1');
			exit;
		}
	} else {
		//Si le texte ou/et le titre/catégories ne sont pas rentrés, alors ça affiche une erreur
		header('location:creer-article.php?error=1');
		exit;
	}
} ?>

<!----------------------------------- HTML --------------------------------->
<!DOCTYPE html>
<html lang="fr">

<!-- code pour le header -->

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" href="css/voyages.css">
	<link rel="stylesheet" href="css/stylefooter.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap" rel="stylesheet" />
	<title>Creez votre article</title>
	<script>
		tailwind.config = {
			darkMode: 'class',
			// ...
			content: [],
			theme: {
				extend: {
					colors: {
						'color-1': '#000F08',
						'color-2': '#1C3738',
						'color-3': '#4D4847',
						'color-4': '#F4FFF8',
						'color-5': '#8BAAAD',
					},
					opacity: {
						54: ".24",
					},
					fontFamily: {
						Unbounded: ['"Unbounded"'],
					},
				},
			},
		};
	</script>

	<script>
		// On page load or when changing themes, best to add inline in `head` to avoid FOUC
		if (
			localStorage.getItem("color-theme") === "dark" ||
			(!("color-theme" in localStorage) &&
				window.matchMedia("(prefers-color-scheme: dark)").matches)
		) {
			document.documentElement.classList.add("dark");
		} else {
			document.documentElement.classList.remove("dark");
		}
	</script>
</head>

<!-------------------------------------body------------------------------->

<body class="bg-color-4 dark:bg-color-1">

	<!----------------------------- Header ----------------------------------->
	<?php
	include 'src/header-blog.php';
	?>
	<!-------------------------------- Page -------------------------------------->
	<section class="flex-grow">
		<div class="mt-32 mb-10">
			<!---------------------- Formulaire d'article ---------------------->
			<div class="flex flex-col justify-center items-center">
				<article class="flex flex-col justify-center items-center">
					<h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-color-3">Creer un article</h2>
					<h5 class="ml-10 font-medium leading-tight text-xl mt-0 mb-2 text-color-5">Créez votre propre article ! Partagez vos voyages ou encore vos expériences culinaires exotiques !</H>
				</article>
				<form method="POST" class="mt-5 w-3/6 mt-25 flex flex-col content-center justify-center bg-color-2 shadow-md rounded px-8 pt-6 pb-8 mb-4 dark:bg-gray-900 dark:border-gray-700">
					<input type="text" name="article_titre" maxlength="80" class="block p-2.5 text-sm text-color-4 bg-color-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Titre" /><br />
					<textarea name="article_contenu" maxlength="5000" class="block p-2.5 w-full text-sm text-color-4 bg-color-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contenu de l'article..."></textarea><br />
					<!--Bouton catégorie avec le menu déroulant-->
					<button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-color-5 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Catégories<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
						</svg></button>
					<!-- Dropdown menu -->
					<div id="dropdownSearch" class="flex z-10 hidden bg-color-5 rounded-lg shadow w-60 dark:bg-gray-700">
						<?php update::listOfCategories(); ?>
					</div>
					<br>
					<br>
					<br>
					<input type="submit" value="Valider" class="bg-color-5 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" />
				</form>
			</div>


			<!----------------- Si article bien envoyé : ------------------->
			<?php
			if (isset($_GET['success']) && $_GET['success'] == 1) {
				$lastID = $bdd->prepare('SELECT MAX(id) FROM articles');
				$lastID->execute();
				$idArticle = $lastID->fetch();
				$message = '<a class="flex flex-col justify-center items-center font-medium leading-tight text-xl mt-0 mb-2 text-white bg-color-3" href="http://localhost/voyage-F_A_D_S/article.php?id=' . $idArticle["MAX(id)"] . '">Votre article est maintenant disponible sur le blog. Allons voir si quelqu\'un y a répondu !</a>';
				echo $message;
			}
			//Bouton aller sur l'article POST2
			elseif (isset($_GET['error']) && $_GET['error'] == 1) {
				$message2 = '<h3 class="flex flex-col justify-center items-center font-medium leading-tight text-xl mt-0 mb-2 text-red-600">Veuillez remplir tous les champs pour compléter la création de l\'article.</h2>';
				echo $message2;
			} ?>

		</div>
	</section>

	<!----------------------------------- Footer ------------------------------------>
	<?php
	include 'src/footer.php';
	?>
	<!-- code du dark mode -->
	<script>
		var themeToggleDarkIcon = document.getElementById(
			"theme-toggle-dark-icon"
		);
		var themeToggleLightIcon = document.getElementById(
			"theme-toggle-light-icon"
		);

		// Change the icons inside the button based on previous settings
		if (
			localStorage.getItem("color-theme") === "dark" ||
			(!("color-theme" in localStorage) &&
				window.matchMedia("(prefers-color-scheme: dark)").matches)
		) {
			themeToggleLightIcon.classList.remove("hidden");
		} else {
			themeToggleDarkIcon.classList.remove("hidden");
		}

		var themeToggleBtn = document.getElementById("theme-toggle");

		themeToggleBtn.addEventListener("click", function() {
			// toggle icons inside button
			themeToggleDarkIcon.classList.toggle("hidden");
			themeToggleLightIcon.classList.toggle("hidden");

			// if set via local storage previously
			if (localStorage.getItem("color-theme")) {
				if (localStorage.getItem("color-theme") === "light") {
					document.documentElement.classList.add("dark");
					localStorage.setItem("color-theme", "dark");
				} else {
					document.documentElement.classList.remove("dark");
					localStorage.setItem("color-theme", "light");
				}

				// if NOT set via local storage previously
			} else {
				if (document.documentElement.classList.contains("dark")) {
					document.documentElement.classList.remove("dark");
					localStorage.setItem("color-theme", "light");
				} else {
					document.documentElement.classList.add("dark");
					localStorage.setItem("color-theme", "dark");
				}
			}
		});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>