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
    <link href="assets/esp-favicon.ico" rel="icon" type="image/x-icon" />
    <title>Découvrez l'Espagne | Tasty Trip</title>
</head>

<body class="min-h-screen flex flex-col items-center dark:bg-color-1 dark:text-white text-lg">
    <?php require_once('src/header.php'); ?>

    <div class="mt-28">
        <h1 class="font-unbounded text-center text-4xl mb-10 text-color-3 dark:text-color-4">Envie d'aventures ? Visitez l'Espagne</h1>
        <img src="./assets/esp-bg.jpg" alt="une mere tiens la main de son enfant dans une rue espagnole">
    </div>
    <section>
        
        <article class="mt-10">
            <div class="  m-10">
                <h2 class="font-unbounded text-4xl font-bold text-color-3 dark:text-color-4">Barcelone</h2>
                <span class="text-light font-unbounded">Capitale de la Catalogne</span>
            </div>
            <div>
                <img src="./assets/esp-barca-bg.jpg" alt="barcelone par vue aerienne">
            </div>
            <div class="container mx-auto">
                <div class="m-10">
                    <h3 class="font-unbounded text-xl font-light">Découvrez une architecture hors du commun et du temps !</h3>
                </div>
                <hr>
                <div class="m-10 container mx-auto">
                    <div>
                        <h3 class="font-unbounded text-2xl font-bold px-5 text-color-3 dark:text-color-4">La Sagrada Familia</h3>
                    </div>
                    <div class="flex flex-col lg:flex-row p-5 gap-5 mt-5">
                        <div class="lg:w-1/2 w-full flex justify-center  items-center lg:justify-start">
                            <img src="./assets/esp-sagrada-familia.jpg" alt="la sagrada familia">
                        </div>
                        <div class="lg:w-1/2  w-full">
                            <p class="text-justify">La Sagrada Família, Temple Expiatori de la Sagrada Família de son nom complet en catalan, ou Templo Expiatorio de la Sagrada Familia en espagnol (en français : « temple expiatoire de la Sainte Famille ») est une basilique de Barcelone dont la construction a commencé en 1882.

                                C’est l’un des exemples les plus connus du modernisme catalan et un monument emblématique de la ville. Œuvre inachevée de l'architecte Antoni Gaudí, la Sagrada Família est située dans le quartier du même nom (district de l’Eixample). L’architecte a conçu une minutieuse symbologie qui fait de cet édifice un poème mystique. Il a également fait preuve d'une grande audace de construction formelle, telle que la manière de concevoir la structure d’arc en chaînettenote 2 ou la combinaison des traitements sculpturaux naturalistes et de l’abstraction des tours. Selon les données de l’année 2004, la Sagrada Família est le monument le plus visité d’Espagne, dépassant l’Alhambra de Grenade et le musée du Prado à Madrid3 : en 2012, elle a attiré plus de 3,2 millions de visiteurs4. La partie du monument réalisée du vivant d’Antoni Gaudí, la crypte et la façade de la Nativité, a été déclarée patrimoine de l’humanité par l’Unesco en 20055.

                                Puisqu'il s'agit d’un temple expiatoire, les travaux sont exclusivement financés grâce à l’aumône. En conséquence, il n’a pas été possible de construire simultanément les différentes parties du monument lorsqu’il l’eût fallu, mais depuis les années 1990, l’affluence de visiteurs et le renom mondial de l’œuvre ont fait évoluer la situation économique.

                                La basilique a été consacrée par le pape Benoît XVI le 7 novembre 2010. Le siège de l’archevêché de Barcelone reste toutefois la cathédrale Sainte-Eulalie, édifice construit à l’époque médiévale et situé au cœur du quartier gothique.</p>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="m-10 container mx-auto">
                    <div>
                        <h3 class="font-unbounded text-2xl font-bold px-5 text-color-3 dark:text-color-4">Le Parc Güell</h3>
                    </div>
                    <div class="flex flex-col lg:flex-row p-5 gap-5 mt-5">
                        <div class="lg:w-1/2 w-full lg:order-2 flex justify-center items-center lg:justify-end">
                            <img src="./assets/esp-parc-guell.jpg" alt="le parc güell">
                        </div>
                        <div class="lg:w-1/2  w-full">
                            <p class="text-justify">Le Parc Güell est l'une des réalisations de l'architecte catalan Antoni Gaudí à Barcelone qui figure sur la liste du patrimoine mondial de l'UNESCO. Il fut édifié entre 1900 et 1914. Les architectes José Antonio Martínez Lapeña et Elías Torres l'ont restauré de 1984 à 1993. Cette restauration a donné lieu à des polémiques notamment concernant l'habillage en céramique du banc de forme ondulée de la terrasse du Parc Güell.
                                Celui-ci devait être à l'origine une cité-jardin que le mécène de Gaudi, Eusebi Güell, lui avait demandé d'édifier sur une colline au nord-ouest de la ville (El Carmel). Conçue sur le modèle anglais (son nom initial était Park Güell et non Parque Güell), elle devait comporter une chapelle et 60 maisons. Mais le coût de construction augmenta dans de telles proportions que seules furent achevées quatre maisons et le parc. Les travaux prirent fin en 1914. Le parc devint propriété de la ville de Barcelone en 1923.

                                Le parc Güell fut inscrit sur la liste du patrimoine mondial de l'Unesco en 1984 pour sa contribution au développement de l'architecture et des techniques de construction à la fin du xixe siècle et au début de xxe siècle.
                            </p>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="m-10 container mx-auto flex flex-col items-center">
                    <div>
                        <h3 class="font-unbounded text-2xl font-bold px-5 text-color-3 dark:text-color-4">La Rambla, l'avenue phare de Barcelone</h3>
                        <p class="font-unbounded font-light p-5">une découverte inoubliable !</p>
                    </div>
                    <div>
                        <img class="bg-white" src="./assets/esp-la-rambla-barcelone.png" alt="plan de la rambla barcelone">
                    </div>
                </div>

                <div class="my-10 container mx-auto">
                    <div>
                        <h3 class="font-unbounded text-2xl font-light p-5 text-color-3 dark:text-color-4">Mercat De La Boqueria</h3>
                    </div>
                    <div class="flex flex-col lg:flex-row p-5 gap-5 mt-5">
                        <div class="lg:w-1/2 w-full flex justify-center items-center lg:justify-start">
                            <img src="./assets/esp-las-ramblas.jpg" alt="mercat de la boqueria">
                        </div>
                        <div class="lg:w-1/2  w-full">
                            <p class="text-justify">La première mention du marché de Barcelone date de 1217 où des tables sont installées à proximité de l´ancienne porte de la ville nommée Boqueria pour vendre de la viande. À partir de décembre 1470, un marché aux cochons se tient à cet endroit qui se situe alors à l'extérieur de la ville.

                                Au début, le marché n'est pas entouré d'un portique et n'a pas de statut officiel, considéré comme une simple extension du marché de la Plaça Nova qui s´étend alors jusqu´à la Plaça del Pi. Plus tard, les autorités décident de construire un marché séparé sur la Rambla, dédié principalement aux poissonniers et aux bouchers.[réf. nécessaire]

                                Ce n'est qu'en 1826 que le marché est légalement reconnu et une convention tenue en 1835 décide de la construction d'une place officielle. Une année plus tard, un bâtiment est prévu au centre de cette place et la construction de celui-ci commence le 19 mars 1840 sous la direction de l'architecte Mas Vilà. Le marché est officiellement ouvert la même année, mais les plans seront modifiés à de nombreuses reprises jusqu'en 1846.

                                L'inauguration officielle est finalement faite en 1853. En 1911 le nouveau marché aux poissons voit le jour et, en 1914, le toit métallique que l'on peut voir encore de nos jours est mis en place.</p>

                        </div>
                    </div>
                </div>
                <div class="m-10 container mx-auto">
                    <div>
                        <h3 class="font-unbounded text-2xl font-light p-5 text-color-3 dark:text-color-4">La statue de Colomb - 'Mirador de Colón'</h3>
                    </div>
                    <div class="flex flex-col lg:flex-row p-5 gap-5 mt-5">
                        <div class="lg:w-1/2 w-full lg:order-2 flex justify-center items-center lg:justify-end">
                            <img src="./assets/esp-monument_colomb_barcellona.jpg" alt="la statue de christophe colomb">
                        </div>
                        <div class="lg:w-1/2  w-full">
                            <p class="text-justify">Au centre de la Plaça de la Porte de Pau sur le port de Barcelone et au début des Ramblas, se trouve une colonne en fonte avec au sommet une statue de Christophe Colomb. Le monument de Christophe Colomb (avec une hauteur de 60 mètres), connu à Barcelone comme le 'Monument a Colon', a été conçu pour l'Exposition Mondiale tenue en 1888 à Barcelone.

                                Christophe Colomb & Barcelone
                                Le socle du monument de Christophe Colomb est situé à l'endroit où Christophe Colomb rentra des Amériques en 1493 après leur découverte, et où il voulait rendre des comptes de son premier voyage à la reine Isabelle et au roi Ferdinand. On suppose que Christophe Colomb et né à Gênes en Italie. Il déménage d'abord au Portugal pour s'établir plus tard en Espagne.

                                La statue de plus de 7 mètres d'hauteur (faite par Raphael Atche) montre Christophe Colomb pointant vers la mer. Étrangement, sur son socle il ne pointe pas vers le nouveau monde qu'il a découvert.</p>

                        </div>
                    </div>
                </div>
                <div class="m-10 container mx-auto">
                    <div>
                        <h3 class="font-unbounded text-2xl font-light px-5 text-color-3 dark:text-color-4">Plaça Reial</h3>
                        <span class="font-unbounded px-5">La place dans le quartier gothique de Barcelone</span>
                    </div>
                    <div class="flex flex-col lg:flex-row p-5 gap-5 mt-5 ">
                        <div class="lg:w-1/2 w-full flex justify-center items-center lg:justify-start">
                            <img src="./assets/esp-placareialbarcelone.jpg" alt="la placa reial">
                        </div>
                        <div class="lg:w-1/2  w-full">
                            <p class="text-justify">La Plaça Reial est une place dans le quartier gothique, et l'une des places parmi les plus animées et conviviales du centre de Barcelone. La célèbre Plaça Reial est située juste à côté des populaires Ramblas. En 1848, l'architecte Francesc Daniel Milona reçut la commission de la ville de Barcelone de construire cette place. Les nombreuses terrasses, la fontaine centrale, la galerie d'arcades et les palmiers majestueux confèrent à cette place interdite à la circulation une ambiance typiquement espagnole.

                                Que faire autour de la Plaça Reial?
                                Aujourd'hui, on trouve sur la Plaça Reial un grand nombre de restaurants et de bars, et la place est très animée, de jour comme de nuit. Au milieu de la Plaça Reial se trouve une fontaine (Font de les Tres Gràcies) avec deux lampadaires particuliers. Au début de sa carrière, Antoni Gaudí a conçu ces lampadaires, et c'était alors sa première commande de la ville de Barcelone. La Plaça Reial donne une image typiquement méditerranéenne, grâce aux "palais" et aux palmiers qui l'entourent. C'est la place idéale pour vous installer sur l'une des terrasses (assez chères) lors de votre visite de Barcelone.</p>

                        </div>
                    </div>
                </div>
                <hr>

                <div class="m-10 container mx-auto">
                    <div>
                        <h3 class="font-unbounded text-2xl font-bold px-5 text-color-3 dark:text-color-4">Crème catalane - L'instant gourmand</h3>
                    </div>
                    <div class="flex flex-col lg:flex-row p-5 gap-5 mt-5">
                        <div class="lg:w-1/2 w-full lg:order-2 flex justify-center items-center lg:justify-end">
                            <img src="./assets/esp-Crema_Catalana.jpg" alt="Crème catalane">
                        </div>
                        <div class="lg:w-1/2  w-full">
                            <p class="text-justify">La crème catalane (crema catalana en catalan) est un dessert consistant en une crème épaisse1 cuite qui s'utilise beaucoup en pâtisserie dans la cuisine catalane. Parfumée avec des zestes de citron ou d'orange et de la cannelle, elle se sert avec une couche de sucre blanc brûlé (cette caramélisation la rapproche de la crème brûlée) dans une assiette, un ramequin en grès à fond plat ou en une petite cassolette en terrisse</p>

                        </div>
                    </div>
                </div>
            </div>

        </article>
        <hr>
        <article>
            <div class="  m-10">
                <h2 class="text-4xl font-bold  text-color-3 dark:text-color-4">Madrid</h2>
                <span>La Capitale</span>
            </div>
            <div>
                <img src="./assets/esp-madrid-fontaine.jpg" alt="madrid fontaine lions">
            </div>
            <div class="container mx-auto">
                <div class="m-10">
                    <h3 class="text-xl font-light">Plongez au coeur de la capitale !</h3>
                </div>
                <hr>
                <div class="m-10 container mx-auto">
                    <div>
                        <h3 class="text-2xl font-bold px-5 text-color-3 dark:text-color-4">Le Palais royal</h3>
                    </div>
                    <div class="flex flex-col lg:flex-row items-center p-5 gap-5 mt-5">
                        <div class="lg:w-1/2 w-full flex justify-center items-center lg:justify-start">
                            <img src="./assets/esp-palais.jpg" alt="le palais royal">
                        </div>
                        <div class="lg:w-1/2  w-full">
                            <p class="text-justify">Le palais royal de Madrid (Palacio Real de Madrid) est la résidence officielle du roi d'Espagne. Les rois actuels ne résident pas en son sein, mais plutôt au palais de la Zarzuela. Le palais royal est utilisé pour des fonctions protocolaires.

                                Avec une superficie de 135 000 m2 et 3 418 pièces (en surface, presque deux fois plus que le palais de Buckingham ou le château de Versailles), c'est le plus grand palais royal d'Europe occidentale et l'un des plus grands au monde. Il abrite un patrimoine historique et artistique précieux, mettant en lumière l'ensemble des instruments de musique connus sous le nom des Stradivarius palatins, et des collections les plus importantes d'autres disciplines telles que la peinture, la sculpture et la tapisserie d'ameublement. Les grands salons de réception et les collections artistiques sont ouvertes aux visiteurs tant qu'il n'y a pas d'actes officiels.</p>

                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div class="m-10 container mx-auto">
                <div>
                    <h3 class="text-2xl font-bold px-5 text-color-3 dark:text-color-4">Stade Santiago-Bernabéu</h3>
                </div>
                <div class="flex flex-col lg:flex-row p-5 gap-5 mt-5 mb-10">
                    <div class="lg:w-1/2 w-full lg:order-2 flex justify-center items-center lg:justify-end">
                        <img src="./assets/esp-bernabeu.jpg" alt="Stade Santiago-Bernabéu">
                    </div>
                    <div class="lg:w-1/2  w-full">
                        <p class="text-justify">Le stade Santiago Bernabéu (en espagnol : Estadio Santiago Bernabéu) est un stade de football situé à Madrid, en Espagne. Inauguré le 14 décembre 1947 et propriété du Real Madrid, sa capacité est depuis 2006 de 81 044 spectateurs. Il se trouve au cœur de la capitale espagnole, sur le Paseo de la Castellana dans le district de Chamartín. Il est desservi par la station de métro du même nom. Initialement connu comme le Nouveau stade Chamartín, il reçoit son nom actuel en 1955 en l'honneur du président du club de l'époque, Santiago Bernabéu1.

                            Résidence du Real Madrid, un des clubs de football les plus prestigieux au monde, le stade a accueilli certains des événements les plus importants du sport mondial, parmi lesquels les finales de la Coupe du monde 1982, de l'Euro 1964 et de la Coupe d'Europe des clubs champions, devenue Ligue des champions, à quatre reprises (1957, 1969, 1980 et 2010).</p>

                    </div>
                </div>
                <hr>
            </div>
            <div class="m-10 container mx-auto">
                <div>
                    <h3 class="text-2xl font-bold px-5 text-color-3 dark:text-color-4">Cocido madrilène - l'instant Gastronomie</h3>
                </div>
                <div class="flex flex-col lg:flex-row p-5 gap-5 mt-5">
                    <div class="lg:w-1/2 w-full flex justify-center items-center lg:justify-start">
                        <img src="./assets/esp-CocidoMadrileño.jpg" alt="Cocido madrilène">
                    </div>
                    <div class="lg:w-1/2  w-full">
                        <p class="text-justify">Le cocido est une sorte de pot-au-feu, ou de potée à la mode castillane, avec diverses viandes (bœuf, poule, boudin, porc, etc.) et légumes (pois chiches, navets, carottes, chou, pommes de terre, etc.). Comme pour beaucoup de plats ancestraux, il n’y a toutefois pas de recette considérée comme officielle ; les cuisinières avaient généralement coutume d’y ajouter les restes de viande et de légumes de la semaine.

                            Ce plat d’hiver, qui constitue un repas entier à lui seul, est généralement servi en trois étapes. D’abord, le bouillon avec de fins vermicelles de blé, ensuite, le chou cuit à part et servi dans du tomate frito (sauce tomate préparée avec le bouillon), enfin, les autres légumes, les via</p>

                    </div>
                </div>
            </div>
            
        </article>
    </section>
    <div class="fixed bottom-0 bg-color-3 dark:bg-color-4 z-10 progress"></div>
        <?php require_once('src/footer.php'); ?>
   
    <script src="src/espagne.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="src/tailwind-need-body.js"></script>
</body>

</html>