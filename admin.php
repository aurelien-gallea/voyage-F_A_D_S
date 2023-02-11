<?php
session_start();

require('src/connectionDB.php');
require_once('classes/Verify.php');
require_once('classes/Security.php');
require_once('classes/Update.php');

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
$status = Update::selectStatusByUser(32);
$status = $status['droits'];

// $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id=?');
// $req->execute([$id]);
// $result = $req->fetch();
// $login = $result['login'];
// $email = $result['email'];

for ($z = 0; $z < count($arrayUsers); $z++) {

    // on supprime l'utilisateur

    if (isset($_POST['delete']) && $_POST['delete'] == "user-" . $arrayUsers[$z]['id']) {
        $delete = htmlspecialchars($_POST['delete']);
        Update::deleteUser($arrayUsers[$z]['id']);
        header('location:admin.php?success=30');
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
        header('location:admin.php?success=' . $newRole . $arrayUsers[$z]['id'] . $newLogin . $arrayUsers[$z]['login']);
        exit();
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/stylefooter.css">
    <link rel="stylesheet" href="css/voyages.css">
    <title>Panel Admin</title>
</head>
<?php require_once('src/header-blog.php'); ?>

<body>

    <section>
        <h1 class="mt-32 text-center text-4xl"> Panel Admin</h1>
        <div class="container mx-auto mt-4 flex flex-col items-center bg-color-2 md:w-2/4 2xl:w-1/4 md:rounded-b-md">
            <span class="text-center text-3xl m-5 font-light color-4">Les stats du blog</span>
            <span class="text-2xl color-4 pb-5">articles écrit : <?php if (isset($count)) echo $count; ?> </span>
            <span class="text-2xl color-4 pb-5">commentaires écrit : <?php if (isset($arrayComs)) echo $nbComs; ?> </span>
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
                <?php } ?>
            </div>
        <?php } ?>
        <?php
        if (isset($_GET['error'])) { ?>
            <div class="container p-3 mt-3 text-white text-lg mx-auto flex flex-col items-center text-center  bg-red-500 md:w-2/4 2xl:w-1/4 md:rounded-md">

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

    <form action="admin.php" method="post">
        <section>

            <div class="bg-color-3 text-white">
                <div class="container mx-auto m-4  p-2 gap-2  flex flex-col md:flex-row justify-center items-center">
                    <h2 class="text-3xl">Les utilisateurs du blog :</h2>
                    <span class="menus mx-4 p-2 rounded border cursor-pointer bg-color-1">Ouvrir menu</span>
                </div>
                <div class="menu-content container mx-auto my-2  p-2  flex flex-col items-center  ">


                    <?php
                    for ($i = 0; $i < count($arrayUsers); $i++) {


                    ?>
                        <div class="text-white bg-color-2 my-2">
                            <div class="flex gap-5 justify-between  container p-3">
                                <h3>ID : <span class="text-yellow-500"> <?= $arrayUsers[$i]['id'] ?> </span></h3>
                                <p>login : <span class="<?php if ($arrayStatus[$i]['droits'] == 'admin') {
                                                            echo  'text-red-500';
                                                        } else if ($arrayStatus[$i]['droits'] == 'moderateur') {
                                                            echo 'text-green-500';
                                                        } else {
                                                            echo 'text-blue-500';
                                                        }
                                                        ?>"> <?= $arrayUsers[$i]['login'] ?> </span></p>
                                <span> email : <?= $arrayUsers[$i]['email'] ?></span>
                                <p>Droits: <span class="<?php if ($arrayStatus[$i]['droits'] == 'admin') {
                                                            echo  'text-red-500';
                                                        } else if ($arrayStatus[$i]['droits'] == 'moderateur') {
                                                            echo 'text-green-500';
                                                        } else {
                                                            echo 'text-blue-500';
                                                        }
                                                        ?> "><?= $arrayStatus[$i]['droits'] ?></span></p>
                            </div>

                        </div>
                        <div>
                            <div class="btnContainer flex justify-between w-screen container p-3">
                                <button class="update border rounded p-3 hover:bg-orange-500" type="submit" name="update" value="<?= $arrayUsers[$i]['id'] ?>">modifier droits</button>
                                <button class=" border rounded p-3 hover:bg-red-500" type="submit" name="delete" value="<?= "user-" . $arrayUsers[$i]['id'] ?>">Supprimer </button>
                            </div>

                            <hr>
                        </div>
                        <!-- bloc pour maj utilisateurs -->
                        <div class="artChange  mt-5 hidden">

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
                            <div class="flex gap-8 mb-2">
                                <label for="<?= $arrayUsers[$i]['login'] ?>">Login:</label>
                                <input class="bg-color-1 p-1 rounded" type="text" name="<?= 'login-' . $arrayUsers[$i]['id'] ?>" value="<?= $arrayUsers[$i]['login'] ?>">
                            </div>
                            <div class="flex justify-between w-screen container p-3">
                                <button class="cancelBtn border rounded p-3 hover:bg-white hover:text-black" type="submit" name="cancel">Annuler</button>
                                <button class="confirmBtn border rounded p-3 hover:bg-green-500" type="submit" name="confirm" value="<?= "user-" . $arrayUsers[$i]['id'] ?>">Confirmer</button>
                            </div>
                        </div>
                    <?php  } ?>
                </div>
            </div>
            <div class="bg-color-3 text-white">
                <div class="container mx-auto m-4  p-2 gap-2  flex flex-col md:flex-row justify-center items-center">
                    <h2 class="text-3xl">Les catégories :</h2>
                    <span class="menus mx-4 p-2 rounded border cursor-pointer bg-color-1">Ouvrir menu</span>
                </div>
                <div class="menu-content container mx-auto my-2  p-2  flex flex-col items-center  ">

                    <?php
                    for ($i = 0; $i < count($arrayCats); $i++) { ?>
                        <div class="text-white bg-color-2 my-2">
                            <div class="flex gap-5 justify-between  container p-3">
                                <h3>ID : <span class="text-red-500"> <?= $arrayCats[$i]['id'] ?> </span></h3>
                                <p>Nom : <span class="text-blue-500"> <?= $arrayCats[$i]['nom'] ?> </span></p>
                            </div>
                        </div>
                        <div>


                            <hr>
                        </div>
                    <?php  } ?>

                </div>
            </div>
            <div class="bg-color-3 text-white">
                <div class="container mx-auto m-4  p-2 gap-2  flex flex-col md:flex-row justify-center items-center">
                    <h2 class="text-3xl">Les articles du blog :</h2>
                    <span class="menus mx-4 p-2 rounded border cursor-pointer bg-color-1">Ouvrir menu</span>
                </div>
                <div class="menu-content container mx-auto m-4  p-2  flex flex-col items-center  ">

                    <?php

                    // on affiche les articles qu'on a push précédemment dans un tableau
                    for ($i = 0; $i < count($arrayArt); $i++) {
                        // association de la catégorie à l'article
                        $newArray = Update::associateCatName($arrayArt[$i]['id'], $arrayCat);
                        // affichage de l'auteur de l'article
                        $username = $bdd->prepare('SELECT login FROM utilisateurs WHERE id=?');
                        $username->execute([$arrayArt[$i]['id_utilisateur']]);
                        $result = $username->fetch();

                    ?>
                        <div class="artContainer text-white bg-color-2 my-2">
                            <div class="flex justify-between w-screen container p-3">
                                <h3>Titre : <?= $arrayArt[$i]['titre'] ?></h3>
                                <div>catégories:<?php
                                                for ($k = 0; $k < count($newArray); $k++) {
                                                    echo '<span class="mx-2 p-2 bg-color-1 rounded">' . $newArray[$k] . '</span>';
                                                }
                                                ?> </div>
                            </div>
                            <p class="text-justify p-3"><?= $arrayArt[$i]['article'] ?></p>
                            <div class="text-right m-3"> dernière modification le : <?= $arrayArt[$i]['date'] ?> par <span class="<?php if ($arrayStatus[$i]['droits'] == 'admin') {
                                                                                                                                        echo  'text-red-500';
                                                                                                                                    } else if ($arrayStatus[$i]['droits'] == 'moderateur') {
                                                                                                                                        echo 'text-green-500';
                                                                                                                                    } else {
                                                                                                                                        echo 'text-blue-500';
                                                                                                                                    }
                                                                                                                                    ?>"><?= $result['login'] ?></span></div>
                        </div>
                        <div>
                            <div class="btnContainer flex justify-between w-screen container p-3">
                                <button class="update border rounded p-3 hover:bg-orange-500" type="submit" name="update" value="<?= $arrayArt[$i]['id'] ?>">modifier article</button>
                                <button class=" border rounded p-3 hover:bg-red-500" type="submit" name="delete" value="<?= $arrayArt[$i]['id'] ?> ">Supprimer article</button>
                            </div>

                            <hr>
                        </div>
                        <!-- bloc pour maj article -->
                        <div class="artChange  mt-5 hidden">

                            <div class="gap-5 mb-2">
                                <label for="categories"> changer vos catégories ? (cochez les cases correspondantes) :</label>
                                <div id="dropdownSearch" class="z-10 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                                    <?php Update::listOfCategories(); ?>
                                </div>
                            </div>
                            <div class="flex gap-8 mb-2">
                                <label for="<?= $arrayArt[$i]['titre'] ?>">Titre :</label>
                                <input class="bg-color-1 p-1 rounded" type="text" name="<?= 'titre-' . $arrayArt[$i]['id'] ?>" value="<?= $arrayArt[$i]['titre'] ?>">
                            </div>
                            <div class="flex gap-5 mb-8">
                                <label for="<?= $arrayArt[$i]['id'] ?>">article :</label>
                                <textarea class="bg-color-1 p-1 rounded" cols="70" rows="10" name="<?= $arrayArt[$i]['id'] ?>"><?= $arrayArt[$i]['article'] ?></textarea>
                            </div>
                            <div class="flex justify-between w-screen container p-3">
                                <button class="cancelBtn border rounded p-3 hover:bg-white hover:text-black" type="submit" name="cancel">Annuler</button>
                                <button class="confirmBtn border rounded p-3 hover:bg-green-500" type="submit" name="confirm" value="<?= $arrayArt[$i]['id'] ?>">Confirmer</button>
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
                    <h2 class="text-3xl">Les Commentaires des utilisateurs :</h2>
                    <span class="menus mx-4 p-2 rounded border cursor-pointer bg-color-1">Ouvrir menu</span>
                </div>
                <div class="menu-content container mx-auto flex flex-col items-center ">
                    <span> Cliquez sur le commentaire pour être redirigé vers l'article, pour pouvoir le modifier</span>
                    <?php
                    // on affiche les commentaires qu'on a push précédemment dans un tableau
                    for ($i = 0; $i < $nbComs; $i++) {

                        // affichage de l'auteur du commentaire
                        $username = $bdd->prepare('SELECT login FROM utilisateurs WHERE id=?');
                        $username->execute([$commentaries[$i]['id_utilisateur']]);
                        $author = $username->fetch(); ?>
                        <a href="article.php?id=<?= $commentaries[$i]['id_article'] ?>">
                            <div class="artContainer text-white bg-color-2 my-2 hover:bg-gray-500">
                                <div class="flex flex-col justify-between w-screen container p-3">
                                    <p><span class="<?php if ($arrayStatus[$i]['droits'] == 'admin') {
                                                        echo  'text-red-500';
                                                    } else if ($arrayStatus[$i]['droits'] == 'moderateur') {
                                                        echo 'text-green-500';
                                                    } else {
                                                        echo 'text-blue-500';
                                                    }
                                                    ?>"> <?= $author['login'] ?></span> a posté le commentaire suivant le : <?= $commentaries[$i]['date'] ?></p>
                                    <p> <?= $commentaries[$i]['commentaire'] ?></p>
                                </div>
                                <hr>
                            </div>
                        </a>
                    <?php } ?>
                </div>
        </section>
    </form>
    <?php require_once('src/footer.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

    <script src="src/admin.js"></script>
</body>

</html>