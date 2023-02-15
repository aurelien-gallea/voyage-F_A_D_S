<!DOCTYPE html>
<html>
<head>
	<title>Bienvenue sur Tasty Trip</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@latest/dist/tailwind.min.css">

    <link rel="stylesheet" href="css/voyages.css">
    <link rel="stylesheet" href="stylefooter.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@0.2.28/bundled/lenis.js"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css"
      rel="stylesheet"
    />
</head>
<?php require_once('src/header.php'); ?>

<br>
<br>
<br>
<body class="bg-gray-100">
  <h1 class="text-3xl font-bold mb-8">Bienvenue sur Tasty Trip</h1>
  <ul class="grid grid-cols-2 gap-4">
    <li class="bg-white rounded-lg shadow-md overflow-hidden">
      <a href="usa.php">
        <img src="assets/vignette usa.jfif" alt="USA" class="w-full h-48 object-cover">
        <span class="block text-lg font-medium text-gray-800 py-4 px-6">Visiter les USA</span>
      </a>
    </li>
    <li class="bg-white rounded-lg shadow-md overflow-hidden">
      <a href="espagne.php">
        <img src="assets/vignette espagne.jfif" alt="Espagne" class="w-full h-48 object-cover">
        <span class="block text-lg font-medium text-gray-800 py-4 px-6">Visiter l'Espagne</span>
      </a>
    </li>
    <li class="bg-white rounded-lg shadow-md overflow-hidden">
      <a href="senegal.php">
        <img src="assets/vignette sénégal.jfif" alt="Sénégal" class="w-full h-48 object-cover">
        <span class="block text-lg font-medium text-gray-800 py-4 px-6">Visiter le Sénégal</span>
      </a>
    </li>
    <li class="bg-white rounded-lg shadow-md overflow-hidden">
      <a href="inde.php">
        <img src="assets/vignette inde.jfif" alt="Inde" class="w-full h-48 object-cover">
        <span class="block text-lg font-medium text-gray-800 py-4 px-6">Visiter l'Inde</span>
      </a>
    </li>
    <li class="bg-white rounded-lg shadow-md overflow-hidden">
      <a href="articles.php">
        <img src="assets/vignette blog.jpg" alt="Blog" class="w-full h-48 object-cover">
        <span class="block text-lg font-medium text-gray-800 py-4 px-6">Blog</span>
      </a>
    </li>
  </ul>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="src/tailwind-need-body.js"></script> 
</body>
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
