<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
    <title>Document</title>
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
  <header class="fixed top-0 left-0 right-0 z-50 bg-white  dark:bg-gray-900 ">
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