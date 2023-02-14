// buttons update
const artContainer = document.querySelectorAll(".artContainer"); // div pour cacher le titre + boutton update/delete
const update = document.querySelectorAll(".update"); // boutton pour cacher la div
const btnContainer = document.querySelectorAll(".btnContainer");
const artChange = document.querySelectorAll(".artChange");
const cancelBtn = document.querySelectorAll(".cancelBtn");
const confirmBtn = document.querySelectorAll(".confirmBtn");

const menus = document.querySelectorAll(".menus");
const menuContent = document.querySelectorAll(".menu-content");

for (let i = 0; i < menuContent.length; i++) {
  menuContent[i].classList.toggle("hidden");

  menus[i].addEventListener("click", (e) => {
      
      menus[i].classList.toggle("bg-color-1");
      menus[i].classList.toggle("bg-color-5");
      menuContent[i].classList.toggle("hidden");
      
      if (menuContent[i].classList.contains("hidden")) {
          menus[i].textContent = "Ouvrir menu";
        } else {
            menus[i].textContent = "Fermer menu";
        }
        e.preventDefault();
    });
}

// on fait appraître / disparaître les blocs pour modifier l'article
function showHidden(button) {
  for (let i = 0; i < button.length; i++) {
    button[i].addEventListener("click", (e) => {
      e.preventDefault();

      artChange[i].classList.toggle("hidden");
      btnContainer[i].classList.toggle("hidden");
      // artContainer[i].classList.toggle("hidden");
    });
  }
}

// pour faire apparaître le bloc pour modifier un article
showHidden(update);
showHidden(cancelBtn);