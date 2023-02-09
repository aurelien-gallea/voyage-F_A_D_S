<?php session_start(); ?>
<?php



require_once('src/connectionDB.php');
require_once('classes/Security.php');


// nouveau commentaire---------------------------------------------OK-------------------------------------->
if (isset($_POST['submit_commentaire'])) {
  // Récupération des données du formulaire
  $commentaire = htmlspecialchars($_POST['commentaire']);
  $login = $_SESSION['login'];
  $id = (int) $_GET['id'];

  $stmt2 = $bdd->prepare(" INSERT INTO commentaires (id_utilisateur, id_article, commentaire, date)
  SELECT utilisateurs.id, :id_article, :commentaire, NOW()
  FROM utilisateurs
  WHERE utilisateurs.login = :login");
  $stmt2->bindParam(':id_article', $id, PDO::PARAM_INT);
  $stmt2->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
  $stmt2->bindParam(':login', $login, PDO::PARAM_STR);
  $stmt2->execute();  
//  ------- Redirection vers la même page pour afficher les commentaires actualisés

  header('Location: article.php?id='. $id);
  exit;
}
//modifier commentaire--------------------------------------non fini-------------------------------------->
if (isset($_POST['modifierCommentaire'])) {
//demande de modification  

  // Récupération des données du formulaire
  $commentaire = htmlspecialchars($_POST['commentaire']);
  $login = $_SESSION['login'];
  $id = (int) $_GET['id'];
//modification
  $stmt2 = $bdd->prepare(" UPDATE INTO commentaires (id_utilisateur, id_article, commentaire, date)
  SELECT utilisateurs.id, :id_article, :commentaire, NOW()
  FROM utilisateurs
  WHERE utilisateurs.login = :login");
  $stmt2->bindParam(':id_article', $id, PDO::PARAM_INT);
  $stmt2->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
  $stmt2->bindParam(':login', $login, PDO::PARAM_STR);
  $stmt2->execute();
  header('Location: article.php?id='. $id);
}
//Effacer commentaire--------------------------------------non fini-------------------------------------->
// $comm = $bdd->prepare('SELECT * FROM commentaires WHERE id_utilisateur=?');
// $comm->execute([$id]);
// $count = $comm->rowCount();


// if (isset($_POST['suppr_commentaire'])) {
// $commentaire = htmlspecialchars($_POST['commentaire']);
//   $login = $_SESSION['login'];
//   $id = (int) $_GET['id'];
//   $stmt2 = $bdd->prepare(" DELETE commentaires.id FROM commentaires WHERE utilisateurs.login = :login AND
//   utilisateurs.id = :id");
//   $stmt2->bindParam(':id_article', $id, PDO::PARAM_INT);
//   $stmt2->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
//   $stmt2->bindParam(':login', $login, PDO::PARAM_STR);
//   $stmt2->execute();
// }
//-----------------1er click je récupère l'id 2eme 
//   function deleterticle($id_article, $id_utilisateur)
// {
//     require('src/connectionDB.php');
//     $delete = $bdd->prepare('DELETE FROM articles WHERE id=? AND id_utilisateur=?');
//     $delete->execute([$id_article, $id_utilisateur]);
//     return true;
// }



?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/voyages.css">
    <link rel="stylesheet" href="css/stylefooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
  

    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css"
      rel="stylesheet"
    />
    <title>article</title>
    <script>
      tailwind.config = { darkMode: 'class',
  // ...
  content: [],
        theme: {
          extend: {
            colors: {
        'color-1': '#000F08',
        'color-2': '#1C3738',
        'color-3': '#4D4847',
        'color-4': '#F4FFF8',
        'color-5': '#8BAAAD',
      },
            opacity: {
              54: ".24",
            },
            fontFamily: {
              Unbounded: ['"Unbounded"'],
            },
          },
        },
      };
    </script>

    <script>
      // On page load or when changing themes, best to add inline in `head` to avoid FOUC
      if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
          window.matchMedia("(prefers-color-scheme: dark)").matches)
      ) {
        document.documentElement.classList.add("dark");
      } else {
        document.documentElement.classList.remove("dark");
      }
    </script>
    <style>
      .bg-custom-1C3738 {
        background-color: #1c3738;
      }
      .bg-custom-F4FFF8 {
        background-color: #f4fff8;
      }
    </style>
  </head>

  <!-- ----------------------------------body--------------------------- -->

  




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


