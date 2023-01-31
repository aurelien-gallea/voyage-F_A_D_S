<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Trip</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
  <nav class="navbar">
    <div class="content">
      <div class="logo">
        <a href="#">Tasty Trip</a>
      </div>
      <ul class="menu-list">
        <div class="icon cancel-btn">
          <i class="fas fa-times"></i>
        </div>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="#">Continents</a></li>
   <select class="dropdown">
  <option value="">Sélectionnez un Continent</option>
  <option value="afrique">Afrique</option>
  <option value="amerique">Amérique</option>
  <option value="europe">Europe</option>
  <option value="asie">Asie</option>
</select>

        <li><a href="#">Membres</a></li>
         <select class="dropdown">
  <option value="">Sélectionnez un Membre</option>
  <option value="afrique">Sylvia</option>
  <option value="afrique">Aurelien</option>
  <option value="amerique">Dylan</option>
  <option value="europe">Florian</option>
</select>
      
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </nav>
  <div class="banner"></div>
  <div class="about">
    <div class="content">
      <div class="title">Tasty Trip vous souhaite la bienvenue.</div>
      
    </div>
  </div>

  <script>
    const body = document.querySelector("body");
    const navbar = document.querySelector(".navbar");
    const menuBtn = document.querySelector(".menu-btn");
    const cancelBtn = document.querySelector(".cancel-btn");
    menuBtn.onclick = ()=>{
      navbar.classList.add("show");
      menuBtn.classList.add("hide");
      body.classList.add("disabled");
    }
    cancelBtn.onclick = ()=>{
      body.classList.remove("disabled");
      navbar.classList.remove("show");
      menuBtn.classList.remove("hide");
    }
    window.onscroll = ()=>{
      this.scrollY > 20 ? navbar.classList.add("sticky") : navbar.classList.remove("sticky");
    }
  </script>
  </body>
</html>