<?php
session_start();
require("src/connectionDB.php");

if (isset($_POST['tri'])) {
  try {
    switch ($_POST['tri']) {
      case 'date_desc':
        $articles = $bdd->prepare('SELECT * FROM articles ORDER BY date DESC');
        break;
      case 'date_asc':
        $articles = $bdd->prepare('SELECT * FROM articles ORDER BY date ASC');
        break;
      case 'login':
        $articles = $bdd->prepare('SELECT articles.*, utilisateurs.login FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id ORDER BY utilisateurs.login');
        break;
      case 'categories':
        $articles = $bdd->prepare('SELECT articles.*, categories.nom FROM articles INNER JOIN cat_art ON articles.id = cat_art.id_art INNER JOIN categories ON categories.id = cat_art.id_cat ORDER BY categories.nom');
        break;
    }
    $articles->execute();
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
} else {
  try {
    $articles = $bdd->prepare('SELECT * FROM articles');
    $articles->execute();
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/voyages.css">
    <link rel="stylesheet" href="css/articles.css">
    <link rel="stylesheet" href="css/tailwind-need.css">
    <script src="src/tailwind-need.js"></script>
    <link href="assets/favicon.ico" rel="icon" type="image/x-icon" />
    <title>Articles</title>

  </head>
  <?php require_once('src/header-blog.php'); ?>
  <!-- ----------------------------------body--------------------------- -->

  <body class="bg-color-2 dark:bg-color-5 bg-center bg-no-repeat bg-cover">
 
   <br>
   <br> 
   <br>
   <form action="articles.php" method="post" class="max-w-sm mx-auto">
  <div class="flex flex-col mb-4">
    <label for="tri" class="mb-2 font-bold text-lg text-gray-900">Trier par:</label>
    <select name="tri" id="tri" class="px-3 py-2 border-2 border-gray-400 rounded-lg focus:outline-none focus:border-blue-500">
      <option value="date_asc" class="text-center">Date croissante</option>
      <option value="date_desc" class="text-center">Date d??croissante</option>
      <option value="login" class="text-center">Utilisateur</option>
      <option value="categories" class="text-center">Cat??gories</option>
    </select>
  </div>
  <div class="flex justify-center">
    <button type="submit" class="bg-color-1 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-color-3">Trier</button>
  </div>
</form>

</body>

  
 <br>
  <div class="articles">
  </div>
  
  <?php foreach ($articles as $article) : 
  // Requ??te pour r??cup??rer les logins des utilisateurs
  $user = $bdd->prepare('SELECT login FROM utilisateurs WHERE id= ?');
  $user->execute([$article['id_utilisateur']]);
  $result = $user->fetch();

  // Requ??te pour r??cup??rer les noms des cat??gories associ??es ?? un article
  $catName = $bdd->prepare('SELECT categories.nom FROM `cat_art` INNER JOIN categories ON categories.id = cat_art.id_cat WHERE cat_art.id_art = ?');
  $catName->execute([$article['id']]);
  
  setlocale(LC_ALL, 'fr_FR.UTF-8');
  $date = strftime('%d/%m/%Y ?? %I:%M', strtotime($article['date']));

  ?>
  
  <div class="article bg-white shadow-md rounded-lg p-4 md:p-6 lg:p-8 xl:p-10">
  <h2 class="text-2xl lg:text-3xl font-bold mb-2"><?= htmlspecialchars($article['titre']) ?></h2>
  <h3 class="text-lg mb-4"><?= htmlspecialchars($date) ?></h3>
  <h4 class="text-md mb-2"><?= htmlspecialchars($result['login']) ?></h4>
  <?php while ($cat = $catName->fetch()): ?>
    <h5 class="text-sm mb-2"><?= htmlspecialchars($cat['nom']) ?></h5>
  <?php endwhile; ?>
  <p class="text-base leading-7"><?= htmlspecialchars($article['article']) ?></p>
  <a href="article.php?id=<?= $article['id'] ?>" class="inline-block text-blue-500 hover:text-blue-700 mt-4 md:mt-6 lg:mt-8 xl:mt-10">Afficher plus</a>
</div>

<?php endforeach; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
<script src="src/tailwind-need-body.js"></script>
</body>
</div>
  <br>
  <br>
  <?php require_once("src/footer.php");
  ?>
    
  </html>