$order = $_SESSION['order_comments'];


    $stmt = $bdd->prepare("SELECT commentaires.*, utilisateurs.login FROM commentaires
                       INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur
                       WHERE commentaires.id_article = :id_article
                       ORDER BY commentaires.date  " . $order);
$stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
$stmt->execute();

$commentaires = $stmt->fetchAll();

//Catégories des commentaires
$id_article= (int) $_GET['id'];
$catName = $bdd->prepare('SELECT cat_art.id_cat, categories.nom 
FROM `cat_art` 
INNER JOIN categories 
ON categories.id = cat_art.id_cat 
WHERE cat_art.id_art = ?');
$catName->execute([$id_article]);

$cat=$catName->fetchAll();

// --------------
    ?>
  
     <body class="   relative  content-center justify-center  max-[800px]:pt40   w-full h-full m-auto bg-gray-200 dark:bg-gray-600 mt-10 max-[800px]:pt50 " >
     <div class="flex flex-col min-h-screen  ">
     <?php include'src/header-blog.php';?>
    
     <section  class=" flex-grow top-20 flex flex-col content-center justify-center  w-full  h-screen m-auto p-4 max-[767px]:pt-80 md:inset-0  md:h-full pt-20">

    <div class="flex flex-col items-center flex-grow w-5/6 bg-white border border-gray-200 rounded-lg shadow max-[767px]:pt-80 md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="assets/illustration1.png" alt="">
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold break-words tracking-tight text-gray-900 dark:text-white">Article - <?php echo $article['titre']; ?></h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 break-words"><?php echo $article['article']; ?></p>
        <div class="flex flex-row mb-1 max-[800px]:flex-col font-normal text-gray-900 dark:text-gray-400"><p>catégorie : 
          <?php foreach ($cat as $item) {?> 
            
          <?php echo $item['nom'];?> <p> &nbsp &nbsp </p>
            
          <?php }?></p>
        </div>
    </div>
</div>
  <!-- ajout commentaire -->
   
<form action="article.php?id=<?php echo $id; ?>" method="post">
   <div class="w-5/6 mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
       <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
           <label for="commentaire" class="sr-only">Votre commentaire</label>
           <textarea maxlength="1024" name="commentaire" id="commentaire" rows="4" class="w-full px-0 text-sm text-gray-900 break-words bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="votre commentaire..." required></textarea>
       </div>
       <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
           <button type="submit" name="submit_commentaire" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-300 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               Envoyer le commentaire
           </button>
           
       </div>
   </div>
</form>
<!-- -----------------------------> 
<a href="?sort=asc">Plus ancien au plus récent</a> | <a href="?sort=desc">Plus récent au plus ancien</a>



   <!-- ----------------affichage des commentaires----------------- -->
 <?php foreach ($commentaires as $commentaire) { ?>
  <div class="block w-5/6 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
   
    <div class="flex flex-row items-center justify-between mb-2">
       <h5 class=" text-sm font-bold tracking-tight text-gray-900 dark:text-white">
          <?php echo $commentaire['login'] . ' a posté le commentaire suivant : ' ?><?php echo $commentaire['date']; ?>
       </h5>

        <div class="flex justify-between">
            <div class="flex  px-2 py-2  dark:border-gray-600">
              <button type="submit" name="modif_commentaire" class="inline-flex items-center py-1 px-2 text-xs font-medium text-center text-white bg-blue-400 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               modifier
              </button>
           
           </div>
           <div class="flex  px-2 py-2  dark:border-gray-600">
             <button type="submit" name="suppr_commentaire" class="inline-flex items-center py-1 px-2 text-xs font-medium text-center text-white bg-red-400 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               Supprimer
             </button>
           </div>
       </div>
    </div>
    <div class="comments">
      <p class="font-normal text-gray-700 dark:text-gray-400"><?php echo $commentaire['commentaire']; ?></p>
    </div>
  </div> 
<?php } ?>


<!-- ------------------fin afficher les commentaires--------------------------------------------- -->

</section>
<?php 
include'src/footer.php';
?>


 </div>

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

</html>



    
