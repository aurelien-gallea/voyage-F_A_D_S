<?php
    session_start();
    
    require_once('class/User.php');
    require_once('class/Security.php');
    require_once('class/Verify.php');
    if(!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) &&!empty($_POST['email'])) {
        if ($_POST['password'] == $_POST['password2']) {
            // protection des variables
            $pseudo   = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);
            $email    = htmlspecialchars($_POST['email']);
            
            // verifications du mail
            if(!Verify::verifySyntax($email)) {
                header('location:register.php?error=1&message=merci de rentrer un email valide !');
                exit();
            }
            if(Verify::emailAlreadyExist($email)) {
                header('location:register.php?error=1&message=Email déjà existant !');
                exit();
            }
            // on chiffre le mdp
            $password = Security::hash($password);           
            // on ajoute l'utilisateur
            $user = new User($pseudo, $password, $email);
            $user->register();
            $user->baseRole();
            
           
        } else {
            header('location:register.php?error=1&message=merci de rentrer des mots de passe indentiques');
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
    <title>S'inscrire</title>
</head>

<body>
    <form action="register.php" method="post">
        <div>
            <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
        </div>
        <div>
            <input type="text" name="password" id="password" placeholder="Mot De Passe">

        </div>
        <div>

            <input type="text" name="password2" id="password2" placeholder="confimer MDP">
        </div>
        <div>

            <input type="text" name="email" id="email" placeholder="email">
        </div>
        <div>

            <button type="submit">S'incrire</button>
        </div>
    </form>
    <?php
     if(isset($_GET['error']) && !empty($_GET['message'])) {
        echo '<p class="alert error">'.htmlspecialchars($_GET['message']).'</p>';
    } 
    ?>
</body>

</html>