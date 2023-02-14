<!DOCTYPE HTML>
<html>
	<head>
		<title>USA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/usa.css" />
		<link rel="stylesheet" href="stylefooter.css" />
		<link rel="stylesheet" href="css/voyages.css">
		
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@0.2.28/bundled/lenis.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet"/>
		
	</head>
	<body class="is-preload">

		<!-- Header -->
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
					  <button
						id="dropdownNavbarLink"
						data-dropdown-toggle="dropdownNavbar"
						class="flex items-center justify-between w-full z-50  py-3 pl-3 pr-4 font-medium text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"
					  >
						Continents
						<svg
						  class="w-5 h-5 ml-1"
						  aria-hidden="true"
						  fill="currentColor"
						  viewBox="0 0 20 20"
						  xmlns="http://www.w3.org/2000/svg"
						>
						  <path
							fill-rule="evenodd"
							d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
							clip-rule="evenodd"
						  ></path>
						</svg>
					  </button>
					  <!-- Dropdown menu -->
					  <div
						id="dropdownNavbar"
						class="  hidden  font-normal bg-white opacity-95 divide-y divide-gray-100 rounded-lg shadow-xl w-36 dark:bg-gray-700 dark:divide-gray-600"
					  >
						<ul
						  class=" py-4 text-sm text-gray-700 dark:text-gray-400"
						  aria-labelledby="dropdownLargeButton"
						>
						  <li>
							<a
							  href="src/senegal.html"
							  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
							  >Afrique</a
							>
						  </li>
						  <li>
							<a
							  href="src/espagne.html"
		
							  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
							  >Europe</a
							>
						  </li>
						  <li>
							<a
							  href="src/coree.html"
		
							  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
							  >Asie</a
							>
						  </li>
						  <li>
							<a
							  href="src/usa.html"
		
							  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
							  >Amérique</a
							>
						  </li>
						</ul>
					  </div>
					</li>
		
					<li>
					  <button
						id="dropdownNavbarLink2"
						data-dropdown-toggle="dropdownNavbar2"
						class="flex items-center justify-between w-full py-2 pl-3 pr-4  font-medium text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"
					  >
						Membres
						<svg
						  class="w-5 h-5 ml-1"
						  aria-hidden="true"
						  fill="currentColor"
						  viewBox="0 0 20 20"
						  xmlns="http://www.w3.org/2000/svg"
						>
						  <path
							fill-rule="evenodd"
							d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
							clip-rule="evenodd"
						  ></path>
						</svg>
					  </button>
					  <!-- Dropdown menu -->
					  <div
						id="dropdownNavbar2"
						class="z-10 hidden font-normal  bg-white opacity-95 divide-y divide-gray-100 rounded-lg shadow-xl w-36 dark:bg-gray-700 dark:divide-gray-600"
					  >
						<ul
						  class="flex flex-col py-4 text-sm text-gray-700 dark:text-gray-400 "
						  aria-labelledby="dropdownLargeButton2"
						>
						  <li>
							<a
							  href="src/sylvia.html"
		
							  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white "
							  >Sylvia</a
							>
						  </li>
						  <li>
							<a
							  href="src/Aurelien.html"
		
							  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
							  >Aurelien</a
							>
						  </li>
						  <li>
							<a
							  href="src/Dylan.html"
		
							  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
							  >Dylan</a
							>
						  </li>
						  <li>
							<a
							  href="src/Florian.html"
		
							  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
							  >Florian</a
							>
						  </li>
						</ul>
					  </div>
					</li>
					<li>
					  <a
						href="#"
						class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
						>Blog</a
					  >
					</li>
		
					<li>
					  <a
						href="src/contact.php"
		
		
						class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
						>Contact</a
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
		
		
			<header id="header">
				<img src="assets/logo.png" alt="Logo" width="300px" height="200px" margin-right="10px">
				<h1 class="text-2xl font-sans mb-4" style="text-align: right;">USA Tour</h1>
				<h3>Découvrer les meilleurs destinations à visiter.</h3>
				
			</header>
			
			       <br>
				   <h2 class="text-2xl font-sans mb-4" style="text-align: center;">Villes et Lieux Insolites</h2>
				   <div class="flex flex-col items-center">
					<img src="assets/New-york.jpg" alt="New York" width="700" height="300" style="float: left; margin-right: 10px;">
					<br>
					<h2 class="text-xl font-mono mt-4">New York</h2>
					<p >La ville qui ne dort jamais offre une architecture étonnante, une gastronomie variée et une multitude d'activités à faire. 
					  C'est l'une des plus grandes métropoles du monde, connue pour son architecture emblématique, sa scène culturelle vibrante et ses célèbres quartiers tels que Manhattan, Brooklyn, Queens et le Bronx.
					  New York est également un centre financier important, abritant la Bourse de New York et de nombreuses entreprises mondiales. Le tourisme est également une industrie importante de la ville, avec des attractions telles que la Statue de la Liberté, Central Park et l'Empire State Building.<br><br>Activités : New York est une ville offrant une variété d'activités pour tous les goûts. Voici quelques-unes des activités les plus populaires à faire à New York:

					  Visiter les monuments emblématiques: la Statue de la Liberté, Central Park, l'Empire State Building, le One World Trade Center, etc.
					  
					  Découvrir le patrimoine culturel: visitez les musées tels que le Metropolitan Museum of Art, le Museum of Modern Art et le Guggenheim Museum.
					  
					  Assister à un spectacle de Broadway: New York est le berceau de la comédie musicale et abrite de nombreux théâtres proposant des spectacles de Broadway.
					  
					  Magasiner dans les quartiers branchés: découvrez les boutiques uniques de Soho, de Greenwich Village et de Chelsea.
					  
					  Explorer les quartiers historiques: découvrez l'architecture et l'histoire de quartiers tels que Little Italy, Chinatown et Brooklyn Heights.
					  
					  Déguster la cuisine locale: découvrez les plats classiques de New York, tels que les bagels, les pizzas, les hot-dogs et les sandwichs au pastrami.
					  
					  Profiter de la vie nocturne: découvrez les bars, les clubs et les music halls de New York pour une soirée animée.
					  
					  En somme, New York offre une variété d'activités pour tous les goûts et tous les âges, offrant une expérience unique et inoubliable pour les visiteurs et les résidents.
					<br><br>
					<img src="assets/hotdogs.jpg" alt="New York" width="500" height="300" style="float: left; margin-right: 10px;">
					  <br>
					  <br>Gastronomie : La cuisine new-yorkaise est souvent associée à des plats classiques tels que les bagels, les pizzas, les hot-dogs et les sandwichs au pastrami. Cependant, la ville offre également une cuisine internationale de haute qualité, notamment des restaurants de cuisine asiatique, européenne, africaine et latino-américaine.

					  En plus de la nourriture, New York est également célèbre pour ses bars et ses clubs de mixologie, qui proposent une large gamme de cocktails et de boissons alcoolisées. La scène gastronomique de New York continue de se développer et de se diversifier, offrant des expériences culinaires uniques et mémorables pour les visiteurs et les résidents.
					</p>
					
				  </div>
				  <div class="h-1 bg-gray-300 rounded my-5"></div>
				  <br>
				   <div class="flex flex-col items-center">
					 <img src="assets/San francisco.jpg" alt="San Francisco" width="700" height="300" style="float: left; margin-right: 10px;">
					 <h2 class="text-xl font-mono mt-4">San Francisco</h2>
					 <p class="text-black-700 mt-2">Cette ville située sur la côte ouest offre une vue imprenable sur le Golden Gate Bridge, ainsi qu'une cuisine délicieuse et une vie nocturne animée.San Francisco est une ville située sur la côte ouest des États-Unis, en Californie.
					   C'est une destination populaire pour les touristes en raison de sa scène culturelle vibrante, de ses attractions historiques et de ses vues imprenables sur la baie de San Francisco. 
					   Parmi les sites les plus populaires figurent le Golden Gate Bridge, Alcatraz Island, Fisherman's Wharf et Chinatown. 
					   La ville est également connue pour son innovation technologique, en particulier dans l'industrie de la haute technologie, avec de nombreuses entreprises telles que Google, Apple et Twitter ayant leur siège à San Francisco.</p>
				    <br><br>Activités : San Francisco propose de nombreuses options pour les visiteurs et les résidents. Voici quelques-unes des activités les plus populaires à faire à San Francisco:

					Marcher sur le Golden Gate Bridge: ce pont emblématique offre une vue imprenable sur la baie de San Francisco.
					
					Découvrir Alcatraz Island: visitez la prison abandonnée d'Alcatraz et en apprenez plus sur son histoire riche.
					
					Explorer le Fisherman's Wharf: découvrez les boutiques, les restaurants et les activités de ce quartier animé de San Francisco.
					
					Visiter le Musée d'art moderne de San Francisco: ce musée abrite une collection d'art moderne et contemporain.
					
					Parcourir le parc Golden Gate Park: ce parc urbain de plus de 1 000 hectares offre des activités pour tous les âges.
					
					Déguster de la cuisine inventive: découvrez les restaurants proposant une cuisine inventive, reflétant les influences locales et internationales.
					
					En somme, San Francisco offre une variété d'activités et de scènes gastronomiques pour tous les goûts, offrant une expérience unique et inoubliable pour les visiteurs et les résidents.
					<br><br>
					<img src="assets/crab.jpg" alt="New York" width="500" height="300" style="float: right; margin-right: 10px;">
					<br>
					<br>Gastronomie : San Francisco est célèbre pour sa cuisine locale et inventive, qui reflète les influences de la cuisine californienne, asiatique et mexicaine. La ville abrite également de nombreux restaurants gastronomiques renommés ainsi que des food trucks de rue proposant des plats de rue délicieux. 
					</div>
					<div class="h-1 bg-gray-300 rounded my-5"></div>
				   <br>
				   <div class="flex flex-col items-center">
					 <img src="assets/Las Vegas.jpg" alt="Las Vegas" width="700" height="300" style="float: left; margin-right: 10px;">
					 <h2 class="text-xl font-mono mt-4">Las Vegas</h2>
					 <p class="text-black-700 mt-2">Cette ville du désert est connue pour ses casinos flamboyants et ses spectacles incroyables. Il y a également de nombreux restaurants de renom et des activités en plein air à découvrir.<br>Las Vegas offre également une variété d'autres activités, notamment des centres commerciaux, des restaurants, des parcs d'attractions et des musées. La ville est également une destination populaire pour les mariages, les réunions d'affaires et les congrès.
			       Las Vegas est située dans le désert de Mojave, ce qui en fait un endroit chaud et aride. Cependant, grâce à son climat désertique, la ville offre également de nombreuses activités de plein air, telles que la randonnée, la vélo et le camping.</p>
				   <br><br>
					<img src="assets/casino.jpg" alt="New York" width="500" height="300" style="float: right; margin-right: 10px;">
				   <br><br>Activités : Las Vegas propose une variété d'options pour les visiteurs et les résidents. Voici quelques-unes des activités les plus populaires à faire à Las Vegas:

				   Assister à un spectacle de casino: Las Vegas abrite de nombreux spectacles de casinos, allant de la musique en direct à des shows de magie.
				   
				   Faire du shopping dans les centres commerciaux: découvrez les nombreux centres commerciaux de luxe de Las Vegas, notamment le Forum Shops au Caesars Palace.
				   
				   Visiter les musées: découvrez les musées de Las Vegas, tels que le Musée de la mobilité et le Musée de la conscience.
				   
				   Profiter des piscines des casinos: Les casinos de Las Vegas proposent souvent des piscines luxueuses pour se détendre et se bronzer.
				   
				   Déguster de la cuisine de haut niveau: découvrez les restaurants gastronomiques de Las Vegas, dirigés par des chefs célèbres tels que Gordon Ramsay et Emeril Lagasse.
					<br><br> Gastronomie : Las Vegas est un véritable paradis pour les gourmets. La ville abrite de nombreux restaurants gastronomiques dirigés par des chefs célèbres, ainsi que des options de restauration plus abordables pour tous les budgets.
				</div>
				<div class="h-1 bg-gray-300 rounded my-5"></div>
				   <br>
				   <div class="flex flex-col items-center">
					 <img src="assets/Los Angeles.jfif" alt="Los Angeles" width="700" height="300" style="float: left; margin-right: 10px;">
					 <h2 class="text-xl font-mono mt-4">Los Angeles</h2>
					 <p class="text-black-700 mt-2">Los Angeles est une ville située en Californie. 
					   C'est la deuxième plus grande ville du pays et un centre économique, culturel et touristique important. 
					   Los Angeles est célèbre pour sa scène cinématographique, en tant que maison d'Hollywood et du cinéma mondial. 
					   La ville abrite également de nombreux sites touristiques, tels que le Walk of Fame, le Griffith Observatory et le Sunset Strip. 
					   Enfin, Los Angeles est connue pour ses plages de renom, tels que Venice Beach et Malibu, ainsi que pour sa cuisine diversifiée et sa scène gastronomique en évolution.</p>
					   <br><br>
					   <img src="assets/hollywood.jpg" alt="New York" width="500" height="300" style="float: right; margin-right: 10px;">
					   <br><br> Activités : Los Angeles propose une variété d'options pour les visiteurs et les résidents. Voici quelques-unes des activités les plus populaires à faire à Los Angeles:

				   Visiter les plages célèbres: découvrez les plages emblématiques de Los Angeles, telles que Venice Beach et Santa Monica Beach.
				   
				   Se promener dans les quartiers branchés: découvrez les quartiers branchés de Los Angeles, tels que Beverly Hills et West Hollywood.
				   
				   Visiter les studios de cinéma: découvrez les coulisses de la production cinématographique en visitant les studios de cinéma de Los Angeles, tels que Universal Studios Hollywood.
				   
				   Découvrir le musée d'art de Los Angeles (LACMA): ce musée abrite une collection d'art moderne et contemporain.
				   
				   Se balader dans le Griffith Observatory: ce site offre une vue imprenable sur la ville de Los Angeles.
				   
				   Déguster la cuisine californienne inventive: découvrez les restaurants proposant une cuisine inventive, reflétant les influences locales et internationales.
				   <br><br>
					   <img src="assets/tacos.jfif" alt="New York" width="500" height="300" style="float: right; margin-right: 10px;">
				   <br><br>Gastronomie :  Los Angeles abrite une variété de restaurants, allant des options de restauration rapide aux restaurants gastronomiques renommés. La ville est particulièrement connue pour sa cuisine californienne inventive, qui reflète les influences de la cuisine mexicaine, asiatique et méditerranéenne.

					</div>
					<div class="h-1 bg-gray-300 rounded my-5"></div>
				   <br>
				   <div class="flex flex-col items-center">
					 <img src="assets/Washington DC.jpg" alt="Washington" width="700" height="300" style="float: left; margin-right: 10px;">
					 <h2 class="text-xl font-mono mt-4">Washington D.C.</h2>
					 <p class="text-black-700 mt-2">Washington D.C. est la capitale des États-Unis. 
					   C'est un centre politique important et abrite le siège du gouvernement fédéral, y compris la Maison Blanche, le Capitole et le Supreme Court. 
					   La ville est également connue pour ses nombreux musées et monuments, tels que le Lincoln Memorial, le National Mall et le National Museum of American History. 
					    Washington D.C. attire également de nombreux touristes pour sa riche histoire et son patrimoine culturel.</p>
						<br><br>
						<img src="assets/abraham lincoln.jpg" alt="New York" width="500" height="300" style="float: right; margin-right: 10px;">
						<br><br>Activités : Washington D.C. propose une variété d'options pour les visiteurs et les résidents. Voici quelques-unes des activités les plus populaires à faire à Washington D.C.:

				  Visiter le Lincoln Memorial: ce monument historique célèbre la vie et les réalisations du 16ème président des États-Unis, Abraham Lincoln.
				  
				  Se promener dans le National Mall: ce parc national accueille plusieurs monuments et musées importants, tels que le Washington Monument, le Smithsonian National Museum of American History et le National Museum of Natural History.
				  
				  Visiter le musée d'art américain: ce musée abrite une collection d'art américain, allant de la peinture à la sculpture.
				  
				  Se balader dans les quartiers historiques: découvrez les quartiers historiques de Washington D.C., tels que Georgetown et Dupont Circle.
				  
				  Visiter la Maison-Blanche: ce bâtiment abrite le président des États-Unis et est un symbole important de la politique américaine.
				  
				  Déguster la cuisine locale et internationale: découvrez les restaurants proposant une cuisine locale, internationale, traditionnelle et moderne.
				  <br><br>Gastronomie : En matière de gastronomie, Washington D.C. abrite une variété de restaurants proposant une cuisine locale, internationale, traditionnelle et moderne. La ville est particulièrement connue pour ses restaurants gastronomiques renommés et pour ses stands de street food de renom.
					</div>
					<div class="h-1 bg-gray-300 rounded my-5"></div>
				   <br>
				   <div class="flex flex-col items-center">
					 <img src="assets/Philadelphia.jpg" alt="Philadelphie" width="700" height="300" style="float: left; margin-right: 10px;">
					 <h2 class="text-xl font-mono mt-4">Philadelphie</h2>
					 <p class="text-black-700 mt-2">Philadelphia est une ville historique qui a joué un rôle important dans la fondation des États-Unis, notamment en tant que siège de la révolution américaine et en accueillant la signature de la Déclaration d'indépendance en 1776. 
					   Philadelphia est également connue pour son architecture historique, ses nombreux musées et son riche patrimoine culinaire, notamment le sandwich à la viande de Philly. 
					   La ville abrite également de nombreux parcs et espaces verts, ainsi que le Liberty Bell, un symbole important de la liberté américaine.</p>
				   
					<br><br>Activités :  Il y a beaucoup d'activités à faire dans la ville, telles que la visite de l'Independence Hall, où la Déclaration d'Indépendance a été signée en 1776, ou le Musée d'Art de Philadelphie, qui abrite une collection remarquable de peintures américaines et européennes. Les amateurs de sport peuvent assister à un match des Eagles de Philadelphie ou des 76ers de Philadelphie au Lincoln Financial Field ou au Wells Fargo Center.
					<br><br>Gastronomie : Philadelphie est célèbre pour son "cheesesteak", un sandwich au steak haché et au fromage fondu qui est un must pour les gourmets. La ville est également connue pour ses pretzels frais, ses hoagies (sandwichs au pain long) et ses délicieux desserts, tels que le water ice et les beignets. Il y a également une scène culinaire en constante évolution, avec de nombreux restaurants proposant une cuisine inventive et des plats locaux.





				</div>
				<div class="h-1 bg-gray-300 rounded my-5"></div>
				   <br>
				   <div class="flex flex-col items-center">
					 <img src="assets/Boston.jpg" alt="Boston" width="700" height="300" style="float: left; margin-right: 10px;">
					 <h2 class="text-xl font-mono mt-4">Boston</h2>
					 <p class="text-black-700 mt-2">Boston est une ville tout autant historique que Philadelphie, car elle a également joué un rôle important dans la fondation des États-Unis en tant que centre de la révolution américaine. 
					   Boston est connu pour ses nombreux sites historiques, tels que le Freedom Trail, le Old North Church et le USS Constitution Museum. La ville est également réputée pour son université prestigieuse, Harvard, ainsi que pour ses nombreux parcs et espaces verts. 
					   Enfin, Boston est célèbre pour sa cuisine locale, telle que le "Boston Clam Chowder" et les "Boston Baked Beans".</p>
					   <br><br>
					   <img src="assets/baseball.jfif" alt="New York" width="500" height="300" style="float: right; margin-right: 10px;">
					<br><br>Activités : Boston offre une variété d'options pour les visiteurs et les résidents. Voici quelques-unes des activités les plus populaires à faire à Boston:

					Visiter le Freedom Trail: ce sentier historique vous guide à travers 16 lieux importants de l'histoire américaine, notamment le cimetière de la vieille église et le monument aux minutemen de Lexington.
					
					Se promener dans le quartier historique de Beacon Hill: ce quartier historique est connu pour ses rues pavées, ses jolies maisons en brique et ses jardins publics.
					
					Visiter le musée des sciences de Boston: ce musée interactif propose des expositions sur les sciences, la technologie, l'ingénierie et les mathématiques.
					
					Découvrir la culture de la bière à Boston: la ville abrite plusieurs brasseries locales, pubs et festivals de bière.
					
					Participer à un match de base-ball au Fenway Park: ce stade emblématique est la plus ancienne installation sportive en activité des États-Unis et est le foyer des Red Sox de Boston.
					
					Se promener dans le jardin public de Boston: ce parc de plus de 50 hectares est un lieu de détente populaire pour les habitants de la ville.
					
					En somme, Boston est une destination idéale pour les amateurs d'histoire, de culture et de gastronomie, offrant une expérience unique et enrichissante pour les visiteurs et les résidents.
					<br><br>Gastronomie :  Boston est célèbre pour ses fruits de mer frais, ses plats traditionnels bostoniens tels que le chowder (potage aux fruits de mer) et les baked beans (haricots cuits au four), ainsi que pour ses nombreux restaurants proposant une cuisine locale, internationale et gastronomique de haut niveau.

					
					
					

					
				</div>
				<div class="h-1 bg-gray-300 rounded my-5"></div>
				   <br>
				   <div class="flex flex-col items-center">
					 <img src="assets/Atlanta.jfif" alt="Atlanta" width="700" height="300" style="float: left; margin-right: 10px;">
					 <h2 class="text-xl font-mono mt-4">Atlanta</h2>
					 <p class="text-black-700 mt-2">Atlanta est ville moderne et dynamique, connue pour son rôle important dans les affaires, la finance et la technologie. 
					   Atlanta est également une destination touristique populaire pour ses nombreux sites historiques, tels que la Maison Martin Luther King Jr. et la Oakland Cemetery. La ville abrite également le World of Coca-Cola, un musée consacré à l'histoire de la célèbre marque de boissons.
						Enfin, Atlanta est célèbre pour son street art, sa cuisine locale, telle que le "Southern Comfort Food", et son rôle important dans la musique et la culture afro-américaine.</p>
				   <br><br>Activités : Atlanta offre une variété d'options pour les visiteurs et les résidents. Voici quelques-unes des activités les plus populaires à faire à Atlanta:

				   Visiter le Martin Luther King Jr. National Historical Park: ce parc national comprend la maison natale du révérend Martin Luther King Jr., sa tombe et l'église Ebenezer Baptist Church, où il a prêché.
				   
				   Se promener dans le High Museum of Art: ce musée d'art moderne et contemporain abrite une collection éclectique d'art européen, africain et américain.
				   
				   Se détendre dans le parc Piedmont: ce parc urbain de 185 hectares offre des activités de plein air pour tous les âges, notamment des jardins botaniques, des terrains de jeux pour enfants et des sentiers de randonnée.
				   
				   Visiter le World of Coca-Cola: ce musée interactif explore l'histoire de la célèbre marque de boissons gazeuses, avec des expositions sur la fabrication, la publicité et les boissons.
				   
				   Participer à un match de base-ball des Braves d'Atlanta: le stade SunTrust Park est le foyer des Braves d'Atlanta et propose des activités pour tous les âges, des concerts et des événements tout au long de la saison.
				   
				   Découvrir la cuisine sud-américaine dans le quartier de West Midtown: ce quartier en évolution abrite de nombreux restaurants proposant une cuisine sud-américaine inventive, ainsi que des bars et des magasins branchés.
				   <br><br>Gastronomie : Atlanta est réputée pour ses plats de cuisine sud-américaine, tels que le fried chicken (poulet frit) et les collard greens (feuilles de chou frisé), ainsi que pour sa scène gastronomique en constante évolution qui propose une cuisine internationale variée et inventive.


					</div>
					<div class="h-1 bg-gray-300 rounded my-5"></div>
				   <br>
				   <div class="flex flex-col items-center">
					 <img src="assets/Miami.jfif" alt="Miami" width="700" height="300" style="float: left; margin-right: 10px;">
					 <h2 class="text-xl font-mono mt-4">Miami</h2>
					 <p class="text-black-700 mt-2">Miami est une destination touristique populaire pour ses plages de sable blanc et ses eaux turquoises. 
					   Miami est également connue pour son architecture Art déco, son quartier cubain animé et sa vie nocturne effervescente. 
					   La ville est un centre culturel et économique important, notamment pour les affaires, la finance et le commerce international. 
					   Enfin, Miami est célèbre pour sa cuisine locale, telle que les "Cuban Sandwiches" et les "Stone Crabs".</p>
				   <br<<br>Activités : Miami offre de nombreuses options pour les visiteurs et les résidents. Voici quelques-unes des activités les plus populaires à faire à Miami:

				   Se détendre sur la plage de South Beach: cette plage célèbre est connue pour son sable blanc et son ambiance animée.
				   
				   Visiter le musée de l'Art de Miami: ce musée abrite une collection éclectique d'art moderne et contemporain, ainsi que des expositions temporaires et des événements spéciaux.
				   
				   Découvrir le quartier de Little Havana: ce quartier cubain historique est connu pour ses magasins, ses restaurants et ses fêtes de la rue.
				   
				   Participer à un match des Marlins de Miami: le Marlins Park est le foyer des Marlins de Miami et propose des activités pour tous les âges, des concerts et des événements tout au long de la saison.
				   
				   Se promener dans le jardin botanique de Miami: ce jardin tropical offre une vue sur les plantes exotiques et les animaux de la Floride.
				   
				   Déguster de la cuisine cubaine dans le quartier de Little Havana: ce quartier regorge de restaurants proposant de la cuisine cubaine traditionnelle, tels que des sandwichs cubains, des plats de riz et de haricots noirs et de la viande grillée.
				   <br><br>
				   <img src="assets/fish.jfif" alt="New York" width="500" height="300" style="float: right; margin-right: 10px;">
				  <br >
				   <br><br>Gastronomie : Miami propose une cuisine cubaine traditionnelle, ainsi que des options gastronomiques plus modernes, telles que des restaurants de poissons et fruits de mer, des restaurants de fruits de mer, des restaurants de cuisine néo-latine et des restaurants gastronomiques proposant une cuisine inventive.

					</div>
					<div class="h-1 bg-gray-300 rounded my-5"></div>
				   <br>
				   <div class="flex flex-col items-center">
					 <img src="assets/La Nouvelle Orléans.jfif" alt="La Nouvelle Orléans" width="700" height="300" style="float: left; margin-right: 10px;">
					 <h2 class="text-xl font-mono mt-4">La Nouvelle-Orléans</h2>
					 <p class="text-black-700 mt-2">La Nouvelle-Orléans est riche en histoire et en culture, connue pour son patrimoine français et espagnol. 
					   La Nouvelle-Orléans est célèbre pour sa musique, telle que le jazz, la musique de la Nouvelle-Orléans et le blues, ainsi que pour sa cuisine, notamment les plats cajuns et creoles. 
					   La ville abrite également de nombreux festivals célèbres, tels que le Mardi Gras et le Jazz Fest. Enfin, La Nouvelle-Orléans est connue pour ses bâtiments historiques, tels que le French Quarter et le St. Louis Cathedral, ainsi que pour son architecture colorée et ses rues animées.</p>
					   <br><br>
					   <div class="flex">
					  <img src="assets/mardigras.jpg" alt="La Nouvelle Orléans" width="500" height="300" style="float: right; margin-right: 30px;">
					  <img src="assets/nojazz.jfif" alt="La Nouvelle Orléans" width="500" height="300" style="float: right; margin-left: 30px;">
					</div>
					  <br><br>Activités : La Nouvelle-Orléans propose un large éventail d'options pour les visiteurs et les résidents. Voici quelques-unes des activités les plus populaires à faire à La Nouvelle-Orléans:
					
				   Se promener dans le Quartier Français: ce quartier historique est célèbre pour ses bâtiments colorés, ses rues pavées et ses galeries d'art.
				   
				   Participer à la célébration du Mardi Gras: le Mardi Gras est l'une des fêtes les plus célèbres de La Nouvelle-Orléans, avec des défilés colorés, de la musique en direct et des activités animées pour les visiteurs et les résidents.
				   
				   Visiter le cimetière Saint-Louis: ce cimetière historique est connu pour ses tombes intéressantes et ses sculptures complexes.
				   
				   Se détendre dans le parc de City Park: ce parc de 1300 hectares offre des activités pour tous les âges, notamment des chemins pédestres, des étangs pour la pêche, des terrains de golf et un jardin botanique.
				   
				   Participer à un concert de jazz: La Nouvelle-Orléans est célèbre pour sa scène de jazz animée, avec des concerts tous les soirs dans des clubs de jazz et des bars à cocktails historiques.
				   
				   Déguster de la cuisine créole dans un restaurant local: La Nouvelle-Orléans propose une cuisine créole riche et délicieuse, servie dans des restaurants renommés tels que Commanders Palace, Galatoire's et Dooky Chase's.
				   <br><br>Gastronomie: la cuisine de La Nouvelle-Orléans est une fusion de cultures française, africaine, créole et cajun. Les plats célèbres incluent des écrevisses étouffées, des jambalayas, des gumbos, des po'boys, des beignets et bien plus encore. La ville regorge de restaurants renommés, de bars à cocktails historiques et de petits stands de nourriture qui proposent une cuisine authentique.

					</div>
					<div class="h-1 bg-gray-300 rounded my-5"></div>
				   <br>
				   <div class="flex flex-col items-center">
					 <img src="assets/Honolulu.webp" alt="Honolulu" width="700" height="300" style="float: left; margin-right: 10px;">
					 <h2 class="text-xl font-mono mt-4">Honolulu</h2>
					 <p class="text-black-700 mt-2">Honolulu est la capitale et la ville la plus peuplée de l'État d'Hawaii. 
					   C'est une destination touristique populaire pour ses plages de sable blanc et ses eaux turquoises, ainsi que pour son climat tropical. 
					   Honolulu est également célèbre pour son patrimoine historique, tels que le Palais Iolani et le sanctuaire de la reine Liliuokalani. 
					   La ville abrite également de nombreux musées, tels que le Musée d'art de Honolulu et le Musée Bishop, ainsi que des sites naturels, tels que le Diamond Head et les jardins botaniques de Foster. 
					   Enfin, Honolulu est connue pour sa cuisine locale, telle que le "plate lunch" et le "Poke", ainsi que pour sa scène musicale hawaïenne.</p>
					   <br><br>
					   <div class="flex">
					   <img src="assets/hawaii surf.jfif" alt="New York" width="500" height="300" style="float: right; margin-right: 50px;">
					   <img src="assets/hawaii statue.jpg" alt="New York" width="300" height="500" style="float: right; margin-left: 30px;">
					   </div>
					   <br><br>Activités : Honolulu propose un large éventail d'options pour les visiteurs et les résidents. Voici quelques-unes des activités les plus populaires à faire à Honolulu:

				   Se détendre sur Waikiki Beach: cette plage célèbre est un incontournable pour les visiteurs, avec des activités telles que le surf, la natation, le paddleboarding et la plongée.
				   
				   Visiter le Musée Bishop: ce musée d'histoire naturelle propose des expositions sur la faune et la flore hawaïennes, ainsi que sur la culture et l'histoire de Hawaï.
				   
				   Explorer le Diamond Head State Monument: ce monument naturel offre une vue imprenable sur Honolulu et la mer, ainsi que des sentiers de randonnée pour les amateurs de plein air.
				   
				   Assister à un spectacle de hula: les spectacles de hula sont un aspect important de la culture hawaïenne, avec des performances de danse traditionnelle dans les hôtels, les restaurants et les théâtres de la ville.
				   
				   Déguster des plats hawaïens traditionnels dans un restaurant local: Honolulu propose une cuisine hawaïenne délicieuse, avec des plats tels que le poi, le kalua pig et le laulau, servis dans des restaurants tels que Helena's Hawaiian Food et Ono Seafood.
				   
				   Participer à une excursion dans les îles hawaïennes: Honolulu est le point de départ idéal pour explorer les îles hawaïennes, avec des excursions en bateau, en avion ou en hélicoptère pour visiter les îles voisines telles que Maui, Kauai et le Big Island.
				   <br><br>
					   <img src="assets/plathawaii.jpg" alt="New York" width="500" height="300" style="float: right; margin-right: 10px;">
				   <br><br>Gastronomie : Honolulu propose une cuisine variée, allant des plats hawaïens traditionnels à la cuisine asiatique, en passant par la cuisine américaine moderne. Les plats célèbres incluent le poke, le spam musubi, le loco moco et le manapua. Il y a également de nombreux restaurants renommés qui proposent une cuisine inventive, ainsi que des stands de nourriture pop-up et des trucks à nourriture pour les goûters rapides.

					</div>
					<div class="h-1 bg-gray-300 rounded my-5"></div>
				   <br>
					 <div class="flex flex-col items-center">
					   <img src="assets/Statue de la liberté.jfif" alt="La Statue de la Liberté" width="500" height="700" style="float: left; margin-right: 10px;">
					   <h2 class="text-xl font-mono mt-4">La Statue de la Liberté</h2>
					   <p class="text-black-700 mt-2">La Statue de la Liberté est un monument emblématique des États-Unis situé sur une île près de New York Harbor.<br>Il a été offert par les citoyens français en 1886 pour célébrer le centenaire de l'indépendance américaine. La statue, conçue par Frédéric Auguste Bartholdi, représente une figure féminine tenant une torche dans une main et un livre ouvert dans l'autre, symbolisant l'éclairage et la démocratie.

						<br>La Statue de la Liberté est considérée comme l'un des monuments les plus célèbres du monde et est devenue un symbole de l'immigration américaine, accueillant des millions de visiteurs chaque année. Les visiteurs peuvent monter jusqu'au sommet de la statue pour une vue panoramique sur New York Harbor et la ville de New York.</p>
					 </div>
					 <div class="h-1 bg-gray-300 rounded my-5"></div>
					 <br>
					 <div class="flex flex-col items-center">
					   <img src="assets/Grand Canyon.jfif" alt="Le Grand Canyon" width="700" height="300" style="float: left; margin-right: 10px;">
					   <h2 class="text-xl font-mono mt-4">Le Grand Canyon</h2>
					   <p class="text-black-700 mt-2">Le Grand Canyon est un site naturel situé dans le nord de l'Arizona aux États-Unis.<br>Le Grand Canyon est connu pour ses couches de roches de différentes couleurs et âges exposées par l'érosion, offrant un aperçu unique de l'histoire géologique de la Terre. Il est considéré comme l'une des plus grandes merveilles naturelles du monde et est un parc national populaire pour les randonnées, les activités en plein air et les excursions en rafting en eau vive.</p>
					 </div>
					 <div class="h-1 bg-gray-300 rounded my-5"></div>
					 <br>
					 <div class="flex flex-col items-center">
					   <img src="assets/Monument Valley.jpg" alt="Monument Valley" width="700" height="300" style="float: left; margin-right: 10px;">
					   <h2 class="text-xl font-mono mt-4">Monument Valley</h2>
					   <p class="text-black-700 mt-2">Monument Valley est un paysage naturel emblématique des États-Unis, situé dans l'Arizona et l'Utah. Il se compose de formations de roches en grès rouge caractéristiques, telles que des buttes et des méandres imposants.<br> C'est un lieu de tournage fréquent pour des films et des publicités, en raison de sa beauté naturelle et de son paysage unique. Monument Valley est également un site sacré pour les Navajo, qui habitent la région et considèrent les formations rocheuses comme des lieux spirituels importants.</p>
					 </div>
					 <div class="h-1 bg-gray-300 rounded my-5"></div>
					 <br>
					 <div class="flex flex-col items-center">
					   <img src="assets/Death Valley.jfif" alt="Death Valley" width="700" height="300" style="float: left; margin-right: 10px;">
					   <h2 class="text-xl font-mono mt-4">Death Valley</h2>
					   <p class="text-black-700 mt-2">La Death Valley (La Vallée de la Mort en français) est une vallée aride et inhospitalière, renommée pour ses paysages désertiques uniques et ses températures extrêmement élevées.<br> La Vallée de la Mort abrite également des géomorphologies intéressantes telles que des formations rocheuses uniques, des dunes de sable, et des canyons. C'est un site touristique populaire pour les amateurs de nature et d'aventure.</p>
					 </div>
					 <div class="h-1 bg-gray-300 rounded my-5"></div>
					 <br>
					 <div class="flex flex-col items-center">
					   <img src="assets/Sequoia Forest.jpeg" alt="La Grande Forêt de Sequoias" width="400" height="600" style="float: left; margin-right: 10px;">
					   <h2 class="text-xl font-mono mt-4">La Grande Forêt de Sequoias</h2>
					   <p class="text-black-700 mt-2">Cette Forêt est célèbre pour ses arbres géants de la famille des séquoias, qui sont les plus grands arbres du monde par leur volume.<br> La forêt abrite également d'autres espèces d'arbres anciennes et diverses formes de vie animale. Les séquoias géants attirent des milliers de visiteurs chaque année, qui viennent explorer les forêts et admirer les arbres imposants. Les séquoias géants sont considérés comme des symboles de la puissance de la nature et de la résistance à travers les âges.</p>
					 </div>
					 <div class="h-1 bg-gray-300 rounded my-5"></div>
					 <br>
					 <div class="flex flex-col items-center">
					   <img src="assets/Mont Rushmore.jpg" alt="Le Mont Rushmore" width="700" height="300" style="float: left; margin-right: 10px;">
					   <h2 class="text-xl font-mono mt-4">Le Mont Rushmore</h2>
					   <p class="text-black-700 mt-2">Monument national situé dans le Dakota du Sud, aux États-Unis. Il est célèbre pour ses sculptures géantes de la tête de quatre présidents américains : George Washington, Thomas Jefferson, Theodore Roosevelt et Abraham Lincoln. Les sculptures ont été creusées à même la montagne au cours de plusieurs années par le sculpteur Gutzon Borglum et son équipe. Le Mont Rushmore est devenu un symbole important de l'histoire et de l'identité américaines, et il attire des millions de visiteurs chaque année.</p>
					 </div>
					 <div class="h-1 bg-gray-300 rounded my-5"></div>
					 <br>
					 <div class="flex flex-col items-center">
					   <img src="assets/Alcatraz.jfif" alt="Alcatraz" width="700" height="300" style="float: left; margin-right: 10px;">
					   <h2 class="text-xl font-mono mt-4">Alcatraz</h2>
					   <p class="text-black-700 mt-2">Alcatraz est une île située en face de San Francisco.<br> Elle est célèbre pour avoir été utilisée comme prison fédérale pendant plusieurs décennies, entre les années 1930 et 1960.<br> Alcatraz a été considérée comme l'une des prisons les plus sûres et les plus inévadables de l'époque, et elle a accueilli de nombreux criminels célèbres. Depuis son abandon en 1963, l'île a été transformée en parc national et est ouverte aux visiteurs, qui peuvent explorer les bâtiments historiques et apprendre sur son passé. Alcatraz est devenu un site touristique populaire et un symbole de la justice pénale aux États-Unis.</p>
					 </div>
					 <div class="h-1 bg-gray-300 rounded my-5"></div>
					 <br>
					 <div class="flex flex-col items-center">
					   <img src="assets/Yellowstone.jfif" alt="Le Yellowstone" width="700" height="300" style="float: left; margin-right: 10px;">
					   <h2 class="text-xl font-mono mt-4">Le Yellowstone</h2>
					   <p class="text-black-700 mt-2">Le Yellowstone est le plus ancien parc national des États-Unis et l'un des plus importants du monde.<br> Il est situé principalement dans l'État du Wyoming, mais s'étend également dans les États de Montana et d'Idaho. Yellowstone est célèbre pour ses geysers uniques et ses sources chaudes, ainsi que pour ses paysages spectaculaires de montagnes, de lacs et de forêts.<br> Le parc abrite également une faune diversifiée, notamment des ours, des bisons, des loups et des élans. Yellowstone est visité par des millions de personnes chaque année et est considéré comme un joyau de la nature américaine.</p>
					 </div>
					 <div class="h-1 bg-gray-300 rounded my-5"></div>
					 <br>
					 <div class="flex flex-col items-center">
					   <img src="assets/Grand Téton.jfif" alt="Le Grand Téton" width="700" height="300" style="float: left; margin-right: 10px;">
					   <h2 class="text-xl font-mono mt-4">Le Grand Téton</h2>
					   <p class="text-black-700 mt-2">Le Grand Teton est un massif montagneux situé dans le parc national de Grand Teton, dans l'État du Wyoming, aux États-Unis. Il s'agit du plus haut sommet du parc et est célèbre pour sa forme distincte et son relief escarpé.<br> Le Grand Teton est un site de randonnée populaire, offrant des vues spectaculaires sur les montagnes et les vallées environnantes. Le parc national de Grand Teton abrite également une faune variée, notamment des grizzlis, des bisons, des élans et des oiseaux migrateurs.<br>Le Grand Teton est considéré comme un symbole de la beauté sauvage de l'Ouest américain.</p>
					 </div>
			         <br>
					 <br>

			         <h3 class="text-2xl font-mono mb-4" style="text-align: center;">Merci de votre visite et à bientôt</h3>
			    </div>
		
		
				<!-- Scripts -->
			
				<script src="assets/js/main.js"></script>

	</body>
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
</html>