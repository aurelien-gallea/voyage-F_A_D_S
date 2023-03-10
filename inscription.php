<?php
    session_start();
    
    require_once('classes/User.php');
    require_once('classes/Security.php');
    require_once('classes/Verify.php');
    
    if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['password2']) &&!empty($_POST['email'])) {
        if ($_POST['password'] == $_POST['password2']) {

            // protection des variables
            $login   = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);
            $email    = htmlspecialchars($_POST['email']);

            // doublon login
            if(Verify::loginAlreadyExist($login)) {
                header('location:inscription.php?error=1&message=login déjà existant');
                exit();
            }

            // verifications du mail
            if(!Verify::verifySyntax($email)) {
                header('location:inscription.php?error=1&message=merci de rentrer un email valide !');
                exit();
            }
            // doublon mail
            if(Verify::emailAlreadyExist($email)) {
                header('location:inscription.php?error=1&message= mail déjà utilisé');
                exit();
            }
            
            // on chiffre le mdp
            $password = Security::hash($password);           
            // on ajoute l'utilisateur
            $user = new User($login, $password, $email);
            $user->register();
            $user->baseRole();
        
            // redirection 
            header('location:connexion.php');
            exit();
           
        } else {
            header('location:inscription.php?error=1&message=merci de rentrer des mots de passe indentiques');
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

    <title>S'inscrire</title>
</head>

<body class="flex flex-col min-h-screen dark:bg-color-1">
    <?php require_once('src/header-blog.php'); ?>
    <section class="flex-grow">

        <div class="container mx-auto m-28  flex flex-col items-center  bg-color-5 dark:bg-color-3 md:w-2/4 2xl:w-1/4 md:rounded-md">
            <h1 class="font-unbounded text-color-3 dark:text-color-4 text-center text-3xl m-5 font-light color-4">Nouveau compte</h1>
            <form class="flex flex-col justify-center" action="inscription.php" method="post">
                <div>
                    <div class="flex  justify-center">
                        <label for="login" class="bg-color-3 dark:bg-color-4 p-2 mt-3 rounded-l-md"><img width="30" src="assets/utilisateur.png" alt="icone utilisateur"> </label>
                        <input id="login" maxlength="12" class="p-2 rounded-r-md mt-3 text-xl" type="text" name="login"  placeholder="Nom d'utilisateur">
                    </div>
                    <small id="errorLogin" class="text-red-800 dark:text-color-4">Entrez un nom d'utilisateur</small>
                </div>
                <div>

                    <div class="flex  justify-center"> 
                        <label for="email" class="bg-color-3 dark:bg-color-4 p-2  rounded-l-md"><img width="30" src="assets/email.png" alt="icone email"></label>
                        <input id="email" class="p-2 rounded-r-md  text-xl" type="email" name="email"  placeholder="Email">
                    </div>
                    <small id="errorEmail" class=" text-red-800 dark:text-color-4">Utilisez un email valide</small>
                </div>
                <div>

                    <div class="flex  justify-center">
                        <label for="password" class="bg-color-3 dark:bg-color-4 p-2  rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone icone mot de passe"></label>
                        <input id="password" class="p-2 rounded-r-md  text-xl" type="password" name="password" placeholder="Mot De Passe">    
                    </div>
                </div> 
                <div>
                    
                    <div class="flex  justify-center mt-2"> 
                        <label for="password2" class="bg-color-3 dark:bg-color-4 p-2  mt-3 rounded-l-md"><img width="30" src="assets/mot-de-passe.png" alt="icone mot de passe"></label>
                        <input id="password2" class="p-2 rounded-r-md mt-3 text-xl" type="password" name="password2"  placeholder="Confimer MDP">
                    </div>
                    <div id="errorPassword">
                        <small class="text-red-800 dark:text-color-4">Deux mots de passe identiques, 8 caractères minimum</small><br>
                        <small class="text-red-800 dark:text-color-4">Majuscule, minuscule, chiffre et caractère spécial</small>
                    </div>
                </div>
            
            <div id="divBtn" class="p-2  mb-5 w-full bg-color-3 dark:bg-color-4 text-center border rounded-md text-xl hover:bg-white hover:text-black">   
                <button id="btn" class="w-full" type="submit">S'incrire</button>
            </div>
            <div class="text-white mb-5">
                <span>Déjà un compte ?
                    <a class="hover:text-orange-500" href="connexion.php">Cliquez ici</a>
                </span>
            </div>
            <?php
        if(isset($_GET['error']) && !empty($_GET['message'])) {
            echo '<p class="alert error">'.htmlspecialchars($_GET['message']).'</p>';
        } 
        ?>
        </form>
    </div>
    
    </section>
    <?php require_once('src/footer.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="src/tailwind-need-body.js"></script>
    <script src="src/inscription.js"></script>
    </body>
    
    </html>