<?php
session_start();

require('src/connectionDB.php');
require_once('classes/Verify.php');
require_once('classes/Security.php');
require_once('classes/Update.php');
require_once('classes/Date.php');
// on vérifie que l'utilisateur est bien un admin
if (isset($_SESSION['id'])) {
    $adminStatus = Update::selectStatusByUser($_SESSION['id']);
    if ($adminStatus['droits'] != 'admin') {
        header('location:articles.php');
        exit();
    }
} else {
    header('location:connexion.php');
    exit();
}

// on recupère un tableau des tous les utilisateurs avec leur droits
$arrayUsers = [];
$arrayUsers = Update::selectAllUsers($arrayUsers);
$arrayStatus = [];
$arrayStatus = Update::selectAllStatusByUser($arrayStatus);
$arrayCats = [];
$arrayCats = Update::allCategories($arrayCats);

for ($z = 0; $z < count($arrayUsers); $z++) {

    // on supprime l'utilisateur

    if (isset($_POST['delete']) && $_POST['delete'] == "user-" . $arrayUsers[$z]['id']) {
        $delete = htmlspecialchars($_POST['delete']);
        Update::deleteUser($arrayUsers[$z]['id']);
        header('location:admin.php?success=5');
        exit();

        // on modifie des droits et/ou son login

    } else if (isset($_POST['confirm']) && $_POST['confirm'] == "user-" . $arrayUsers[$z]['id']) {
        $newLogin = htmlspecialchars($_POST['login-' . $arrayUsers[$z]['id']]);

        // doublon login SI changement
        if ($newLogin != $arrayUsers[$z]['login']) {

            if (Verify::loginAlreadyExist($newlogin)) { // on verifie l'existence du doublon dans la bdd
                header('location:admin.php?error=4&message=login déjà existant');
                exit();
            }
        }

        // si un bouton radio est coché on change le rôle de l'utilisateur
        if (!empty($_POST['droits'])) {
            $newRole;
            if ($_POST['droits'] == "admin") {
                $newRole = "admin";
            } else if ($_POST['droits'] == "moderateur") {
                $newRole = "moderateur";
            } else {
                $newRole = "membre";
            }
            Update::updateStatus($newRole, $arrayUsers[$z]['id']);
        }
        // MAJ des infos
        Update::updateUser($newLogin, $arrayUsers[$z]['id']);
        header('location:admin.php?success=5');
        exit();
    }
}
// les catégories ---------------------------------------------------

// ajouter une catégorie ----------------------------------------
if (isset($_POST['addNew']) && $_POST['addNew'] == "cat") {
    $newCat = htmlspecialchars($_POST['addCat']);
    Update::addNewCat($newCat);
    header('location:admin.php?success=5');
    exit();
}
for ($c = 0; $c < count($arrayCats); $c++) {
    // on supprime la catégorie

    if (isset($_POST['delete']) && $_POST['delete'] == 'cat-' . $arrayCats[$c]['id']) {
        $delete = htmlspecialchars($_POST['delete']);
        Update::deleteCategorie($arrayCats[$c]['id']);
        header('location:admin.php?success=5');
        exit();

        // on modifie le nom de la catégorie

    } else if (isset($_POST['confirm']) && $_POST['confirm'] == 'cat-' . $arrayCats[$c]['id']) {
        $newCatName = htmlspecialchars($_POST['catName-' . $arrayCats[$c]['id']]);
        if ($newCatName != $arrayCats[$c]['nom']) {
            Update::updateCatName($newCatName, $arrayCats[$c]['id']);
            header('location:admin.php?success=5');
            exit();
        }
    }
}

// articles ---------------------------------------------------------
// les stats et les articles --------------------------------------------------------------------------
$stats = $bdd->prepare('SELECT * FROM articles');
$stats->execute();
$count = $stats->rowCount();


$arrayArt = []; // on initialise un array vide pour le remplir avec les articles
$arrayCat = []; // meme chose pour les catégories
$arrayComs = []; // pour les commentaires
$commentaries = Update::selectAllComments($arrayComs);
$nbComs = count($commentaries);

