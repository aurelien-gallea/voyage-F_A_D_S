<?php require_once('classes/Update.php'); ?>
  <header class="fixed  top-0 left-0 right-0 z-1 mb-10 bg-white  dark:bg-gray-900 ">
    <nav
      class="    px-2 bg-blue/54 shadow-xl z-2  border-gray-200 dark:bg-gray-900 dark:border-gray-700"
    >
      <div
        class="  relative container flex flex-wrap items-center justify-between content-center mx-auto"
      >
        <a href="index.php" class="flex items-center pl-3">
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
                href="index.php"

                class="block py-2 pl-3 pr-4 text-bg-custom-1C3738 bg-blue-30 rounded md:bg-transparent hover:text-color-3 md:p-0 md:dark:text-white dark:bg-bg-custom-1C3738 md:dark:bg-transparent"
                aria-current="page"
                >Accueil</a
              >
            </li>
            <li>
              <a
                href="articles.php"
                class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent hover:text-color-3 md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                > Articles</a>              
            </li>
            <li>
              <a
                href="creer-article.php"
                class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent hover:text-color-3 md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                >Créer un article</a>              
            </li>                   
            <?php
            if (isset($_SESSION['id'])) {
              $adminStatus = Update::selectStatusByUser($_SESSION['id']);
              if ($adminStatus['droits'] == 'admin') {  ?>
            <li>
              <a href="admin.php"                
                class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-bg-custom-1C3738 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                >Admin</a>              
            </li>                 
             <? }
                else {?>           
            <?php   
          }} ?>
           
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
            <li>

            <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-6 h-6 rounded-full cursor-pointer dark:bg-gray-600" src="assets/utilisateur.png" alt="User dropdown">

<!-- Dropdown menu -->
<div id="userDropdown" class="z-10 duration-100 ease-linear hidden bg-white divide-y divide-gray-100 rounded-lg shadow-xl w-44 dark:bg-gray-700 dark:divide-gray-600">
    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white"> 
      <!-- <div class="font-small truncate">Bienvenue</div> -->
<?php  if(empty($_SESSION)) {?>
  <a  href="connexion.php"
    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
    >Se connecter</a>   <?php }
    else{?>
      <div class=""><p class="text-lg font-bold hover:text-color-5 decoration-dotted uppercase">
        <?=  $_SESSION['login']?></p></div>
    </div>
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
      <li>
        <a href="profil.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white after:content-['_↗']">Profil</a>
      </li>
    <li>      
    <div class="py-1">   
  <a  href="src/logout.php"
    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
    >Se déconnecter</a>  
    <?php } ?>

</li>
   
    </div>
</div>

            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- ---------------------------------- fin de nav----------------------------->
   </header>
