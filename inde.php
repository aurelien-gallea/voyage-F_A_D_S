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
    <!-- <link rel="stylesheet" href="css/voyages.css"> -->
    <link rel="stylesheet" href="css/tailwind-need.css">
    <script src="src/tailwind-need.js"></script>
    <link href="assets/favicon.ico" rel="icon" type="image/x-icon" />
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

        <!-- Intro et tombe -->
        <section class="bg-color-5 dark:bg-color-1 dark:text-color-4">
            <h1 class="text-4xl font-bold text-center leading-none tracking-tight text-color-3 md:text-5xl lg:text-6xl italic">L'Inde, un voyage spirituel...</h1>
            <h2 class="mt-10 font-bold text-center leading-none tracking-tight text-color-1 md:text-5xl dark:text-color-4">Tombe de Humayun à Delhi</h2>
            <div class="flex flex-col lg:flex-row p-5 mt-5">
                <div class="lg:w-1/3 lg:order-1 m-10">
                    <img src="./assets/tomb.png" alt="Tombe de Humayun, Delhi">
                </div>
                <div class="lg:w-2/3 text-white w-full">
                    <p class="mt-10 text-justify text-center font-mono dark:text-color-4">
                        La tombe de Humayun, à Delhi, est le premier des grands mausolées dynastiques qui deviendront emblématiques de l’architecture moghole dont le style architectural parviendra à son apogée 80 ans plus tard avec l’édification du Taj Mahal. Le monument funéraire s’élève sur un site de 27,04 hectares qui accueille d’autres sépultures mogholes contemporaines du XVIe siècle comme le Nila Gumbad, les tombes d’Isa Khan, Bu Halima, Afsarwala, la tombe du Barbier et l’ensemble de l’Arab Serai où vivaient les artisans employés à la construction de la tombe de Humayun.
                        <br>
                        <br>
                        <br>
                        Le site funéraire fut réalisé dans les années 1560, sous le patronage du fils d’Humayun, le grand empereur Akbar. Des artisans indiens et perses travaillèrent ensemble à la construction de cette tombe-jardin, beaucoup plus grande que toutes celles jamais construites auparavant dans le monde islamique. La tombe-jardin de Humayun est un exemple de charbagh (jardin à quatre quadrants où sont représentés les quatre fleuves du paradis coranique) avec des pièces d’eau reliées entre elles par des canaux. De grandes portes d’entrée donnent sur le jardin au sud et à l’ouest avec des pavillons situés au centre des murs des côtés est et nord.
                    </p>
                </div>
            </div>
        </section>

        <!-- Parallax -->
        <section class="pt-40 pb-32 relative">
            <div class="absolute w-full h-full top-0 left-0 bg-cover bg-center bg-no-repeat opacity-100 bg-fixed" style="background-image:url(assets/indiaparty.jpeg)"></div>
        </section>

        <!-- Vieux Delhi -->
        <section class="bg-color-3 dark:bg-color-1">
            <h2 class="font-bold text-center leading-none tracking-tight text-color-4 md:text-5xl">Vieux Delhi</h2>
            <div class="flex flex-col lg:flex-row p-5 mt-5">
                <div class="lg:w-1/3 lg:order-1 m-10">
                    <img src="./assets/olddelhi.png" alt="Un vendeur de ce qui semble être des beignets les fait frire dans une marmite dans une rue bondée">
                </div>
                <div class="lg:w-2/3 text-white w-full">
                    <p class="mt-10 text-justify text-center font-mono dark:text-color-4">
                        Old Delhi est l’ancienne capitale de l’empire Moghol. Originellement appelé Shahjahanabad, c’est un condensé de l’Inde à l’état pur. Des millions d’habitants, des ruelles tortueuses dans tous les sens, des odeurs d’épices et d’encens, des rickshaws, des klaxons et des embouteillages. La vie, grouillante et effervescente, est rythmée par l’appel du muezzin de la Grande Mosquée.Le cœur historique de la ville recense de nombreuses choses à voir ou à faire. <br>
                        <br>
                        <br>
                        Chandni Chowk est l’un des marchés les plus anciens de Old Delhi. Ce quartier de Old Delhi offre la meilleure nourriture de rue de toute la ville. Le marché se trouve sur la rue du même nom, et s’étend entre le Fort Rouge et la porte de Lahore. La rue est découpée en différents secteurs, suivant les produits venus. La traversée vous prendra facilement plusieurs heures.
                    </p>
                </div>
            </div>
        </section>

        <!-- Parallax -->
        <section class="pt-40 pb-32 relative">
            <div class="absolute w-full h-full top-0 left-0 bg-cover bg-center bg-no-repeat opacity-100 bg-fixed" style="background-image:url(assets/indiagate.png)"></div>
        </section>

        <!-- Parc -->
        <section class="bg-color-2 dark:bg-color-1 dark:text-color-4">
            <h2 class="font-bold text-center leading-none tracking-tight text-color-1 md:text-5xl dark:text-color-4">Parc national Sanjay Gandhi</h2>
            <div class="flex flex-col lg:flex-row p-5 mt-5">
                <div class="lg:w-1/3 lg:order-1 m-10">
                    <img src="./assets/parc.png" alt="Une vue d'au-dessus du parc avec des arbres">
                </div>
                <div class="lg:w-2/3 w-full">
                    <p class="mt-10 text-justify text-center font-mono">
                        Le parc national Sanjay Gandhi, anciennement connu sous le nom de Parc national Borivali, n'est pas un parc ordinaire. Attirant plus de deux millions de touristes par an comme l'un des parcs les plus visités d'Asie, cette merveille verte luxuriante a une immense signification historique, géographique, écologique et artistique. D'une population de tigres à plus de 2 000 ans de grottes bouddhistes, il n'y a presque rien que ce parc n'a pas. Voici six faits sur ce site de Mumbai qui vous fascinera. <br>
                        <br>
                        <br>
                        Couvrant une superficie de 104 kilomètres carrés, le parc national Sanjay Gandhi est considéré comme le plus grand parc du monde situé dans les limites de la ville. Ce parc boisé dense présente des élévations allant de 30 mètres (98 pieds) à 480 mètres (1 570 pieds). Sa couverture verte luxuriante contre une grande partie de la pollution de l'air à Mumbai, conduisant à ce qu'on l'appelle les poumons de la ville.
                    </p>
                </div>
            </div>
        </section>

        <!-- Parallax -->
        <section class="pt-40 pb-32 relative">
            <div class="absolute w-full h-full top-0 left-0 bg-cover bg-center bg-no-repeat opacity-100 bg-fixed" style="background-image:url(assets/india_0.jpg)"></div>
        </section>

        <!-- Cuisine -->
        <section class="bg-color-5 dark:bg-color-1 dark:text-color-4">
            <h1 class="text-4xl font-bold text-center leading-none tracking-tight text-color-3 md:text-5xl lg:text-6xl italic">...mais aussi appétissant.</h1>
            <h2 class="mt-10 font-bold text-center leading-none tracking-tight text-color-1 md:text-5xl dark:text-color-4">Dhal / Dal</h2>

            <div class="flex flex-col lg:flex-row p-5 mt-5">
                <div class="lg:w-1/3 lg:order-1 m-10">
                    <img src="./assets/dhal.png" alt="Un plat de curry dhal vu du dessus aux touches orangés et rouges">
                </div>
                <div class="lg:w-2/3 text-white w-full">
                    <p class="mt-10 text-justify text-center font-mono dark:text-color-4">
                        Le dahl, ou daal ou encore dal, est un incontournable de la cuisine indienne. Plat végétarien complet et à base de légumineuses, il constitue une source de protéines non négligeable et peut être consommé aussi bien en plat principal qu'en accompagnement. <br> <br>
                        <br>
                        Il existe de nombreuses recettes de dahl mais les plus courantes sont le dahl tadka à base de lentilles corail, le dahl fry avec l'ajout de chana daal, sorte de pois chiches cassés et le dahl makahni, une préparation combinant lentilles du Puy et haricots rouges. Le parfum enivrant du dhal avec ses épices colorées et savoureuses embaume la cuisine et fait fondre de plaisir les papilles de la maison.
                    </p>
                </div>
            </div>

            <h2 class="mt-10 font-bold text-center leading-none tracking-tight text-color-1 md:text-5xl dark:text-color-4">Naan / nân</h2>
            <div class="flex flex-col lg:flex-row p-5 mt-5">
                <div class="lg:w-1/3 lg:order-1 m-10">
                    <img src="./assets/naan.png" alt="Quelques pains naans empilés sur une assiette noire">
                </div>
                <div class="lg:w-2/3 text-white w-full">
                    <p class="mt-10 text-justify text-center font-mono dark:text-color-4">
                        Le mot nan (نان) est originaire d’Iran où il n’a pas une signification particulière, car il est simplement le mot générique pour tout type de pain, comme dans d’autres pays d’Asie occidentale ou chez d’autres groupes ethniques régionaux, tels que les Kurdes, les Turcs ou les Azerbaïdjanais. Dans les langues turques telles que l’ouzbèke et l’ouïghour, le pain est appelé nan. <br>
                        <br>
                        Les recettes de naan varient avec ou sans oeufs, car beaucoup d’hindous ne consomment pas d’oeufs. Certains remplacent également la levure par de la levure chimique ou l’ajoutent à celle-ci. D’autres utilisent une combinaison de bicarbonate de soude et de crème de tartre.
                    </p>
                </div>
            </div>
        </section>

		<!-- Parallax -->
        <section class="pt-40 pb-32 relative">
            <div class="absolute w-full h-full top-0 left-0 bg-cover bg-center bg-no-repeat opacity-100 bg-fixed" style="background-image:url(assets/india2.png)"></div>
        </section>

    </div>
    <!---------------- Footer -------------->
    <?php require_once('src/footer.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="src/tailwind-need-body.js"></script>
</body>

</html>