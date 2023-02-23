<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Bienvenue sur Tasty Trip</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="css/voyages.css"> -->
    <link rel="stylesheet" href="css/tailwind-need.css">
    <script src="src/tailwind-need.js"></script>
    <link href="assets/favicon.ico" rel="icon" type="image/x-icon" />
    <script>
      tailwind.config = { darkMode: 'class',
  // ...
  content: [],
        theme: {
          extend: {
            colors: {
        'color-1': '#111827',
        'color-2': '#8BAAAD',
        'color-3': '#90323D',
        'color-4': '#FCF6B1',
        'color-5': '#F18F01AD',
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
</head>
<?php require_once('src/header.php'); ?>

<br>
<br>
<br>
<body class="bg-gray-100">
<div style="text-align: center;">
  <h1 class="text-3xl font-bold mb-8">Bienvenue sur Tasty Trip</h1>
</div>

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
    <li class="bg-white rounded-lg shadow-md overflow-hidden">
      <a href="contact.php">
      <img src="assets/vignettecontact.png" alt="Contact" class="w-full h-48 object-cover" style="object-position: center bottom;">

        <span class="block text-lg font-medium text-gray-800 py-4 px-6">Nous Contacter</span>
      </a>
    </li>
  </ul>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="src/tailwind-need-body.js"></script>
</body>
<br>
  <?php require_once("src/footer.php");
  ?>
   
</html>
