<?php
session_start();
$id = 32;

require('src/connectionDB.php');
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id=?');
$req->execute([$id]);
$result = $req->fetch();
$id = $result['id'];
$login = $result['login'];
$email = $result['email'];
var_dump($result);



if (!empty($_POST['password'])) {

    // protection des variables
    $login   = htmlspecialchars($_POST['login']);
    $email    = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);

    $_SESSION['login'] = $login;
    $_SESSION['id'] = $id;

    //encryptage MDP
    // $password = Security::hash($password);

    // correspondance MDP entré et MDP de la BDD
    if ($password == $result['password']) {

        // MAJ des infos
        require('src/connectionDB.php');
        $req = $bdd->prepare('UPDATE `utilisateurs` SET `login`=?,`password`=?,`email`=? WHERE id=?');

        //    on met à jour le mdp si le champs "nouveau MDP" est rempli !
        if (!empty($password2)) {
            $req->execute([$login, $password2, $email, $id]);
        } else {
            $req->execute([$login, $password, $email, $id]);
        }
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
    <link rel="stylesheet" href="css/voyages.css">
    <title>Profil</title>
</head>

<body>
    <?php
    if (isset($_SESSION['login'])) { ?>
        <table>
            <tr>
                <th>Pseudo :</th>
                <td> <?= $login ?> </td>

            </tr>
            <tr>
                <th>Password :</th>
                <td> <?= $result['password'] ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td> <?= $email ?></td>
            </tr>
        </table>
    <?php } ?>
    <section class="flex-grow">

        <div class="container mx-auto m-16  flex flex-col items-center bg-color-2 md:w-2/4 2xl:w-1/4 md:rounded-md">
            <h1 class="text-center text-3xl m-5 font-light color-4">Modifier Profil</h1>
            <div id="block1">

                <form class="flex flex-col justify-center gap-5" action="profil.php" method="post">
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
                            <input id="password" class="p-2 rounded-r-md w-full text-xl" type="text" name="password" id="password" placeholder="Confirmer Mot De Passe">
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
                <form action="profil.php" method="post" class="flex flex-col justify-center gap-5">



                    <div class="mt-3">
                        <h2 class="text-white text-xl">Changement de mot de passe</h2>
                    </div>
                    <div class="flex flex-col gap-3">
                        <div class="flex  justify-center">
                            <label for="passChange1" class="bg-color-5 p-2  rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
                            <input id="passChange1" class="p-2 rounded-r-md w-full text-xl" type="text" name="passChange1" id="passChange1" placeholder="Mot De Passe Actuel">
                        </div>
                        <div class="flex  justify-center">
                            <label for="passChange2" class="bg-color-5 p-2  rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
                            <input id="passChange2" class="p-2 rounded-r-md w-full text-xl" type="text" name="passChange2" id="passChange2" placeholder="Nouveau Mot De Passe">
                        </div>
                        <div>
                            <div class="flex  justify-center ">
                                <label for="passChange3" class="bg-color-5 p-2   rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone mot de passe"></label>
                                <input id="passChange3" class="p-2 rounded-r-md w-full text-xl" type="text" name="passChange3" id="passChange3" placeholder="Confirmer nouveau MDP ">
                            </div>
                        </div>
                        <div>
                            <button id="btn2" class="p-2  my-5 w-full bg-color-5 text-center border rounded-md text-xl hover:bg-white hover:text-black">Soumettre</button>
                        </div>
                    </div>


                </form>
                <button id="userWindow" class="mb-5 text-white hover:text-orange-500">changer l'identifiant / l'email ?</button>
            </div>

        </div>

    </section>

    <script src="src/profil.js"></script>
</body>

</html>