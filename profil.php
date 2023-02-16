<?php
session_start();
// redirection si non connecté
if (!isset($_SESSION['id'])) {
    header('location:connexion.php');
    exit();
}

$id = htmlspecialchars($_SESSION['id']); // il faudra utiliser $_SESSION['id']

require('src/connectionDB.php');
require_once('classes/Verify.php');
require_once('classes/Security.php');
require_once('classes/Update.php');
require_once('classes/Date.php');
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id=?');
$req->execute([$id]);
$result = $req->fetch();
$login = $result['login'];
$email = $result['email'];


// formulaire n°1 changement login/email --------------------------------------------------------------
if (!empty($_POST['password'])) {

    // protection des variables
    $login   = htmlspecialchars($_POST['login']);
    $email    = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);


    $_SESSION['login'] = $login;
    $_SESSION['id'] = $id;

    // doublon login SI changement
    if ($login != $result['login']) {

        if (Verify::loginAlreadyExist($login)) { // on verifie l'existence du doublon dans la bdd
            header('location:profil.php?error=4&message=login déjà existant');
            exit();
        }
    }

    // verifications du format du mail
    if (!Verify::verifySyntax($email)) {
        header('location:profil.php?error=6&message=merci de rentrer un email valide !');
        exit();
    }
    // doublon mail SI changement 
    if ($email != $result['email']) {

        if (Verify::emailAlreadyExist($email)) { // on verifie l'existence du doublon dans la bdd
            header('location:profil.php?error=5&message= mail déjà utilisé');
            exit();
        }
    }
    //encryptage MDP
    $password = Security::hash($password);

    // correspondance MDP entré et MDP de la BDD
    if ($password == $result['password']) {

        // MAJ des infos
        require('src/connectionDB.php');
        $req = $bdd->prepare('UPDATE `utilisateurs` SET `login`=?, `email`=? WHERE id=?');
        $req->execute([$login, $email, $id]);
        header('location:profil.php?success=1');
        exit();
    } else {
        header('location:profil.php?error=1');
        exit();
    }
}

// formulaire n° 2 changement de mot de passe ---------------------------------------
if (!empty($_POST['passChange1'])) {

    $passChange1 = htmlspecialchars($_POST['passChange1']);
    $passChange2 = htmlspecialchars($_POST['passChange2']);
    $passChange3 = htmlspecialchars($_POST['passChange3']);

    //encryptage MDP
    $passChange1 = Security::hash($passChange1);

    // correspondance MDP entré et MDP de la BDD
    if ($passChange1 == $result['password']) {
        if ($passChange2 == $passChange3) {

            //encryptage MDP
            $passChange2 = Security::hash($passChange2);

            // on change le mdp
            require('src/connectionDB.php');
            $req = $bdd->prepare('UPDATE `utilisateurs` SET `password`=? WHERE id=?');
            $req->execute([$passChange2, $id]);
            header('location:profil.php?success=2');
            exit();
        } else {
            header('location:profil.php?error=2');
            exit();
        }
    } else {
        header('location:profil.php?error=1');
        exit();
    }
}
// articles ---------------------------------------------------------
// les stats et les articles --------------------------------------------------------------------------
$stats = $bdd->prepare('SELECT * FROM articles WHERE id_utilisateur=?');
$stats->execute([$id]);
$count = $stats->rowCount();


