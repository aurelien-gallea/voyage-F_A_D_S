// buttons update
const update = document.querySelectorAll(".update"); // boutton pour cacher la div
const btnContainer = document.querySelectorAll(".btnContainer");
const artChange = document.querySelectorAll(".artChange");
const cancelBtn = document.querySelectorAll(".cancelBtn");
const confirmBtn = document.querySelectorAll(".confirmBtn");
const deleteBtn = document.querySelectorAll(".delete");
const menus = document.querySelectorAll(".menus");
const menuContent = document.querySelectorAll(".menu-content");
const searchBar = document.querySelectorAll(".searchBar");
const found = document.querySelectorAll(".found");
const categories = document.querySelectorAll(".categories");

console.log(categories[0].textContent);
// la barre de recherche
for (let i = 0; i < searchBar.length; i++) {
    
  searchBar[i].addEventListener('keyup', () => {
    // on controle tous les inputs en meme temps pour ameliorer l'accessibilité
    for (let k = 0; k < searchBar.length; k++) {
      if(searchBar[i].value !== searchBar[k].value) {
        searchBar[k].value = searchBar[i].value;
      }
      
    }

    // on fait apparaitre le résutat de notre recherche
    for (let j = 0; j < found.length; j++) {
      const result = found[j];
      
      let word = result.textContent;
      
      if(word.includes(searchBar[i].value) )  {
        
        result.classList.remove("hidden");
      } else {
        result.classList.add("hidden");

      }      
    }
    // for (let g = 0; g < categories.length; g++) {
    //   let cats = categories[g];
    //   cats = categories.textContent;

    //   if(cats.includes(searchBar[i].value))  {
        
    //     result.classList.remove("hidden");
    //   } else {
    //     result.classList.add("hidden");

    //   }     
      
    // }
  });
}

// la confirmation de suppression
deleteBtn.forEach(element => {
    element.addEventListener('click', (e) => {
      deleteConfirm = confirm('Confirmer la suppresion ?');

      !deleteConfirm ? e.preventDefault() : '';
      
    });
  });
// gestion des menus déroulants
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

      for (let j = 0; j < menuContent.length; j++) {
        if (i == j) {
          continue;
        } else {
          if(!menuContent[j].classList.contains("hidden")) {

            menus[j].classList.toggle("bg-color-5");
            menus[j].classList.toggle("bg-color-1");
            menuContent[j].classList.toggle("hidden");
            menus[j].textContent = "Ouvrir menu";
          }
          
        }
    }
    });
}

// on fait appraître / disparaître les blocs pour modifier l'article
function showHidden(button) {
  for (let i = 0; i < button.length; i++) {
    button[i].addEventListener("click", (e) => {
      e.preventDefault();

      artChange[i].classList.toggle("hidden");
      btnContainer[i].classList.toggle("hidden");
    
    });
  }
}

// pour faire apparaître le bloc pour modifier un article
showHidden(update);
showHidden(cancelBtn);
