<?php
session_start();
require("src/connectionDB.php");


$bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage;charset=utf8", "root", "");

if (isset($_POST['tri'])) {
  try {
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage;charset=utf8", "root", "");
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
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage;charset=utf8", "root", "");
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
    <link rel="stylesheet" href="articles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/voyages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@0.2.28/bundled/lenis.js"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css"
      rel="stylesheet"
    />
    <title>Articles</title>
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
  <?php require_once('src/header-blog.php'); ?>
  <!-- ----------------------------------body--------------------------- -->

  <body>
 
   <br>
   <br> 
   <br>
   <form action="articles2.php" method="post">
  <select name="tri">
  <option value="date_asc">Date croissante</option>
  <option value="date_desc">Date décroissante</option>
    <option value="login">Utilisateur</option>
    <option value="categories">Catégories</option>
  </select>
  <br>
  <input type="submit" value="Trier">
</form>
<body>
<style>
  
        /* Ajoutez une couleur de fond pour le conteneur d'articles */
        .articles {
            background-color: rgba(255, 255, 255, 0.5);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 0 auto;
            margin-top: 40px;
        }

        /* Ajoutez une bordure pour les articles individuels */
        .article {
            width: 50%;
            border: 3px solid #000f08;
            border-radius: 55px;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            margin: 20px auto;
            
            
        }
        body {
            background-image: url('assets/beach.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
}
        h1 {
            font-size: 35px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            text-align: left;
            margin-top: -100px;
            margin-bottom: -10px;
            margin-left: 330px;
            color: #fff;
            text-decoration: underline;

       /* Modifiez la taille de police et la police pour le titre de l'article */
        }
        .article h2 {
            font-size: 24px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        
        /* Modifiez la couleur du texte pour la date */
        .article h3 {
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            margin-bottom: 10px;
            text-align: right;
            color: #333;
        }

         /* Modifiez la couleur du texte pour le nom d'utilisateur */
         .article h4 {
            font-size: 16px;
            font-family: 'Georgia', sans-serif;
            margin-bottom: 10px;
            text-align: left;
            color: #333;
        }
        /* Modifiez la couleur du texte pour le nom d'utilisateur */
        .article h5 {
         display: inline-block;
         font-size: 16px;
         font-family: 'Georgia', sans-serif;
         margin-bottom: 30px;
         text-align: right;
         color: #333;
}

        
        /* Modifiez la taille de police et la police pour le contenu de l'article */
        .article p {
            font-size: 16px;
            font-family: Georgia, serif;
            line-height: 1.5;
            margin-bottom: 15px;
            text-align: left;
            
        }

        /* Modifiez la couleur de fond pour le bouton "Afficher plus" */
        .article a {
            font-size: 18px;
            display: grid;
            padding: 3px 5px;
            background-color: #1c3738;
            color: #f4fff8;
            border-radius: 55px;
            text-decoration: none;
        }
        form {
  width: 80%;
  margin: 0 auto;
  text-align: center;
}

select {
  width: 20%;
  padding: 10px;
  font-size: 16px;
  margin-bottom: 20px;
  border-radius: 5px;
  text-align: center;
}

input[type="submit"] {
  background-color: #f4fff8;
  color: black;
  padding: 5px 10px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
}

@media (max-width: 767px) {
  form {
    width: 100%;
  }
  
  select {
    width: 100%;
  }
}



</style>
    
    <br>
  <div class="articles">
  </div>
  
  <?php foreach ($articles as $article) : 
  // Requête pour récupérer les logins des utilisateurs
  $user = $bdd->prepare('SELECT login FROM utilisateurs WHERE id= ?');
  $user->execute([$article['id_utilisateur']]);
  $result = $user->fetch();

  // Requête pour récupérer les noms des catégories associées à un article
  $catName = $bdd->prepare('SELECT categories.nom FROM `cat_art` INNER JOIN categories ON categories.id = cat_art.id_cat WHERE cat_art.id_art = ?');
  $catName->execute([$article['id']]);
  
  setlocale(LC_ALL, 'fr_FR.UTF-8');
  $date = strftime('%d/%m/%Y à %I:%M', strtotime($article['date']));

  ?>
  
  <div class="article">
    <h2><?= htmlspecialchars($article['titre']) ?></h2>
    <h3><?= htmlspecialchars($date) ?></h3>
    <h4><?= htmlspecialchars($result['login']) ?></h4>
    <?php while ($cat = $catName->fetch()): ?>
      <h5><?= htmlspecialchars($cat['nom']) ?></h5>
    <?php endwhile; ?>
    <p><?= htmlspecialchars($article['article']) ?></p>
    <a href="article.php?id=<?= $article['id'] ?>">Afficher plus</a>
  </div>
<?php endforeach; ?>

</div>
  <br>
  <br>
  <footer class="text-white">
  <link rel="stylesheet" href="stylefooter.css" />
  <div class="main-content">
    <div class="left box">
      <h2>A Propos</h2>
      <div class="content">
        <p>Tasty Trip, site de voyage gourmand.</p>
        <div class="social">
          <a href="https://facebook.com/coding.np"><span class="fab fa-facebook-f"></span></a>
          <a href="#"><span class="fab fa-twitter"></span></a>
          <a href="https://instagram.com/coding.np"><span class="fab fa-instagram"></span></a>
          <a href="https://youtube.com/c/codingnepal"><span class="fab fa-youtube"></span></a>
          <a href="https://github.com/c/codingnepal"><span class="fab fa-github"></span></a>
        </div>
      </div>
    </div>
    <div class="center box">
      <h2>Addresse</h2>
      <div class="content">
        <div class="place">
          <span class="fas fa-map-marker-alt"></span>
          <span class="text-white ml-2 inline-block">Toulon, France</span>
        </div>
        <div class="phone">
          <span class="fas fa-phone-alt"></span>
          <span class="text-white ml-2 inline-block">+089-765432100</span>
        </div>
        <div class="email">
          <span class="fas fa-envelope"></span>
          <span class="text-white ml-2 inline-block">abc@example.com</span>
        </div>
      </div>
    </div>
    <div class="right box">
      <h2>Nous Contacter</h2>
      <div class="content">
        <a href="contact.php" class="text-white ml-2 inline-block">Nous Contacter ici</a>
      </div>
    </div>
  </div>
  <div class="bottom">
  <div class="container">
    <span class="text-white ml-4 inline-block">Tasty Trip | </span>
    <span class="text-white inline-block">2023 All rights reserved.</span>
  </div>
</div>

</footer>
    

</html>


