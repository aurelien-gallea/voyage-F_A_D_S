<?php
session_start();
$id = 33; 

$bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage;charset=utf8", "root", "");

if (isset($_POST['tri'])) {
  try {
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage2;charset=utf8", "root", "");
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
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=blog_voyage2;charset=utf8", "root", "");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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

  <!-- ----------------------------------body--------------------------- -->

  <body>
 
  <header class="fixed top-0 left-0 right-0 z-50 mb-15 bg-white  dark:bg-gray-900 ">
    <nav
      class="    px-2 bg-blue/54 shadow-xl z-2  border-gray-200 dark:bg-gray-900 dark:border-gray-700"
    >
      <div
        class="  relative container flex flex-wrap items-center justify-between content-center mx-auto"
      >
        <a href="#" class="flex items-center pl-3">
          <img src="assets/logo2.png" class="h-8 mr-4 sm:h-14" alt="TastyTrip" />
          <span
            class="self-center text-xl font-Unbounded whitespace-nowrap dark:text-white"
            >TastyTrip</span
          >
        </a>
        <button
          data-collapse-toggle="navbar-dropdown"
          type="button"
          class="  top-10 inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="navbar-dropdown"
          aria-expanded="false"
        >
          <span class="sr-only">Menu Principal</span>
          <svg
            class="w-6 h-6"
            aria-hidden="true"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </button>
        <div class=" hidden w-full md:block md:w-auto" id="navbar-dropdown">
          <ul
            class=" flex flex-col p-4 mt-4 items-center border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white opacity-85 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
          >
            <li>
              <a
                href="index.html"

                class="block py-2 pl-3 pr-4 text-bg-custom-1C3738 bg-blue-30 rounded md:bg-transparent md:text-grey md:p-0 md:dark:text-white dark:bg-bg-custom-1C3738 md:dark:bg-transparent"
                aria-current="page"
                >Accueil</a
              >
            </li>
            <li>
              <a
                href="../articles.php"
                class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                > articles</a
              >
            </li>
            <li>
              <a
                href="../creer-article.php"
                class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                >créer un article</a
              >
            </li>
          
            <li>
              <a
                href="../profil.php"
                class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                >profil</a
              >
            </li>
            <li>
              <a
                href="../admin.php"

                class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                >admin</a
              >
            </li>
            <li>
              <a
                href="logout.php"


                class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                >Se déconnecter</a
              >
            </li>
            <li>
              <button
                title="toggle navigation"
                id="theme-toggle"
                type="button"
                class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
              >
                <svg
                  id="theme-toggle-dark-icon"
                  class="hidden w-5 h-5"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                  ></path>
                </svg>
                <svg
                  id="theme-toggle-light-icon"
                  class="hidden w-5 h-5"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- ---------------------------------- fin de nav----------------------------->
   </header>
   <br>
   <br> 
   <br>
   <form action="articles2.php" method="post">
  <select name="tri">
    <option value="date_desc">Date décroissante</option>
    <option value="date_asc">Date croissante</option>
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
            background-color: rgba(255, 255, 255, 0.7);
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
         margin-bottom: 10px;
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
           width: 500px;
           margin: 0 auto;
           text-align: center;
}

select {
  width: 40%;
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


</style>
    <h1>Articles</h1>
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
  
  ?>
  
  <div class="article">
    <h2><?= htmlspecialchars($article['titre']) ?></h2>
    <h3><?= htmlspecialchars($article['date']) ?></h3>
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
  <footer>
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
              <link href="stylefooter.css" rel="stylesheet"/>
            </div>
          </div>
        </div>
        <div class="center box">
          <h2>Addresse</h2>
          <div class="content">
            <div class="place">
              <span class="fas fa-map-marker-alt"></span>
              <span class="text">Toulon, France</span>
            </div>
            <div class="phone">
              <span class="fas fa-phone-alt"></span>
              <span class="text">+089-765432100</span>
            </div>
            <div class="email">
              <span class="fas fa-envelope"></span>
              <span class="text">abc@example.com</span>
            </div>
          </div>
        </div>
        <div class="right box">
          <h2>Nous Contacter</h2>
          <div class="content">
            <form action="#">
              <div class="email">
                <div class="text">Email *</div>
                <input type="email" required>
              </div>
              <div class="msg">
                <div class="text">Message *</div>
                <textarea rows="2" cols="25" required></textarea>
              </div>
              <div class="btn">
                <button type="submit">Envoyer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="bottom">
      
          <span class="credit">Tasty Trip | </span>
          <span class="far fa-copyright"></span><span> 2023 All rights reserved.</span>
        
      </div>
    </footer>
</body>
</html>