$arrayArt = []; // on initialise un array vide pour le remplir avec les articles
$arrayCat = []; // meme chose pour les catégories
$arrayComs = []; // pour les commentaires
$commentaries = Update::selectCommentsByUser($id, $arrayComs);
$nbComs = count($commentaries);
// var_dump($nbComs);
// message et actions en cas de modificiation / suppression -------------------------------------
while ($articles = $stats->fetch(PDO::FETCH_ASSOC)) {
    // on push les donnees deja existantes dans un tableau pour pouvoir header à ce niveau et echo plus bas
    array_push($arrayArt, $articles);

    // on supprime le message
    if (isset($_POST['delete']) && $_POST['delete'] == $articles['id']) {
        $delete = htmlspecialchars($_POST['delete']);
        Update::deleteArticle($delete, $articles['id_utilisateur']);
        header('location:profil.php?success=3');
        exit();

        // on met à jour le message
    } else if (isset($_POST['confirm']) && $_POST['confirm'] == $articles['id']) {
        $titre = htmlspecialchars($_POST['titre-' . $articles['id']]);
        $article = htmlspecialchars($_POST[$articles['id']]);

        Update::updateArticle($titre, $article, $articles['id'], $articles['id_utilisateur']);
        // si des checkbox sont cochées pour changer les catégories ont met à jours celles-ci
        if (!empty($_POST['categorie'])) {
            Update::deleteCatArt($articles['id']);
            foreach ($_POST['categorie'] as $value) {
                $categorie = htmlspecialchars($value);
                Update::insertIntoCatArt($articles['id'], $categorie);
            }
        }
        header('location:profil.php?success=4');
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/stylefooter.css">
    <!-- <link rel="stylesheet" href="css/voyages.css"> -->
    <link rel="stylesheet" href="css/tailwind-need.css">
    <script src="src/tailwind-need.js"></script>
    <link href="assets/favicon.ico" rel="icon" type="image/x-icon" />

    <title>Profil</title>
</head>

<body class="min-h-screen flex flex-col dark:bg-color-1">
    <?php require_once('src/header-blog.php'); ?>
    <section class=" mt-28">

        <div class="container mx-auto p-2  flex flex-col items-center bg-color-5 dark:bg-color-3 md:w-2/4 2xl:w-1/4 md:rounded-t-md">
            <h1 class="font-unbounded text-center text-3xl m-5 font-light text-color-3 dark:text-color-4">Modifier Profil</h1>
            <div id="block1" class="">
                <hr>

                <form class="flex flex-col justify-center gap-5" action="profil.php" method="post">
                    <div class="mt-3">
                        <h2 class="text-white text-xl">Changement identifiant / email</h2>
                    </div>
                    <div>
                        <div class="flex  justify-center">
                            <label for="login" class="bg-color-3 dark:bg-color-4 p-2 mt-3 rounded-l-md"><img width="30" src="assets/utilisateur.png" alt="icone utilisateur"> </label>
                            <input id="login" class="p-2 rounded-r-md  mt-3 text-xl" type="text" name="login" id="login" value="<?= $login ?>">
                        </div>
                    </div>
                    <div>

                        <div class="flex  justify-center">
                            <label for="email" class="bg-color-3 dark:bg-color-4 p-2  rounded-l-md"><img width="30" src="assets/email.png" alt="icone email"></label>
                            <input id="email" class="p-2 rounded-r-md  text-xl" type="text" name="email" id="email" value="<?= $email ?>">
                        </div>

                    </div>
                    <div>
                        <div class="flex justify-center">
                            <label for="password" class="bg-color-3 dark:bg-color-4 p-2  rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
                            <input id="password" class="p-2 rounded-r-md  text-xl" type="password" name="password" id="password" placeholder="Confirmer Mot De Passe">
                        </div>
                    </div>
                    <small class="text-red-500 ">Confirmer votre MDP pour modifier les informations</small>

                    <div id="divBtn" class="p-2  w-full bg-color-3 dark:bg-color-4 text-center border rounded-md text-xl hover:bg-white hover:text-black">
                        <button id="btn" class="w-full" type="submit">Modifier mes informations</button>
                    </div>
                </form>
                <button id="passWindow" class="my-5 text-white hover:text-orange-500">changer le mot de passe ?</button>
            </div>
            <div id="block2">
                <hr>
                <form action="profil.php" method="post" class="flex flex-col justify-center gap-5">



                    <div class="mt-3">
                        <h2 class="text-white text-xl">Changement de mot de passe</h2>
                    </div>
                    <div class="flex flex-col gap-5">
                        <div class="flex  justify-center">
                            <label for="passChange1" class="bg-color-3 dark:bg-color-4 p-2 mt-3 rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
                            <input id="passChange1" class="p-2 rounded-r-md mt-3 text-xl" type="password" name="passChange1" id="passChange1" placeholder="Mot De Passe Actuel">
                        </div>
                        <div class="flex  justify-center">
                            <label for="passChange2" class="bg-color-3 dark:bg-color-4 p-2  rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
                            <input id="passChange2" class="p-2 rounded-r-md text-xl" type="password" name="passChange2" id="passChange2" placeholder="Nouveau Mot De Passe">
                        </div>
                        <div>
                            <div class="flex  justify-center ">
                                <label for="passChange3" class="bg-color-3 dark:bg-color-4 p-2   rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone mot de passe"></label>
                                <input id="passChange3" class="p-2 rounded-r-md text-xl" type="password" name="passChange3" id="passChange3" placeholder="Confirmer nouveau MDP ">
                            </div>
                        </div>
                        <small id="notMatch" class="text-red-500">Les Mots de passes ne correspondent pas</small>
                        <div id="divBtn2">
                            <button id="btn2" class="p-2   w-full bg-color-3 dark:bg-color-4 text-center text-white border rounded-md text-xl hover:bg-white hover:text-black">Soumettre</button>
                        </div>
                    </div>


                </form>
                <button id="userWindow" class="my-5 text-white hover:text-orange-500">changer l'identifiant / l'email ?</button>
            </div>


        </div>
    </section>
    <section>
        <div class="container w-4/5">

        </div>
        <div class="container mx-auto text-white flex flex-col items-center dark:bg-color-5 bg-color-3 md:w-2/4 2xl:w-1/4 md:rounded-b-md">
            <span class="font-unbounded text-center text-3xl m-5 font-light color-4">Mes stats</span>
            <span class="text-2xl color-4 pb-5">articles écrits : <?php if (isset($count)) echo $count; ?> </span>
            <span class="text-2xl color-4 pb-5">commentaires écrits : <?php if (isset($arrayComs)) echo $nbComs; ?> </span>
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

    <section >
        <div class="bg-color-3 dark:text-white">
            <div class=" text-white container mx-auto m-3 p-4 flex flex-col items-center">
                <h2 class="font-unbounded text-2xl mt-2">Mes articles :</h2>
            </div>
            <div class="menu-content container mx-auto m-4  p-2 flex flex-col md:w-1/2">

                <form action="profil.php" method="post">
                    <?php
                    // on affiche les articles qu'on a push précédemment dans un tableau
                    for ($i = 0; $i < count($arrayArt); $i++) {
                        $newArray = Update::associateCatName($arrayArt[$i]['id'], $arrayCat);
                    ?>
                        <div class="border rounded my-6">
                            <div class="artContainer text-black dark:text-white bg-white dark:bg-color-1">
                                <div class="flex flex-col  justify-center container p-3">
                                    <h3 class="text-xl mb-2">Titre : <?= $arrayArt[$i]['titre'] ?></h3>
                                    <div class="flex flex-wrap items-center gap-1">catégories:<?php
                                                                                    for ($k = 0; $k < count($newArray); $k++) {
                                                                                        echo '<span class="mx-2 p-2 bg-color-5 rounded">' . $newArray[$k] . '</span>';
                                                                                    }
                                                                                    ?> </div>
                                </div>
                                <hr>
                                <p class="break-words p-3 "><?= $arrayArt[$i]['article'] ?></p>
                                <hr>
                                <div class="text-right p-3 "> dernière modification le : <?= DateToFr::dateFr($arrayArt[$i]['date']) ?> par <?= $login ?></div>
                                <hr>
                            </div>
                            <div>
                                <div class="btnContainer container text-black dark:text-white bg-white dark:bg-color-3 flex flex-wrap justify-between gap-2  p-3">
                                    <button class="update border rounded p-3 hover:bg-orange-500" type="submit" name="update" value="<?= $arrayArt[$i]['id'] ?>">modifier</button>
                                    <button class=" border rounded p-3 hover:bg-red-500" type="submit" name="delete" value="<?= $arrayArt[$i]['id'] ?> ">Supprimer</button>
                                </div>
                            </div>
                            <!-- bloc pour maj article -->
                            <div class="artChange  mt-5 hidden p-2">

                                <div class="gap-5 mb-2">
                                    <label for="categories"> changer vos catégories ? (cochez les cases correspondantes) :</label>
                                    <div id="dropdownSearch" class="z-10 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                                        <?php Update::listOfCategories(); ?>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-3 mb-2">
                                    <label for="<?= $arrayArt[$i]['titre'] ?>">Titre :</label>
                                    <input class="dark:bg-color-1 p-1 rounded" type="text" name="<?= 'titre-' . $arrayArt[$i]['id'] ?>" value="<?= $arrayArt[$i]['titre'] ?>">
                                </div>
                                <div class="flex flex-col gap-3 mb-8">
                                    <label for="<?= $arrayArt[$i]['id'] ?>">article :</label>
                                    <textarea class="dark:bg-color-1 p-1 rounded w-full h-80" name="<?= $arrayArt[$i]['id'] ?>"><?= $arrayArt[$i]['article'] ?></textarea>
                                </div>
                                <div class="flex justify-between container p-3">
                                    <button class="cancelBtn border rounded p-3 hover:bg-white hover:text-black" type="submit" name="cancel">Annuler</button>
                                    <button class="confirmBtn border rounded p-3 hover:bg-green-500" type="submit" name="confirm" value="<?= $arrayArt[$i]['id'] ?>">Confirmer</button>
                                </div>
                            </div>
                        </div>
                    <?php

                    } ?>
                </form>
            </div>
        </div>
    </section>
    <section class="flex-grow">
        <div class="bg-color-3 text-white my-3">
            <div class="container mx-auto m-3 p-4 flex flex-col md:flex-row justify-center items-center  ">
                <h2 class="font-unbounded text-2xl">Mes Commentaires :</h2>
            </div>
            <div class="container mx-auto m-4 flex flex-col md:w-1/2  ">
                <span> Cliquez sur le commentaire pour être redirigé vers l'article, pour pouvoir le modifier</span>
                <?php
                // on affiche les commentaires qu'on a push précédemment dans un tableau
                for ($i = 0; $i < $nbComs; $i++) { ?>
                    <div class="border rounded my-4">
                        <a href="article.php?id=<?= $commentaries[$i]['id_article'] ?>">
                            <div class="artContainer text-white text-black dark:text-white bg-white dark:bg-color-1 hover:bg-gray-500">
                                <div class="flex flex-col justify-between  container p-3">
                                   <p> <span class="text-blue-500 text-xl"> <?= $login ?> </span> a posté le commentaire suivant le : <?= DateToFr::dateFR($commentaries[$i]['date']) ?></span></p>
                                    <p> <?= $commentaries[$i]['commentaire'] ?></p>
                                </div>
                                <hr>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
    </section>
    <?php require_once('src/footer.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="src/tailwind-need-body.js"></script>
    <script src="src/profil.js"></script>
</body>

</html>