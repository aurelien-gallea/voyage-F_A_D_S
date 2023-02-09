<?php
//On fait croire que l'utilisateur est connecté
session_start();

if (!isset($_SESSION['id'])) {
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
		$req = $bdd->prepare('INSERT INTO articles (titre, article, id_utilisateur) VALUES (?, ?, ?)');
		$req->execute(array($article_titre, $article_contenu, $_SESSION['id']));

		//lie les catégories choisit à l'article
		$lastID = $bdd->lastInsertId();
		foreach ($_POST['categorie'] as $value) {
			$categorie = htmlspecialchars($value);
			Update::insertIntoCatArt($lastID, $categorie);
		}
		header('location:creer-article.php?success=1');
		exit; //redirection pour empécher le renvoie du formulaire via f5 et bug
		//
	} else { //Si le texte ou/et le titre/catégories ne sont pas rentrés, alors ça affiche une erreur
		header('location:creer-article.php?success=0');
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

	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="css/voyages.css">
	<link rel="stylesheet" href="css/stylefooter.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@0.2.28/bundled/lenis.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
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
	<style>
		.bg-custom-1C3738 {
			background-color: #1c3738;
		}

		.bg-custom-F4FFF8 {
			background-color: #f4fff8;
		}
	</style>
</head>

<!-------------------------------------body------------------------------->

<body>

	<!----------------------------- Header ----------------------------------->
	<?php
	include 'src/header.php';
	?>
	<!-------------------------------- Page -------------------------------------->
	<section class="flex-grow">
		<div class="mt-32 mb-10">
			<!---------------------- Formulaire d'article ---------------------->
			<form method="POST">
				<input type="text" name="article_titre" maxlength="80" placeholder="Titre" /><br />
				<textarea name="article_contenu" maxlength="5000" placeholder="Contenu de l'article..."></textarea><br />
				<!--Bouton catégorie avec le menu déroulant-->
				<button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Catégories<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
					</svg></button>
				<!-- Dropdown menu -->
				<div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
					<?php update::listOfCategories(); ?>
				</div>
				<br>
				<br>
				<br>
				<input type="submit" value="Valider" />
			</form>

			<!----------------- Si article bien envoyé : ------------------->
			<?php
			if (isset($_GET['success']) && $_GET['success'] == 1) {
				$message = 'Votre article est maintenant disponible sur le blog. Allons voir si quelqu\'un y a répondu !';
				echo $message;
				//Bouton aller sur l'article et bouton retourner au blog
				//Bouton creer un nouvel article ?
			} elseif (isset($_GET['success']) && $_GET['success'] == 0) { 		
				$message2 = 'Veuillez remplir tous les champs pour compléter la création de l\'article.';
				echo $message2;
				}?>

			<article>
				<p>
					blop
				</p>
			</article>
		</div>
	</section>

	<!----------------------------------- Footer ------------------------------------>
	<footer class="fixed inset-x-0 bottom-0 bg-white rounded-lg shadow md:px-6 md:py-8 dark:bg-gray-900">
		<div class="sm:flex sm:items-center sm:justify-between">
			<a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0">
				<img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo" />
				<span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
			</a>
			<ul class="flex flex-wrap items-center mb-6 text-sm text-gray-500 sm:mb-0 dark:text-gray-400">
				<li>
					<a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
				</li>
				<li>
					<a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
				</li>
				<li>
					<a href="#" class="mr-4 hover:underline md:mr-6 ">Licensing</a>
				</li>
				<li>
					<a href="#" class="hover:underline">Contact</a>
				</li>
			</ul>
		</div>
		<hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
		<span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 3 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.
		</span>
	</footer>
	<!-- code du footer -->
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