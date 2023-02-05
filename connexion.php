
<?php

// include'src/header.php';

require_once('src/connectionDB.php');

if(!empty($_POST['login']) && !empty($_POST['password'])) {
    $login   = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $stmt = $bdd->prepare('SELECT * FROM utilisateurs ');
    $stmt->execute();
    $count = 0;
   

    while($resultat = $stmt->fetch()) {
        
        
    if($resultat['login'] == $login && $resultat['password'] == $password) {
        var_dump( $resultat['password'] == $pass);
        setcookie('login', htmlspecialchars($resultat['login']),time()+3600 ); 
        $_SESSION['id']  =$id;  
       $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
         header('location:articles.php');
       $count++;
       var_dump( $_SESSION['login']);
        exit();
    }
}
    if($count!=1) {
        header('Location: connexion.php?erreur=1');
        $count = 0;
        var_dump( $_SESSION['login']);
        exit();
    } 
        
}

?>


<?php 
include'src/header.php';
?>







<!-- <form action="" method="post">
    <input type="text" name="login" placeholder="Nom d'utilisateur">
    <input type="password" name="password" placeholder="Mot de passe">
    <input type="submit" name="submit" value="Se connecter">
</form> -->


<!-- Modal toggle -->
<!-- 
<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white
bg-color-5 hover:bg-color-2 focus:ring-color-3 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-color-1 dark:hover:bg-color-5 dark:focus:ring-color-2" type="button">
 Connexion
</button> -->
<div class="relative flex items-center justify-center h-screen mb-12 overflow-hidden ">




<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="flex content-center justify-center w-full z-10 h-screen m-auto p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full m-auto max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative  backdrop-blur-md rounded-lg shadow dark:bg-gray-700">
        
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Connectez vous à TastyTrip!</h3>
                <form class="space-y-6" action="#">
                    <div>
                        <label for="Login" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre Login</label>
                        <input type="Login" name="Login" id="Login" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-color-3 focus:border-color-3 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Votre Login" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" value="secret" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-color-3 focus:border-color-3 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        <!-- toggle dans le mot de passe -->
                        <span toggle="#password" id="toggleid" class="fa-solid after:fa-eye-slash fa-eye field-icon toggle-password"></span>
                        
                      </div>
                    <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded text-color-5 bg-gray-50 focus:ring-3 focus:ring-color-3 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-color-3 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                            </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Se rappeler de moi</label>
                        </div>
                        <a href="#" class="text-sm text-color-5 hover:underline dark:text-color-5">Mot de passe perdu?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-color-5 hover:bg-color-5 focus:ring-4 focus:outline-none focus:ring-color-3 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-color-3 dark:hover:bg-color-5 dark:focus:ring-color-2">Connexion</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Non inscrit? <a href="inscription.php" class="text-color-5 hover:underline dark:text-color-5">Créer un compte</a>
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
const eye=document.querySelector("fa-eye");


togglePassword.addEventListener("click", function () {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
      
    } else {
        passwordInput.type = "password";
       
    }
});


</script>




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

      themeToggleBtn.addEventListener("click", function () {
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
 <!-- <script src="src/hidePass.js"></script> -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
  </body>
</html>
<?php
 if(isset($_GET['erreur'])){
 $erreur = $_GET['erreur'];
 if($erreur==1 )
 echo "<p class='alert''>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>
