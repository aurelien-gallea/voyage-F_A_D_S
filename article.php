<?php
session_start();
require_once('src/connectionDB.php');
require_once('classes/Security.php');
require_once('classes/Date.php');
require_once('classes/Verifycom.php');
require_once('classes/Update.php');


if (isset($_GET['id'])) {
  $id = (int) $_GET['id'];
  $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
}

// nouveau commentaire
if (isset($_POST['submit_commentaire'])) {
  $commentaire = htmlspecialchars($_POST['commentaire']);
  $login = $_SESSION['login'];
  $stmt2 = $bdd->prepare(" INSERT INTO commentaires (id_utilisateur, id_article, commentaire, date)
  SELECT utilisateurs.id, :id_article, :commentaire, NOW()
  FROM utilisateurs
  WHERE utilisateurs.login = :login");
  $stmt2->bindParam(':id_article', $id, PDO::PARAM_INT);
  $stmt2->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
  $stmt2->bindParam(':login', $login, PDO::PARAM_STR);
  $stmt2->execute();  

  // Redirection vers la même page pour afficher les commentaires actualisés
  header('Location: article.php?id='. $id);
  exit;
}


//--------------modifier le commentaire
require('src/connectionDB.php');

$id = (int) $_GET['id'];
$coms = $bdd->prepare('SELECT * FROM commentaires WHERE id_article = :id');
$coms->bindParam(':id', $id, PDO::PARAM_INT);
$coms->execute();
$commentaires = $coms->fetchAll(PDO::FETCH_ASSOC);

for ($d = 0; $d < count($commentaires); $d++) {
  $commentaire = $commentaires[$d];
  if (isset($_POST['modif_commentaire']) && isset($_POST['id_commentaire']) && $_POST['id_commentaire'] == $commentaire['id']) {
    $newCom = htmlspecialchars($_POST['commentaire-'.$commentaire['id']]);
    if ($newCom != $commentaire['commentaire']) {
      $stmt = $bdd->prepare("UPDATE commentaires SET commentaire = :commentaire WHERE id = :id AND id_utilisateur = :id_utilisateur AND id_article = :id_article");
      $stmt->bindParam(':commentaire', $newCom, PDO::PARAM_STR);
      $stmt->bindParam(':id', $commentaire['id'], PDO::PARAM_INT);
      $stmt->bindParam(':id_utilisateur', $user_id, PDO::PARAM_INT);
      $stmt->bindParam(':id_article', $id, PDO::PARAM_INT);
      $stmt->execute();
      header('Location: article.php?id='. $id);
      exit;
    }
  }

  if (isset($_POST['modif_commentaire']) && isset($_POST['commentaire']) && isset($_POST['commentaire-'.$commentaire['id']])) {
    $newCom = htmlspecialchars($_POST['commentaire-'.$commentaire['id']]);
    if ($newCom != $commentaire['commentaire']) {
        $stmt = $bdd->prepare("UPDATE commentaires SET commentaire = :commentaire WHERE id = :id AND id_utilisateur = :id_utilisateur AND id_article = :id_article");
        $stmt->bindParam(':commentaire', $newCom, PDO::PARAM_STR);
        $stmt->bindParam(':id', $commentaire['id'], PDO::PARAM_INT);
        $stmt->bindParam(':id_utilisateur', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_article', $id, PDO::PARAM_INT);
        $stmt->execute();
        header('Location: article.php?id='. $id);
 echo "newCom = " . $newCom . "<br>";
echo "commentaire_id = " . $commentaire_id . "<br>";
echo "user_id = " . $user_id . "<br>";
echo "article_id = " . $article_id . "<br>";
echo "UPDATE commentaires SET commentaire = '" . $newCom . "' WHERE id = " . $commentaire_id . " AND id_utilisateur = " . $user_id . " AND id_article = " . $article_id;
echo $stmt->rowCount() . " lignes affectées";
        
    }
    
 exit;
  }

}

//Effacer commentaire
if (isset($_POST['suppr_commentaire'])) {
  $id_commentaire = $_POST['suppr_commentaire'];
  $query = "SELECT * FROM commentaires WHERE id = :id";
  $statement = $bdd->prepare($query);
  $statement->bindValue(':id', $id_commentaire);
  $statement->execute();
  $commentaire = $statement->fetch();
  
  // Vérifier si l'utilisateur actuel est l'auteur du commentaire
  if ($commentaire['id_utilisateur'] == $_SESSION['id']) {
      $query = "DELETE FROM commentaires WHERE id = :id";
      $statement = $bdd->prepare($query);
      $statement->bindValue(':id', $id_commentaire);
      $statement->execute();
  }
}


?>


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
  $sort_order2 = 'desc';
}

    $stmt = $bdd->prepare("SELECT commentaires.*, utilisateurs.login FROM commentaires
                       INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur
                       WHERE commentaires.id_article = :id_article
                       ORDER BY commentaires.id  " . $sort_order2);
$stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
$stmt->execute();
$commentaires = $stmt->fetchAll();

//Catégories des articles
$id_article= (int) $_GET['id'];
$catName = $bdd->prepare('SELECT cat_art.id_cat, categories.nom 
FROM `cat_art` 
INNER JOIN categories 
ON categories.id = cat_art.id_cat 
WHERE cat_art.id_art = ?');
$catName->execute([$id_article]);
$cat=$catName->fetchAll();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js" integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     
     
    <title>article</title>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/stylefooter.css">
    <!-- <link rel="stylesheet" href="css/voyages.css"> -->
    <link rel="stylesheet" href="css/tailwind-need.css">
    <script src="src/tailwind-need.js"></script>
    <link href="assets/favicon.ico" rel="icon" type="image/x-icon" />
  </head>


  <!-- ----------------------------------body--------------------------- -->

     <body class="relative  content-center justify-center  max-[800px]:pt40   w-full h-full m-auto bg-gray-200 dark:bg-gray-600 mt-28 max-[800px]:pt50 " >
    
     <div class="flex flex-col">
     <?php include'src/header-blog.php';?>
     <!-- <?= var_dump($commentaires);?> -->
    
     <section  class=" flex-grow top-20 flex flex-col w-5/6 content-center justify-center place-self-center    m-auto  md:inset-0   ">

    <div class="flex flex-col items-center   bg-white border border-gray-200 rounded-lg shadow max-[767px]:pt-1 md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
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

  <!----------------------|| Ajout commentaire ||----------------------------------------------->
   

  <form action="article.php?id=<?php echo $id; ?>" method="post">
   <div class=" mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
       <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
           <label for="commentaire" class="sr-only">Votre commentaire</label>
           <textarea maxlength="1024" name="commentaire" id="commentaire" rows="4" class="w-full px-0 text-sm text-gray-900 dark:text-white break-words bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="votre commentaire..." required></textarea>
       </div>
       <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
           <button type="submit" name="submit_commentaire" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-color-2 rounded-lg focus:ring-4 focus:ring-color-4 dark:focus:ring-color-5 hover:bg-color-3">
               Envoyer le commentaire
           </button>
           <p class="text-gray-400 dark:text-white" id="char-count"></p> 
       </div>
   </div>
</form>

<script>
        const textarea = document.getElementById("commentaire");
        const maxlength = 1024;
        const charCount = document.getElementById("char-count");
        charCount.innerText = `${maxlength - textarea.value.length} caractères restants`;
        textarea.parentNode.insertBefore(charCount, textarea.nextSibling);
        textarea.addEventListener("input", () => {
         const remaining = maxlength - textarea.value.length;
         charCount.innerText = `${remaining} caractères restants`;
        });
</script>
   <!-- ----------------affichage des commentaires----------------- -->
<form action="" method="post">
    
  <?php for ($i = 0; $i < sizeof($commentaires); $i++) {
    $commentaire = $commentaires[$i];
    $is_author = $commentaire['id_utilisateur'] === $user_id;?>        
 <div class="flex items-center justify-between px-4 py-2 border-gray-200 dark:border-gray-700  dark:text-gray-400">
     
        <div class="block p-6 bg-white border border-gray-200 rounded-lg w-full shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div class="flex flex-row items-center justify-between mb-2">
               <h5 class="text-sm font-bold tracking-tight text-gray-900 dark:text-white"> 
                  <?php echo $commentaire['login'] . ' a posté le commentaire suivant : le ' ?><?php echo DateToFr::dateFr($commentaire['date']); ?>
               </h5>              
   
               <!-------- Modal toggle ------------->
            <div class="flex  justify-around ">
                <!-- Bouton Modifier -->
                <?php if ($is_author) { ?>
                  <button data-modal-target="staticModal2_<?= $i ?>" data-modal-toggle="staticModal2_<?= $i ?>" class="inline-flex items-center py-1 px-2 m-1  text-white bg-color-3 hover:bg-color-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs text-center dark:bg-color-3 dark:hover:bg-color-5 dark:focus:ring-color-2" type="button">
                   Modifier <?= $commentaire['id']?>
                  </button>
                <?php } ?>

             <!-- Bouton Supprimer -->
                 <?php if ($is_author) { ?>
                    <button data-modal-target="popup-modal_<?= $i ?>" data-modal-toggle="popup-modal_<?= $i ?>" data-comment-id="<?= $commentaire['id'] ?>" class="inline-flex items-center py-1 px-2 m-1 text-white bg-color-3 hover:bg-color-2 focus:ring-4 focus:outline-none focus:ring-color-4 font-medium rounded-lg text-xs text-center dark:bg-color-3 dark:hover:bg-color-5 dark:focus:ring-color-2" type="button">
                          Supprimer
                    </button>
                 <?php } ?>
            </div>
        </div>
               <!-- Fenetre modal suppression -->
            <div id="popup-modal_<?= $i ?>" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
              <div class="relative w-full h-full max-w-md md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal_<?= $i ?>">
                       <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Fermer</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Etes vous sûre d'effacer ce commentaire ?</h3>
              
                        <button type="submit" value="<?= $commentaire['id'] ?>" name="suppr_commentaire" data-modal-hide="popup-modal_" 
                             class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                             OUI! 
                        </button>
                        <button  data-modal-hide="popup-modal_<?= $i ?>"type="button" 
                             class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">mmh.. non..
                        </button>
                    </div>
                </div>
              </div>
            </div>
         
    <!------------------------------------------------modal Modifier--------------------------------->
    <?php if ($is_author) { ?>

    <div id="staticModal2_<?= $i ?>" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
          <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                 <!-- Modal header -->
                 <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                     <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                          Modifier le commentaire
                     </h3>
                     <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal2_<?= $i ?>">
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                     </button>
                 </div>
                   <!-- Modal body -->
                 <div class="p-6 space-y-6">
                     <!-- ----textarea modification de commentaire--- -->
                     <div class=" artChange  mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                         <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                              <label for="commentaire" class="sr-only">Votre commentaire</label>
                              <!-- commentaire id         faire un tableau  -->
                              <textarea maxlength="1024" name="commentaire-<?= $commentaire['id'] ?>" id="commentaire" rows="4" class="w-full px-0 text-sm text-gray-900 break-words bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="votre commentaire..."   >
                                   <?php echo $commentaire['commentaire']; ?>
                              </textarea>
                         </div>
                     </div>
                 </div>

                  <!-- Modal footer -->
                 <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                   <button data-modal-hide="staticModal2_" type="submit" value="<?= $commentaire['id'] ?>"name="modif_commentaire"class="text-white bg-color-5 hover:bg-color-2 focus:ring-4 focus:outline-none focus:ring-color-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-color-3 dark:hover:bg-color-5 dark:focus:ring-color-2">Modifier</button>
                   <button data-modal-hide="staticModal2_<?= $i ?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-color-4 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Annuler</button>
                 </div>
            </div>
        </div>
    </div>
    <!-- ----------------------------fin du modal modifier -------------------------- -->
    <?php } ?>    
    
    <!-- Afficher le commentaire -->
        <div class="comments">
            <div id="comment-<?= $commentaire['id'] ?>" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-color-2 hover:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <p class="font-normal text-gray-700 dark:text-gray-400 break-words"><?php echo $commentaire['commentaire']; ?></p>
            </div>
        </div>
    </div>
</div> 
 <?php } ?>
</form>

 <?php
if (isset($_POST['suppr_commentaire'])) {
  $comment_id = $_POST['suppr_commentaire'];
  if (array_key_exists($comment_id, $commentaires) && $_SESSION['id'] == $commentaires[$comment_id]['id_utilisateur']) {
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

    <script src="src/tailwind-need-body.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
   
  </body>

</html>



    