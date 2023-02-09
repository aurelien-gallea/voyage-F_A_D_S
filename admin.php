<?php
session_start();
// redirection si non connecté
// if (!isset($_SESSION['id'])) {
//     header('location:connexion.php');
//     exit();
// }

// $id = htmlspecialchars($_SESSION['id']); // il faudra utiliser $_SESSION['id']

require('src/connectionDB.php');
require_once('classes/Verify.php');
require_once('classes/Security.php');
require_once('classes/Update.php');

// on recupère un tableau des tous les utilisateurs
$arrayUsers = [];
$arrayUsers = Update::selectAllUsers($arrayUsers);

// $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id=?');
// $req->execute([$id]);
// $result = $req->fetch();
// $login = $result['login'];
// $email = $result['email'];


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
            header('location:admin.php?error=4&message=login déjà existant');
            exit();
        }
    }

    // verifications du format du mail
    if (!Verify::verifySyntax($email)) {
        header('location:admin.php?error=6&message=merci de rentrer un email valide !');
        exit();
    }
    // doublon mail SI changement 
    if ($email != $result['email']) {

        if (Verify::emailAlreadyExist($email)) { // on verifie l'existence du doublon dans la bdd
            header('location:admin.php?error=5&message= mail déjà utilisé');
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
        header('location:admin.php?success=1');
        exit();
    } else {
        header('location:admin.php?error=1');
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
            header('location:admin.php?success=2');
            exit();
        } else {
            header('location:admin.php?error=2');
            exit();
        }
    } else {
        header('location:admin.php?error=1');
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
    <section class="flex-grow mt-32">

        <div class="container mx-auto   flex flex-col items-center bg-color-2 md:w-2/4 2xl:w-1/4 md:rounded-t-md">
            <h1 class="text-center text-3xl m-5 font-light color-4">Modifier Profil</h1>
            <div id="block1" class="">
                <hr>

                <form class="flex flex-col justify-center gap-5" action="admin.php" method="post">
                    <div class="mt-3">
                        <h2 class="text-white text-xl">Changement identifiant / email</h2>
                    </div>
                    <div>
                        <div class="flex  justify-center">
                            <label for="login" class="bg-color-5 p-2 mt-3 rounded-l-md"><img width="30" src="assets/utilisateur.png" alt="icone utilisateur"> </label>
                            <input id="login" class="p-2 rounded-r-md w-full mt-3 text-xl" type="text" name="login" id="login" value="<?= $login ?>">
                        </div>

                    </div>
                    <div>

                        <div class="flex  justify-center">
                            <label for="email" class="bg-color-5 p-2  rounded-l-md"><img width="30" src="assets/email.png" alt="icone email"></label>
                            <input id="email" class="p-2 rounded-r-md w-full text-xl" type="text" name="email" id="email" value="<?= $email ?>">
                        </div>

                    </div>
                    <div>
                        <div class="flex justify-center">
                            <label for="password" class="bg-color-5 p-2  rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
                            <input id="password" class="p-2 rounded-r-md w-full text-xl" type="password" name="password" id="password" placeholder="Confirmer Mot De Passe">
                        </div>
                    </div>
                    <small class="text-red-500 ">Confirmer votre MDP pour modifier les informations</small>

                    <div id="divBtn" class="p-2  w-full bg-color-5 text-center border rounded-md text-xl hover:bg-white hover:text-black">
                        <button id="btn" class="w-full" type="submit">Modifier mes informations</button>
                    </div>
                </form>
                <button id="passWindow" class="mb-5 text-white hover:text-orange-500">changer le mot de passe ?</button>
            </div>
            <div id="block2">
                <hr>
                <form action="admin.php" method="post" class="flex flex-col justify-center gap-5">



                    <div class="mt-3">
                        <h2 class="text-white text-xl">Changement de mot de passe</h2>
                    </div>
                    <div class="flex flex-col gap-5">
                        <div class="flex  justify-center">
                            <label for="passChange1" class="bg-color-3 p-2 mt-3 rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
                            <input id="passChange1" class="p-2 rounded-r-md mt-3 w-full text-xl" type="password" name="passChange1" id="passChange1" placeholder="Mot De Passe Actuel">
                        </div>
                        <div class="flex  justify-center">
                            <label for="passChange2" class="bg-color-3 p-2  rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
                            <input id="passChange2" class="p-2 rounded-r-md w-full text-xl" type="password" name="passChange2" id="passChange2" placeholder="Nouveau Mot De Passe">
                        </div>
                        <div>
                            <div class="flex  justify-center ">
                                <label for="passChange3" class="bg-color-3 p-2   rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone mot de passe"></label>
                                <input id="passChange3" class="p-2 rounded-r-md w-full text-xl" type="password" name="passChange3" id="passChange3" placeholder="Confirmer nouveau MDP ">
                            </div>
                        </div>
                        <small id="notMatch" class="text-red-500">Les Mots de passes ne correspondent pas</small>
                        <div id="divBtn2">
                            <button id="btn2" class="p-2   w-full bg-color-3 text-center text-white border rounded-md text-xl hover:bg-white hover:text-black">Soumettre</button>
                        </div>
                    </div>


                </form>
                <button id="userWindow" class="mb-5 text-white hover:text-orange-500">changer l'identifiant / l'email ?</button>
            </div>


        </div>
    </section>
    <section>
        <div class="container w-4/5">

        </div>
        <div class="container mx-auto  flex flex-col items-center bg-color-2 md:w-2/4 2xl:w-1/4 md:rounded-b-md">
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

    <section>

        <div class="bg-color-3 text-white">
            <form action="admin.php" method="post">
                <div class="container mx-auto m-4  p-2  flex flex-col items-center  ">
                    <h2 class="text-3xl">Les utilisateurs du blog :</h2>
                </div>
                <div class="container mx-auto my-2  p-2  flex flex-col items-center  ">


                    <?php
                    for ($i = 0; $i < count($arrayUsers); $i++) {


                    ?>
                        <div class="artContainer text-white bg-color-2 my-2">
                            <div class="flex gap-5 justify-between  container p-3">
                                <h3>ID : <span class="text-red-500"> <?= $arrayUsers[$i]['id'] ?> </span></h3>
                                <p>login : <span class="text-blue-500">  <?= $arrayUsers[$i]['login']?> </span></p>
                                <span> email : <?= $arrayUsers[$i]['email'] ?></span>
                            </div>

                        </div>
                        <div>
                            <div class="btnContainer flex justify-between w-screen container p-3">
                                <!-- <button class="update border rounded p-3 hover:bg-orange-500" type="submit" name="update" value="<?= $arrayArt[$i]['id'] ?>">modifier article</button> -->
                                <!-- <button class=" border rounded p-3 hover:bg-red-500" type="submit" name="delete" value="<?= $arrayArt[$i]['id'] ?> ">Supprimer article</button> -->
                            </div>

                            <hr>
                        </div>
                    <?php  } ?>

                </div>
                <div class="container mx-auto m-3 p-4 flex flex-col items-center  ">
                    <h2 class="text-3xl">Les articles du blog :</h2>
                </div>
                <div class="container mx-auto m-4  p-2  flex flex-col items-center  ">

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
                            <div class="text-right m-3"> dernière modification le : <?= $arrayArt[$i]['date'] ?> par <span class="text-blue-500 font-bold"><?= $result['login'] ?></span></div>
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
            </form>
        </div>
    </section>
    <section>
        <div class="bg-color-3 text-white my-3">
            <div class="container mx-auto m-3 p-4 flex flex-col items-center  ">
                <h2 class="text-3xl">Les Commentaires des utilisateurs :</h2>
            </div>
            <div class="container mx-auto flex flex-col items-center  ">
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
                                <p><span class="text-blue-500 font-bold"> <?= $author['login'] ?></span> a posté le commentaire suivant le : <?= $commentaries[$i]['date'] ?></p>
                                <p> <?= $commentaries[$i]['commentaire'] ?></p>
                            </div>
                            <hr>
                        </div>
                    </a>
                <?php } ?>
            </div>
    </section>
    <?php require_once('src/footer.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

    <script src="src/profil.js"></script>
</body>

</html>