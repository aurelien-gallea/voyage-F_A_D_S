<?php
session_start();
?>

<!-------------------------------------------- HTML -------------------------------------------->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/voyages.css">
    <link rel="stylesheet" href="css/stylefooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@0.2.28/bundled/lenis.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <title>Au coeur de l'Inde | Tasty Trip</title>
    <script>
        tailwind.config = {
            darkMode: 'class',
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

<!----------------------------------Body-------------------------------------------->

<body>
    <?php require_once('src/header.php'); ?>
    
    <div class="flex items-center justify-center h-screen mb-12 bg-fixed bg-center bg-cover custom-img">
        <div class="p-5 text-2xl text-white bg-purple-300 bg-opacity-50 rounded-xl">
        L'Inde, un voyage spirituel
        </div>
    </div>
    <div class="max-w-lg m-auto">
        <p class="mb-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat a
            magna non varius. Proin leo felis, euismod non porta eget, varius sit amet
            sapien. Maecenas in nulla at leo convallis consectetur id a sapien. Nulla
            nec pulvinar nisi. Vivamus non facilisis lacus, et volutpat libero. Nulla ac
            odio aliquam, accumsan arcu ut, lacinia est. Nulla eu sem elit. Fusce nec
            laoreet sem, semper molestie libero.
        </p>
        <p class="mb-4">
            Ut sagittis lacus consequat accumsan venenatis. Sed sollicitudin, lectus et
            fringilla ultrices, dolor nisi scelerisque tortor, vel finibus magna massa
            non nunc. Phasellus massa quam, egestas a nisl sed, porta volutpat metus.
            Nunc sed elit ac tellus tempor cursus. Suspendisse potenti. Vestibulum
            varius rutrum nisl nec consequat. Suspendisse semper dignissim sem viverra
            semper. Nulla porttitor, purus nec accumsan pharetra, nisi dolor condimentum
            ipsum, id consequat nulla nunc in ligula.
        </p>
        <p class="mb-12">
            Nulla pharetra lacinia nisi, vitae mollis tellus euismod id. Mauris porta
            dignissim hendrerit. Cras id velit varius, fermentum lectus vitae, ultricies
            dolor. In bibendum rhoncus purus vel rutrum. Nam vulputate imperdiet
            fringilla. Donec blandit libero massa. Suspendisse dictum diam mauris, vitae
            fermentum dolor tincidunt in. Pellentesque sollicitudin venenatis dolor,
            vitae scelerisque elit ultrices eu. Donec eget sodales risus, quis dignissim
            neque.
        </p>
    </div>
    <section class="container flex items-center justify-center h-screen m-auto mb-12 bg-fixed bg-center bg-cover custom-img">
        <div class="p-5 text-2xl text-white bg-purple-300 bg-opacity-50 rounded-xl">
            Parralax inline
        </div>
    </section>
    <div class="max-w-lg m-auto">
        <p class="mb-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat a
            magna non varius. Proin leo felis, euismod non porta eget, varius sit amet
            sapien. Maecenas in nulla at leo convallis consectetur id a sapien. Nulla
            nec pulvinar nisi. Vivamus non facilisis lacus, et volutpat libero. Nulla ac
            odio aliquam, accumsan arcu ut, lacinia est. Nulla eu sem elit. Fusce nec
            laoreet sem, semper molestie libero.
        </p>
        <p class="mb-4">
            Ut sagittis lacus consequat accumsan venenatis. Sed sollicitudin, lectus et
            fringilla ultrices, dolor nisi scelerisque tortor, vel finibus magna massa
            non nunc. Phasellus massa quam, egestas a nisl sed, porta volutpat metus.
            Nunc sed elit ac tellus tempor cursus. Suspendisse potenti. Vestibulum
            varius rutrum nisl nec consequat. Suspendisse semper dignissim sem viverra
            semper. Nulla porttitor, purus nec accumsan pharetra, nisi dolor condimentum
            ipsum, id consequat nulla nunc in ligula.
        </p>
        <p class="mb-4">
            Nulla pharetra lacinia nisi, vitae mollis tellus euismod id. Mauris porta
            dignissim hendrerit. Cras id velit varius, fermentum lectus vitae, ultricies
            dolor. In bibendum rhoncus purus vel rutrum. Nam vulputate imperdiet
            fringilla. Donec blandit libero massa. Suspendisse dictum diam mauris, vitae
            fermentum dolor tincidunt in. Pellentesque sollicitudin venenatis dolor,
            vitae scelerisque elit ultrices eu. Donec eget sodales risus, quis dignissim
            neque.
        </p>
    </div>
    <!-- <div class="mt-32"> -->
        <!-- <h1 class="text-center text-5xl mb-10">L'Inde, un voyage spirituel</h1> -->
    <!-- <img src="" alt="Le mausolée de Safdar Jung"> -->

    <!----------------------------------- Footer ------------------------------------>
    <?php require_once('src/footer.php'); ?>
    <script>
		var themeToggleDarkIcon = document.getElementById(
			"theme-toggle-dark-icon"
		);
		var themeToggleLightIcon = document.getElementById(
			"theme-toggle-light-icon"
		);

		// Change the icons inside the button based on previous settings
		if (
			localStorage.getItem("color-theme") === "dark" ||
			(!("color-theme" in localStorage) &&
				window.matchMedia("(prefers-color-scheme: dark)").matches)
		) {
			themeToggleLightIcon.classList.remove("hidden");
		} else {
			themeToggleDarkIcon.classList.remove("hidden");
		}

		var themeToggleBtn = document.getElementById("theme-toggle");

		themeToggleBtn.addEventListener("click", function() {
			// toggle icons inside button
			themeToggleDarkIcon.classList.toggle("hidden");
			themeToggleLightIcon.classList.toggle("hidden");

			// if set via local storage previously
			if (localStorage.getItem("color-theme")) {
				if (localStorage.getItem("color-theme") === "light") {
					document.documentElement.classList.add("dark");
					localStorage.setItem("color-theme", "dark");
				} else {
					document.documentElement.classList.remove("dark");
					localStorage.setItem("color-theme", "light");
				}

				// if NOT set via local storage previously
			} else {
				if (document.documentElement.classList.contains("dark")) {
					document.documentElement.classList.remove("dark");
					localStorage.setItem("color-theme", "light");
				} else {
					document.documentElement.classList.add("dark");
					localStorage.setItem("color-theme", "dark");
				}
			}
		});
	</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>