<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/stylefooter.css">
    <link rel="stylesheet" href="css/voyages.css">
    <link rel="stylesheet" href="css/tailwind-need.css">
    <script src="src/tailwind-need.js"></script>
    <link href="assets/ind-favicon.png" rel="icon" type="image/x-icon" />
    <title>L'Inde, un voyage spirituel | Tasty Trip</title>
</head>

<body>
    <?php require_once('src/header.php'); ?>
<div>
    <!-- Parallax -->
    <section class="pt-40 pb-64 relative">
        <div class="absolute w-full h-full top-0 left-0 bg-cover bg-center bg-no-repeat opacity-100 bg-fixed" style="background-image:url(assets/inde.jpeg)"></div>
    </section>

    <section class="h-[500px]">
    <h1 class="text-4xl font-bold text-center leading-none tracking-tight color-3 md:text-5xl lg:text-6xl">L'Inde, un voyage spirituel</h1>
    </section>

    <!-- Parallax -->
    <section class="pt-40 pb-32 relative">
        <div class="absolute w-full h-full top-0 left-0 bg-cover bg-center bg-no-repeat opacity-100 bg-fixed" style="background-image:url(assets/inde.jpeg)"></div>
    </section>

    <section class="h-[500px]">
    
    </section>
</div>
    <!---------------- Footer -------------->
    <div class="fixed bottom-0 bg-color-5 z-10 progress"></div>
    <?php require_once('src/footer.php'); ?>
    <script src="src/espagne.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="src/tailwind-need-body.js"></script>
</body>

</html>