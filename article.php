
<?php 
include'src/header.php';
?>
<?php

    require_once('src/connectionDB.php');
    $id = (int) $_GET['id'];
    
    $stmt = $bdd->prepare("SELECT * FROM articles WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $article = $stmt->fetch();

    $stmt = $bdd->prepare("SELECT * FROM commentaires WHERE id_article = :id_article");
    $stmt->bindParam(':id_article', $id);
    $stmt->execute();
    $commentaires = $stmt->fetchAll();

    $stmt = $bdd->prepare("SELECT utilisateurs.login FROM utilisateurs, commentaires WHERE utilisateurs.id= commentaires.id_utilisateur");
    //  $stmt->bindParam(':commentaires.id_utilisateur', $id);
    $stmt->execute();
    $login_utilisateur = $stmt->fetch();

    
    // nouveau commentaire
    if (isset($_POST['submit_commentaire'])) {
      // Récupération des données du formulaire
      $commentaire = htmlspecialchars($_POST['commentaire']);
      $id_utilisateur = $_POST['id_utilisateur'];
      
      // Requête pour insérer le nouveau commentaire en base de données
      $stmt = $bdd->prepare("INSERT INTO commentaires (commentaire, id_article, id_utilisateur, date) VALUES (:commentaire, :id_article, :id_utilisateur, NOW())");
      $stmt->bindParam(':commentaire', $commentaire);
      $stmt->bindParam(':id_article', $id);
      $stmt->bindParam(':id_utilisateur', $id_utilisateur);
      $stmt->execute();
      
      // Redirection vers la même page pour afficher les commentaires actualisés
      header('Location: article.php?id=' . $id);
      exit;
    }
    
    ?>
    <!DOCTYPE html >
    <html>
        <body class=" content-center justify-center  w-full h-full m-auto bg-gray-200 dark:bg-gray-600" >
    <div  class="flex flex-col content-center justify-center pt-20 w-full z-10 h-screen m-auto p-4 md:inset-0  md:h-full">

  


    <a href="#" class="flex flex-col items-center w-5/6 bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="assets/illustration1.png" alt="">
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Article - <?php echo $article['titre']; ?></h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo $article['article']; ?></p>
    </div>
</a>


  <!-- ajout commentaire -->
   
<form action="article.php?id=<?php echo $id; ?>" method="post">
   <div class="w-5/6 mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
       <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
           <label for="comment" class="sr-only">Votre commentaire</label>
           <textarea id="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
       </div>
       <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
           <button type="submit" name="submit_commentaire" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-300 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               Envoyer le commentaire
           </button>
           
       </div>
   </div>
</form>

      
      <!-- Formulaire d'ajout de commentaires -->
<!-- <h3>Ajouter un commentaire</h3>
<form action="article.php?id=<?php echo $id; ?>" method="post">
    <textarea name="contenu"></textarea>
    <input type="submit" value="Envoyer">
</form> -->
<!-- affichage des commentaires -->
    

    <?php foreach ($commentaires as $commentaire) { ?>
      <div class="block w-5/6 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $login_utilisateur['login.utilisateurs']; ?><?php echo $commentaire['date']; ?></h5>  
      <div class="comments">
    <p class="font-normal text-gray-700 dark:text-gray-400"><?php echo $commentaire['commentaire']; ?></p>
</div>
</div> 
 <?php } ?>


 








<?php
// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    // $contenu = $_POST['commentaire'];
    
    // Vérification des données
    if (empty($contenu)) {
        echo 'Le commentaire est vide';
    } else {
        // Enregistrement en base de données
        $query = $bdd->prepare('INSERT INTO commentaires (id_article, id_utilisateur, commentaire) VALUES (:id_article, :id_utilisateur, :commentaire)');
        $query->execute([
            'id_article' => $id,
            // 'id_utilisateur' => $_SESSION['utilisateurs']['id'],
            'commentaire' => $contenu
        ]);
             header('Location: article.php?id=' . $id);
        exit;
    }
}
?>


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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
  </body>
    </div>
</html>
<?php
 if(isset($_GET['erreur'])){
 $erreur = $_GET['erreur'];
 if($erreur==1 )
 echo "<p class='alert''>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>


    