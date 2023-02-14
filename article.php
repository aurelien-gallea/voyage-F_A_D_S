<?php session_start(); ?>
<?php



require_once('src/connectionDB.php');
require_once('classes/Security.php');
require_once('classes/Date.php');


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
  $value = $_POST['modifierCommentaire'];
  $stmt = $bdd->prepare("UPDATE commentaires
  SET commentaires.commentaire = :commentaire
  WHERE commentaires.id = :id
  AND commentaires.id_utilisateur = (SELECT id FROM utilisateurs WHERE id = :id_utilisateur)
  AND commentaires.id_article = :id_article");
 $stmt->execute([$user_id,$value,$id]);
 header('Location: article.php?id='. $id);
 exit;
}
//---à tester

//Effacer commentaire--------------------------------------ok-------------------------------------->


$user_id = (int) $_SESSION['id'];
$id = (int) $_GET['id'];
// $comm_id=$commentaire['id'];


if(isset($_POST['suppr_commentaire'])) {
  $value = $_POST['suppr_commentaire'];
  $stmt = $bdd->prepare("DELETE commentaires FROM commentaires
                         INNER JOIN utilisateurs ON utilisateurs.id = ?
                         WHERE commentaires.id = ? AND commentaires.id_article=?");
 $stmt->execute([$user_id,$value,$id]);
 header('Location: article.php?id='. $id);

 exit();


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
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/voyages.css">
    <link rel="stylesheet" href="css/stylefooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js" integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  

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
if (isset($_POST['sort_order'])) {
  $sort_order2 = $_POST['sort_order'];
} else {
  $sort_order2 = 'asc';
}

// $sort_order2 = $_POST['sort_order'];


    $stmt = $bdd->prepare("SELECT commentaires.*, utilisateurs.login FROM commentaires
                       INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur
                       WHERE commentaires.id_article = :id_article
                       ORDER BY commentaires.date  " . $sort_order2);
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
    
     <section  class=" flex-grow top-20 flex flex-col w-5/6 content-center justify-center place-self-center   h-screen m-auto p-4 max-[767px]:pt-80 md:inset-0  md:h-full pt-20">

    <div class="flex flex-col items-center flex-grow  bg-white border border-gray-200 rounded-lg shadow max-[767px]:pt-80 md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
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
  <!-- ajout commentaire ----------------------------------------------->
   
  <!-- $sort_order -->
  <form action="article.php?id=<?php echo $id; ?>" method="post">
   <div class=" mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
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
<!-- <a href="?sort=asc">Plus ancien au plus récent</a> | <a href="?sort=desc">Plus récent au plus ancien</a> -->
<div class="flex  px-2 py-2  dark:border-gray-600">
<form action="" method="post">
<!-- <button type="submit"id="sort-button" name="$sort_order" class="inline-flex items-center py-1 px-2 text-xs font-medium text-center bg-gray-50 w-20">Trier les commentaires</button> -->
</form>
</div>
   <!-- ----------------affichage des commentaires----------------- -->
   <form action="" method="post">
 <?php foreach ($commentaires as $commentaire) { ?>
  <div>

  </div>
  <div class="block  p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
   
    <div class="flex flex-row items-center justify-between mb-2">
       <h5 class=" text-sm font-bold tracking-tight text-gray-900 dark:text-white"> 
          <?php echo $commentaire['login'] . ' a posté le commentaire suivant : le ' ?><?php echo DateToFr::dateFr($commentaire['date']); ?>
       </h5>

       <div></div>
       <!-- <button id="toggle-div"class="update"name="upadate"value="<?= $commentaire['id'] ?>">modifier</button> -->

       <!-- ----textarea modification de commentaire--- -->
       <div id="my-div" style=" " class="hidden artChange w-5/6 mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
       <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
           <label for="commentaire" class="sr-only">Votre commentaire</label>
           <textarea maxlength="1024" name="commentaire" id="commentaire" rows="4" class="w-full px-0 text-sm text-gray-900 break-words bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="votre commentaire..."   ></textarea>
       </div>
       <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
           <!-- <button type="submit" name="submit_commentaire" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-300 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               modifier le commentaire
           </button> -->
           
       </div>
   </div>
   <!-- ---------------------------------- -->
   <script>
//   document.getElementById("toggle-div").addEventListener("click", function(){
// var div = document.getElementById("my-div");
// if (div.style.display === "none") {
// div.style.display = "block";
// } else {
// div.style.display = "none";
// }
// });

// buttons update
const artContainer = document.querySelectorAll('.artContainer'); // div pour cacher le titre + boutton update/delete
const update = document.querySelectorAll('#toggle-div'); // boutton pour cacher la div 
const btnContainer = document.querySelectorAll('.btnContainer');
const artChange = document.querySelectorAll('.my-div');
const cancelBtn = document.querySelectorAll('.cancelBtn');
const confirmBtn = document.querySelectorAll('.confirmBtn');
block2.style.display = "none"; // on cache par défaut le block2: le changement de mdp

function showHidden(button) {
    
    for (let i = 0; i < button.length; i++) {
    
        button[i].addEventListener('click', (e) => {
            e.preventDefault();
    
                artChange[i].classList.toggle('hidden');
                btnContainer[i].classList.toggle('hidden');
                artContainer[i].classList.toggle('hidden');
            });
        }
    }

</script>
  <div class="flex justify-between">
          <div class="flex  px-2 py-2  dark:border-gray-600">
              <!-- <button type="submit" value="<?= $commentaire['id'] ?>"name="modif_commentaire" class="inline-flex items-center py-1 px-2 text-xs font-medium text-center text-white bg-blue-400 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               modifier
              </button> -->
           
          </div>

           <div class="flex  px-2 py-2  dark:border-gray-600">
            <!-- bouton modal -->
  </div>

<!-- <button data-modal-target="staticModal" data-modal-toggle="staticModal"
           class="inline-flex items-center py-1 px-2  text-white bg-red-900 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs  text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Modifier
</button> -->
             
             
 </div>


<!-------- en modal ----click>modal>etes vous sure de suppr> choix suppr ou close------------------------------------->


<button data-modal-target="popup-modal" data-modal-toggle="popup-modal" 
           class="inline-flex items-center py-1 px-2  text-white bg-red-900 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs  text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Supprimer
</button>

            <!-- -----fenetre modal supression--- -->
  <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Fermer</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Etes vous sûre d'effacer ce commentaire ?</h3>
                <button type="submit" value="<?= $commentaire['id'] ?>"name="suppr_commentaire" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    OUI!
                </button>
                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">mmh.. non..</button>
            </div>
        </div>
    </div>

                <!-- -----fenetre modal modification--- -->
<!-- Main modal -->
<div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                   Modification
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
            

            <!-- -----modif form--- -->
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="staticModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-hide="staticModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
            </div>
        </div>
    </div>

</div>



       </div>
    </div>
    <div class="comments">
      <p class="font-normal text-gray-700 dark:text-gray-400"><?php echo $commentaire['commentaire']; ?></p>
    </div>
  </div> 
<?php } ?>
 </form>
 <?php
  if (isset($_POST['suppr_commentaire'])) {
    $comment_id = $_POST['suppr_commentaire'];
    if ($_SESSION['id'] == $commentaires[$comment_id]['id_utilisateur']) {
      unset($commentaires[$comment_id]);
      // sauvegarder les modifications dans la base de données
    }
  }
?>

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

<script src="src/ordrecom.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
   
  </body>

</html>



    
