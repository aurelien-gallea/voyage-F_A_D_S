<?php session_start(); ?>

<?php



require_once('src/connectionDB.php');
require_once('classes/Security.php');
if(!empty($_POST['login']) && !empty($_POST['password'])) {
    $login   = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $stmt = $bdd->prepare('SELECT * FROM utilisateurs ');
    $stmt->execute();
    $count = 0;
    $password = Security::hash($password);

    while($resultat = $stmt->fetch()) {
        

    if($resultat['login'] == $login &&  $password == $resultat['password']) {
        setcookie('login', htmlspecialchars($resultat['login']),time()+3600 ); 
        $id = $resultat['id'];

        $_SESSION['id']  =$id;  
       $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
          
       $count++;
      
      header('location:articles.php');
        exit();
    }
}
    if($count!=1) {
        
        $count = 0;

        header('Location: connexion.php?erreur=1');
        exit();
    } 
        
}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/voyages.css">
    <link rel="stylesheet" href="css/stylefooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@0.2.28/bundled/lenis.js"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css"
      rel="stylesheet"
    />
    <title>Page de Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/stylefooter.css">
    <!-- <link rel="stylesheet" href="css/voyages.css"> -->
    <link rel="stylesheet" href="css/tailwind-need.css">
    <script src="src/tailwind-need.js"></script>
    <link href="assets/favicon.ico" rel="icon" type="image/x-icon" />
  </head>

  <!-- ----------------------------------body--------------------------- -->

  <body>
<?php 
include'src/header.php';
?>

<div class="relative flex items-center justify-center h-screen mt-12 overflow-hidden ">

<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="flex content-center justify-center w-full z-10 h-screen m-auto p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full m-auto max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative duration-700 ease-linear backdrop-blur-md rounded-lg shadow dark:bg-gray-700">
        
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Connectez vous à TastyTrip!</h3>
                <form class="space-y-6" action="" method="post">
                    <div>
                        <label for="login" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre Login</label>
                        <input type="login" name="login" id="login" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-color-3 focus:border-color-3 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Votre Login" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-color-3 focus:border-color-3 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        <!-- toggle dans le mot de passe -->
                        <span toggle="#password" id="toggleid" class="fa-solid  fa-eye fa-eye-slash field-icon toggle-password"></span>
                        
                      </div>
                    <div class="flex justify-between">
                        <!-- <div class="flex items-start"> -->
                            <!-- <div class="flex items-center h-5"> -->
                                <!-- <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded text-color-5 bg-gray-50 focus:ring-3 focus:ring-color-3 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-color-3 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required> -->
                            <!-- </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Se rappeler de moi</label>
                        </div> -->
                       <div class="text-red-600"> <?php
if(isset($_GET['erreur'])){
  $erreur=$_GET['erreur'];
  if($erreur==1){
    echo "<p class='alert'>login ou mot de passe incorrect</p>";

  }
}
  ?>
  </div>
                        
                    </div>
                    <button type="submit" class="w-full text-white bg-gray-600 hover:bg-color-5 focus:ring-4 focus:outline-none focus:ring-color-3 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-color-3 dark:hover:bg-color-5 dark:focus:ring-color-2">Connexion</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Non inscrit? <a href="inscription.php" class="text-white hover:underline dark:text-color-5">Créer un compte</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<video autoplay loop muted class="absolute z-auto opacity-60 w-auto min-w-full min-h-full max-w-none">
    <source src="assets/vid.mp4" type="video/mp4" />
  </video>
</div>

<script>
const passwordInput = document.querySelector("#password");
const togglePassword = document.getElementById("toggleid");
const eye=document.querySelector("fa-eye-slash");
togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");

togglePassword.addEventListener("click", function () {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa-eye");
             
      
    } else {
        passwordInput.type = "password";
        
        togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");
       
    }
});


</script>


<?php 
include'src/footer.php';
?>


 <!-- <script src="src/hidePass.js"></script> -->

    <script src="src/tailwind-need-body.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
  </body>
</html>




