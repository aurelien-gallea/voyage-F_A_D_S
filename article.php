
<?php 
include'src/header.php';
?>
<br><br><br><br><br><br>

<?php
//Récupération de l'id de l'article--------------------->

    require_once('src/connectionDB.php');
    $id = (int) $_GET['id'];
    
    $stmt = $bdd->prepare("SELECT * FROM articles WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $article = $stmt->fetch();
    $id_article = (int) $_GET['id'];

//  Récupération des commentaires, du login grace à la liaison sur l'ID des tables commentaires et utilisateurs.
    $stmt = $bdd->prepare("SELECT commentaires.*, utilisateurs.login FROM commentaires
                       INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur
                       WHERE commentaires.id_article = :id_article
                       ORDER BY commentaires.date DESC");
$stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
$stmt->execute();

$commentaires = $stmt->fetchAll();

//Catégories des commentaires
//define arrey key "nom" (from categorie)


$id_article= (int) $_GET['id'];
$catName = $bdd->prepare("SELECT cat_art.id_cat, categories.nom 
        FROM `cat_art` INNER JOIN categories 
        ON categories.id = cat_art.id_cat 
        WHERE cat_art.id_art = id_art");
        // $catName->bindParam(':id_art', $id_article, PDO::PARAM_INT);
$catName->execute();
$cat=$catName->fetchAll();
var_dump( $cat );


    
// nouveau commentaire---------------------------->
    if (isset($_POST['submit_commentaire'])) {
      // Récupération des données du formulaire
      $commentaire = htmlspecialchars($_POST['commentaire']);
      $login = $_COOKIE['login'];
      $id = (int) $_GET['id'];

      $stmt2 = $bdd->prepare(" INSERT INTO commentaires (id_utilisateur, id_article, commentaire, date)
      SELECT utilisateurs.id, :id_article, :commentaire, NOW()
      FROM utilisateurs
      WHERE utilisateurs.login = :login");
      $stmt2->bindParam(':id_article', $id, PDO::PARAM_INT);
      $stmt2->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
      $stmt2->bindParam(':login', $login, PDO::PARAM_STR);
      $stmt2->execute();



      
    //   // Redirection vers la même page pour afficher les commentaires actualisés->bug
    //   header("Location: ". $_SERVER['PHP_SELF']. "?id=". $id);
    //   die();
    // }
      // header('Location: article.php?id='. $id);
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
        <p class="mb-1 font-normal text-gray-900 dark:text-gray-400">catégorie : <?php foreach ($cat as $item) {
    echo $item['nom'];
}
 ?></p>
    </div>
</a>


  <!-- ajout commentaire -->
   
<form action="article.php?id=<?php echo $id; ?>" method="post">
   <div class="w-5/6 mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
       <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
           <label for="commentaire" class="sr-only">Votre commentaire</label>
           <textarea name="commentaire" id="commentaire" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="votre commentaire..." required></textarea>
       </div>
       <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
           <button type="submit" name="submit_commentaire" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-300 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               Envoyer le commentaire
           </button>
           
       </div>
   </div>
</form>
    



 <?php foreach ($commentaires as $commentaire) { ?>
  <div class="block w-5/6 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
      <?php echo $commentaire['login'] . ' a posté le commentaire suivant : ' ?><?php echo $commentaire['date']; ?>
    </h5>
    <div class="comments">
      <p class="font-normal text-gray-700 dark:text-gray-400"><?php echo $commentaire['commentaire']; ?></p>
    </div>
  </div> 
<?php } ?>

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


    