// commentaires ---------------------------------------------------------------

for ($d = 0; $d < count($commentaries); $d++) {
    // on supprime le commentaire

    if (isset($_POST['delete']) && $_POST['delete'] =='com-' . $commentaries[$d]['id']) {
        $delete = htmlspecialchars($_POST['delete']);
        Update::deleteCom($commentaries[$d]['id']);
        header('location:admin.php?success=5');
        exit();

        // on modifie le commentaire

    } else if (isset($_POST['confirm']) && $_POST['confirm'] == 'com-' . $commentaries[$d]['id']) {
        $newCom = htmlspecialchars($_POST['newCom-' . $commentaries[$d]['id']]);
        if ($newCom != $commentaries[$d]['id']) {
            Update::updateCom($newCom, $commentaries[$d]['id']);
            header('location:admin.php?success=5');
            exit();
        }
    }
}
// message et actions en cas de modificiation / suppression -------------------------------------
while ($articles = $stats->fetch(PDO::FETCH_ASSOC)) {
    // on push les donnees deja existantes dans un tableau pour pouvoir header à ce niveau et echo plus bas
    array_push($arrayArt, $articles);

    // on supprime le message
    if (isset($_POST['delete']) && $_POST['delete'] == $articles['id']) {
        $delete = htmlspecialchars($_POST['delete']);
        Update::deleteArticleModeration($delete);
        header('location:admin.php?success=3');
        exit();

        // on met à jour le message
    } else if (isset($_POST['confirm']) && $_POST['confirm'] == $articles['id']) {
        $titre = htmlspecialchars($_POST['titre-' . $articles['id']]);
        $article = htmlspecialchars($_POST[$articles['id']]);

        Update::updateArticleModeration($titre, $article, $articles['id']);
        // si des checkbox sont cochées pour changer les catégories ont met à jours celles-ci
        if (!empty($_POST['categorie'])) {
            Update::deleteCatArt($articles['id']);
            foreach ($_POST['categorie'] as $value) {
                $categorie = htmlspecialchars($value);
                Update::insertIntoCatArt($articles['id'], $categorie);
            }
        }
        header('location:admin.php?success=4');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/stylefooter.css">
    <link rel="stylesheet" href="css/tailwind-need.css">
    <script src="src/tailwind-need.js"></script>
    <link href="assets/favicon.ico" rel="icon" type="image/x-icon" />

    <title>Panel Admin</title>
</head>

<body class="min-h-screen flex flex-col dark:bg-color-1">
    <?php require_once('src/header-blog.php'); ?>

    <section>
        <h1 class="font-unbounded mt-32 text-center text-4xl dark:text-color-4"> Panel Admin</h1>
        <div class="container mx-auto mt-4 text-color-3 dark:text-color-4 flex flex-col items-center bg-color-5 dark:bg-color-3 md:w-2/4 2xl:w-1/4 md:rounded-md">
            <span class="text-center text-3xl m-5 font-light ">Les stats du blog</span>
            <span class="text-2xl pb-5">articles écrits : <?php if (isset($count)) echo $count; ?> </span>
            <span class="text-2xl pb-5">commentaires écrits : <?php if (isset($arrayComs)) echo $nbComs; ?> </span>
        </div>
    </section>
    <section>
        <?php
        if (isset($_GET['success'])) { ?>
            <div class="container p-3 mt-3 text-white text-lg mx-auto flex flex-col items-center text-center bg-green-500 md:w-2/4 2xl:w-1/4 md:rounded-md">

                <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
                    <p>Login / Email mis à jour !</p>
                <?php } else if (isset($_GET['success']) && $_GET['success'] == 2) { ?>
                    <p>Mot de passe mis à jour !</p>
                <?php } else if (isset($_GET['success']) && $_GET['success'] == 3) { ?>
                    <p>Article supprimé !</p>
                <?php } else if (isset($_GET['success']) && $_GET['success'] == 4) { ?>
                    <p>Article mis à jour !</p>
                <?php } else if (isset($_GET['success']) && $_GET['success'] == 5) { ?>
                    <p>données mises à jour !</p>
            </div>
    <?php }
            } ?>
    <?php
    if (isset($_GET['error'])) { ?>
        <div class="container p-3 mt-3 text-white text-lg mx-auto flex flex-col items-center text-center  bg-color-3 md:w-2/4 2xl:w-1/4 md:rounded-md">

            <?php if (isset($_GET['error']) && $_GET['error'] == 1) { ?>
                <p>Mot de passe incorrect</p>
            <?php } else if (isset($_GET['error']) && $_GET['error'] == 2) { ?>
                <p>Les mots de passe ne correspondent pas</p>
            <?php } else if (isset($_GET['error']) && $_GET['error'] >= 4) { ?>
                <p> <?= $_GET['message'] ?></p>
            <?php } ?>
        </div>
    <?php } ?>

    </section>

    <form class="flex-grow" action="admin.php" method="post">
        <section>

            <div class="bg-color-3 ">
                <div class="container mx-auto m-4 text-white p-2 gap-2  flex flex-col md:flex-row justify-center items-center">
                    <h2 class="font-unbounded text-2xl">Les utilisateurs :</h2>
                    <span class="menus mx-4 p-2 rounded border cursor-pointer bg-color-5 dark:bg-color-1">Ouvrir menu</span>
                </div>
                <div class="menu-content container mx-auto my-2  p-2  flex flex-col md:w-1/2 ">


                    <?php
                    for ($i = 0; $i < count($arrayUsers); $i++) {


                    ?>
                    <div class="border rounded my-4 text-white">

                        <div class="text-white bg-color-3 dark:bg-color-1 ">
                            <div class="flex flex-col md:flex-row gap-5 justify-between  container p-3">
                                <h3>ID : <span class="text-yellow-500"> <?= $arrayUsers[$i]['id'] ?> </span></h3>
                                <p>login : <span class="<?= Update::printStatus($arrayStatus[$i]['droits'])?>"> <?= $arrayUsers[$i]['login'] ?> </span></p>
                                <span> email : <?= $arrayUsers[$i]['email'] ?></span>
                                <p>Droits: <span class="<?= Update::printStatus($arrayStatus[$i]['droits'])?>"><?= $arrayStatus[$i]['droits'] ?></span></p>
                            </div>
                            
                        </div>
                        <hr>
                        <div>
                            <div class="btnContainer flex justify-center gap-10 container p-3">
                                <button class="update border rounded p-3 hover:bg-color-5" type="submit" name="update" value="<?= $arrayUsers[$i]['id'] ?>">modifier droits</button>
                                <button class="delete border rounded p-3 hover:bg-red-800" type="submit" name="delete" value="<?= "user-" . $arrayUsers[$i]['id'] ?>">Supprimer </button>
                            </div>
                            
                        </div>
                        <!-- bloc pour maj utilisateurs -->
                        <div class="artChange  mt-5 hidden p-2">
                            
                            <div class="gap-5 mb-2">
                                <label for="categories"> changer les droits ? (cochez la case correspondante) :</label>
                                <div>
                                    <ul>
                                        <li><input type="radio" name="droits" value="membre" id="membre"><label class="px-2" for="membre">Membre</label></li>
                                        <li><input type="radio" name="droits" value="moderateur" id="moderateur"><label class="px-2" for="moderateur">Moderateur</label></li>
                                        <li><input type="radio" name="droits" value="admin" id="admin"><label class="px-2" for="admin">Admin</label></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row gap-2 mb-2">
                                <label for="<?= $arrayUsers[$i]['login'] ?>">Login:</label>
                                <input class="dark:bg-color-1 text-black dark:text-white p-1 rounded" maxlength="15" type="text" name="<?= 'login-' . $arrayUsers[$i]['id'] ?>" value="<?= $arrayUsers[$i]['login'] ?>">
                            </div>
                            <div class="flex justify-between  container p-3">
                                <button class="cancelBtn border rounded p-3 hover:text-black hover:dark:bg-color-1 hover:dark:text-white" type="submit" name="cancel">Annuler</button>
                                <button class="confirmBtn border rounded p-3 hover:bg-green-500" type="submit" name="confirm" value="<?= "user-" . $arrayUsers[$i]['id'] ?>">Confirmer</button>
                            </div>
                        </div>
                    </div>
                    <?php  } ?>
                </div>
            </div>
            <div class="bg-color-3">
                <div class="container mx-auto m-4 text-white p-2 gap-2  flex flex-col md:flex-row justify-center items-center">
                    <h2 class="font-unbounded text-2xl">Les catégories :</h2>
                    <span class="menus mx-4 p-2 rounded border cursor-pointer bg-color-5 dark:bg-color-1">Ouvrir menu</span>
                </div>

                <div class="menu-content container mx-auto my-2  p-2  flex flex-col md:w-1/2 ">
                    <div class="flex flex-wrap text-white items-center gap-5 my-2">
                        <label for="addCat">Ajouter une catégorie :</label>
                        <input type="text" name="addCat" class=" text-black dark:text-white dark:bg-color-1">
                        <button type="submit" class=" border p-2 rounded hover:bg-green-500" name="addNew" value="cat">Ajouter</button>
                        
                    </div>
                    <?php
                    // on affiche les catégories ------------------------------------------
                    for ($i = 0; $i < count($arrayCats); $i++) { ?>
                    <div class="border rounded my-4">

                        <div class="text-white ">
                            
                            <div class="flex bg-color-3 dark:bg-color-1 gap-5 justify-between  container p-3">
                                <h3>ID : <span class="text-red-500"> <?= $arrayCats[$i]['id'] ?> </span></h3>
                                <p>Nom : <span class="text-blue-500"> <?= $arrayCats[$i]['nom'] ?> </span></p>
                            </div>
                            <hr>
                            <div class="btnContainer flex justify-center gap-10 container p-3">
                                <button class="update border rounded p-3 hover:bg-color-5" type="submit" name="update" value="<?= $arrayCats[$i]['id'] ?>">Modifier</button>
                                <button class="delete border rounded p-3 hover:bg-red-800" type="submit" name="delete" value="<?= 'cat-' . $arrayCats[$i]['id'] ?>">Supprimer</button>
                            </div>
                        </div>
                        <!-- bloc pour maj categories -->
                        <div class="artChange  mt-5 hidden p-2">
                            <div class="flex flex-col md:flex-row gap-3 mb-2 text-white">
                                <label for="<?= $arrayCats[$i]['id'] ?>">Changer le nom :</label>
                                <input class="text-black dark:text-white dark:bg-color-1 p-1 rounded" type="text" name="<?= 'catName-' . $arrayCats[$i]['id'] ?>" value="<?= $arrayCats[$i]['nom'] ?>">
                            </div>
                            
                            <div class="flex justify-between  gap-10 container p-3 text-white">
                                <button class="cancelBtn border rounded p-3 hover:text-black hover:dark:bg-color-1 hover:dark:text-white" type="submit" name="cancel">Annuler</button>
                                <button class="confirmBtn border rounded p-3 hover:bg-green-500" type="submit" name="confirm" value="<?= 'cat-' . $arrayCats[$i]['id'] ?>">Confirmer</button>
                            </div>
                        </div>
                    </div>
                    <?php  } ?>

                </div>
            </div>
            <div class="bg-color-3 text-white">
                <div class="container mx-auto m-4  p-2 gap-2  flex flex-col md:flex-row justify-center items-center">
                    <h2 class="font-unbounded text-2xl">Les articles :</h2>
                    <span class="menus mx-4 p-2 rounded border cursor-pointer bg-color-5 dark:bg-color-1">Ouvrir menu</span>
                </div>
                <div class="menu-content container mx-auto m-4  p-2  flex flex-col md:w-1/2  ">

                    <?php

                    // on affiche les articles qu'on a push précédemment dans un tableau
                    for ($i = 0; $i < count($arrayArt); $i++) {
                        // association de la catégorie à l'article
                        $newArray = Update::associateCatName($arrayArt[$i]['id'], $arrayCat);
                        // affichage de l'auteur de l'article
                        $username = $bdd->prepare('SELECT id, login FROM utilisateurs WHERE id=?');
                        $username->execute([$arrayArt[$i]['id_utilisateur']]);
                        $result = $username->fetch();
                        $status = $bdd->prepare('SELECT nom FROM droits WHERE id_utilisateur=?');
                        $status->execute([$result['id']]);
                        $statusByUser = $status->fetch();
                    ?>
                    <div class="border rounded my-4">
                        <div class="artContainer text-white bg-color-3 dark:bg-color-1">
                            <div class="flex flex-col  gap-3 flex-wrap justify-between container p-3">
                                <h3 class="text-xl mb-2">Titre : <?= $arrayArt[$i]['titre'] ?></h3>
                                <div class="flex flex-wrap gap-1 items-center">catégories:<?php
                                                for ($k = 0; $k < count($newArray); $k++) {
                                                    echo '<small class="mx-2 p-2 bg-color-5 rounded">' . $newArray[$k] . '</small>';
                                                }
                                                ?> </div>
                            </div>
                            <hr>
                            <p class="break-all  p-3"><?= $arrayArt[$i]['article'] ?></p>
                            <hr>
                            <div class="text-right"> dernière modification le : <?= DateToFr::dateFR($arrayArt[$i]['date']);  ?> par <span class="<?= Update::printStatus($statusByUser['nom']) ?>"><?= $result['login'] ?></span></div>
                            <hr>
                        </div>
                        <div >
                            <div class="btnContainer flex justify-center gap-10  container p-3">
                                <button class="update border rounded p-3 hover:bg-color-5" type="submit" name="update" value="<?= $arrayArt[$i]['id'] ?>">modifier article</button>
                                <button class=" border rounded p-3 hover:bg-red-800" type="submit" name="delete" value="<?= $arrayArt[$i]['id'] ?> ">Supprimer article</button>
                            </div>

                        </div>
                        <!-- bloc pour maj article -->
                        <div class="artChange  mt-5 hidden p-2 ">

                            <div class="gap-5 mb-2 ">
                                <label for="categories "> changer vos catégories ? (cochez les cases correspondantes) :</label>
                                <button id="dropdownSearchButton-<?= $arrayArt[$i]['id'] ?>" data-dropdown-toggle="dropdownSearch-<?= $arrayArt[$i]['id'] ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-color-5 rounded-lg hover:opacity-90  focus:outline-none  dark:bg-color-1 dark:hover:opacity-90" type="button">Catégories<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
						            </svg></button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownSearch-<?= $arrayArt[$i]['id'] ?>" class="flex z-10 bg-amber-600 rounded-lg shadow w-60 dark:bg-gray-700 hidden" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(592.727px, 455.455px, 0px);" data-popper-placement="bottom">
                                    <?php Update::listOfCategories(); ?>
                                    </div>
                            </div>
                            <div class="flex flex-col gap-3 mb-2">
                                <label for="<?= $arrayArt[$i]['titre'] ?>">Titre :</label>
                                <input class="text-black dark:text-white dark:bg-color-1 p-1 rounded" maxlength="80" type="text" name="<?= 'titre-' . $arrayArt[$i]['id'] ?>" value="<?= $arrayArt[$i]['titre'] ?>">
                            </div>
                            <div class="flex flex-col gap-3 mb-8">
                                <label for="<?= $arrayArt[$i]['id'] ?>">article :</label>
                                <textarea class="text-black dark:text-white dark:bg-color-1 p-1 rounded w-full h-80" maxlength="5000"  name="<?= $arrayArt[$i]['id'] ?>"><?= $arrayArt[$i]['article'] ?></textarea>
                            </div>
                            <div class="flex  justify-between  container p-3">
                                <button class="cancelBtn border rounded p-3 hover:text-black hover:dark:bg-color-1 hover:dark:text-white" type="submit" name="cancel">Annuler</button>
                                <button class="confirmBtn border rounded p-3 hover:bg-green-500" type="submit" name="confirm" value="<?= $arrayArt[$i]['id'] ?>">Confirmer</button>
                            </div>
                        </div>
                    </div>
                    <?php

                    } ?>
                </div>
            </div>
        </section>
        <section>
            <div class="bg-color-3 text-white">
                <div class="container mx-auto m-4  p-2 gap-2  flex flex-col md:flex-row justify-center items-center">
                    <h2 class="font-unbounded text-2xl">Les Commentaires :</h2>
                    <span class="menus mx-4 p-2 rounded border cursor-pointer bg-color-5 dark:bg-color-1">Ouvrir menu</span>
                </div>
                <div class="menu-content container mx-auto flex flex-col md:w-1/2">
                    <span> Cliquez sur le commentaire pour être redirigé vers la page de  l'article</span>
                    <?php
                    // on affiche les commentaires qu'on a push précédemment dans un tableau
                    
                    for ($i = 0; $i < $nbComs; $i++) {

                        // affichage de l'auteur du commentaire et ses droits associés
                        $username = $bdd->prepare('SELECT id, login FROM utilisateurs WHERE id=?');
                        $username->execute([$commentaries[$i]['id_utilisateur']]);
                        $author = $username->fetch(); 
                        $status = $bdd->prepare('SELECT nom FROM droits WHERE id_utilisateur=?');
                        $status->execute([$author['id']]);
                        $statusByUser = $status->fetch();

                        
                        ?>
                    <div class="border rounded my-4">
                        <a href="article.php?id=<?= $commentaries[$i]['id_article'] ?>">
                            <div class="artContainer text-white bg-color-3 dark:bg-color-1 hover:bg-white hover:text-black">
                                <div class="flex flex-col justify-between  container p-3">
                                    <p><span class="<?=Update::printStatus($statusByUser['nom']) ?>"> <?= $author['login']  ?></span> a posté le commentaire suivant le : <?=DateToFr::dateFR($commentaries[$i]['date'])  ?></p>
                                    <p> <?= $commentaries[$i]['commentaire'] ?></p>
                                </div>
                                <hr>
                            </div>
                        </a>
                        <div class="btnContainer flex justify-center gap-10  container p-3">
                            <button class="update border rounded p-3 hover:bg-color-5" type="submit" name="update" value="<?=$commentaries[$i]['id']?>">Modifier</button>
                            <button class="delete border rounded p-3 hover:bg-red-800" type="submit" name="delete" value="<?='com-' . $commentaries[$i]['id']?>">Supprimer</button>
                        </div>
                         <!-- bloc pour maj commentaires -->
                         <div class="artChange  mt-5 hidden p-2">
                            <div class="flex flex-col md:flex-row gap-2 mb-2">
                                <label for="<?= $commentaries[$i]['id'] ?>">Changer le commentaire:</label>
                                <textarea  class="text-black dark:text-white dark:bg-color-1 p-1 rounded w-full h-60" maxlength="1024" type="text" name="<?='newCom-' . $commentaries[$i]['id']?>"><?= $commentaries[$i]['commentaire']?></textarea> 
                            </div>

                            <div class="flex justify-between gap-5 container p-3">
                                <button class="cancelBtn border rounded p-3 hover:text-black hover:dark:bg-color-1 hover:dark:text-white" type="submit" name="cancel">Annuler</button>
                                <button class="confirmBtn border rounded p-3 hover:bg-green-500" type="submit" name="confirm" value="<?='com-' . $commentaries[$i]['id']?>">Confirmer</button>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

        </section>
    </form>
    <?php require_once('src/footer.php'); ?>
    <script src="src/admin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="src/tailwind-need-body.js"></script>
</body>
</html>