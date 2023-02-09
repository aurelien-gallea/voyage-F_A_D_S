// buttons update
const artContainer = document.querySelectorAll('.artContainer'); // div pour cacher le titre + boutton update/delete
const update = document.querySelectorAll('.update'); // boutton pour cacher la div 
const btnContainer = document.querySelectorAll('.btnContainer');
const artChange = document.querySelectorAll('.artChange');
const cancelBtn = document.querySelectorAll('.cancelBtn');
const confirmBtn = document.querySelectorAll('.confirmBtn');

// on fait appraître / disparaître les blocs pour modifier l'article
function showHidden(button) {
    
    for (let i = 0; i < button.length; i++) {
    
        button[i].addEventListener('click', (e) => {
            e.preventDefault();
    
                artChange[i].classList.toggle('hidden');
                btnContainer[i].classList.toggle('hidden');
                artContainer[i].classList.toggle('hidden');
            });
        }
    }

// pour faire apparaître le bloc pour modifier un article
showHidden(update);
showHidden(cancelBtn);
