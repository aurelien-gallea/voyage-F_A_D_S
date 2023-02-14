// formulaire n 1
const block1 = document.querySelector('#block1'); 
const password = document.querySelector("#password"); 
const divBtn = document.querySelector("#divBtn"); // div du button 1er formulaire
const btn = document.querySelector('#btn'); // boutton 1er formulaire
const passWindow = document.querySelector('#passWindow'); // lien vers le 2e form

// formulaire n 2
const block2 = document.querySelector('#block2'); 
const pass1 = document.querySelector('#passChange1'); // ancien mdp
const pass2 = document.querySelector('#passChange2'); // nouveau mdp
const pass3 = document.querySelector('#passChange3'); // confirmer nouveau mdp
const notMatch = document.querySelector('#notMatch'); // message d'erreur form 2
const divBtn2 = document.querySelector("#divBtn2"); // div du button 2e formaulaire
const btn2 = document.querySelector('#btn2'); // boutton 2e formulaire
const userWindow = document.querySelector('#userWindow'); // lien vers le 1er form

const regexPass = new RegExp( // on oblige l'utilisateur à nous rentrer un mdp contenant 8 caracteres: 1maj, 1min, 1caract spécial et 1 chiffre
    "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})"
  );

// buttons update
const artContainer = document.querySelectorAll('.artContainer'); // div pour cacher le titre + boutton update/delete
const update = document.querySelectorAll('.update'); // boutton pour cacher la div 
const btnContainer = document.querySelectorAll('.btnContainer');
const artChange = document.querySelectorAll('.artChange');
const cancelBtn = document.querySelectorAll('.cancelBtn');
const confirmBtn = document.querySelectorAll('.confirmBtn');
block2.style.display = "none"; // on cache par défaut le block2: le changement de mdp

// activation du boutton
function enabledBtn(button,divButton) {
    button.disabled = false;
    button.style.cursor = "pointer";
    divButton.style.filter = "opacity(1)";
}
// desactivation du boutton
function disabledBtn(button,divButton) {
    button.disabled = true;
    button.style.cursor = "not-allowed";
    divButton.style.filter = "opacity(0.2)";
}

disabledBtn(btn,divBtn); // état initial du boutton 1
disabledBtn(btn2,divBtn2); // état initial du boutton 2


// on désactive le 1er formulaire tant que le mdp ne respecte pas le regex 
// qu'on a fixé au départ lors de l'inscription

password.addEventListener('keyup', () => {
    if(regexPass.test(password.value)) {
        enabledBtn(btn,divBtn);
    } else {
        disabledBtn(btn,divBtn);
    }
});

// on affiche/cache un message d'erreur si les mdp ne correspondent pas
function passMatching() {
    if(pass2.value == pass3.value) {
        notMatch.style.visibility = "hidden";
    } else {
        notMatch.style.visibility = "visible";
    }
}
// pareil on désactive le 2e formulaire tant que le mdp ne respecte pas le regex
function disabledForm2(nameInput, event) {
    nameInput.addEventListener(event, () => {
        
        passMatching();

        if(regexPass.test(pass1.value) && regexPass.test(pass2.value) && regexPass.test(pass3.value) && (pass2.value == pass3.value)) {
            
            enabledBtn(btn2, divBtn2);

        } else {
            
            disabledBtn(btn2,divBtn2);
        }
    });
}

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

//le lien qui fait apparaitre le 2e formulaire et disparaitre le 1er
passWindow.addEventListener('click', (e) => {
    e.preventDefault();
    block2.style.display = "block";
    block1.style.display = "none";
});

//le lien qui fait apparaitre le 1e formulaire et disparaitre le 2eme
userWindow.addEventListener('click', (e) => {
    e.preventDefault();
    block2.style.display = "none";
    block1.style.display = "block";

});

// on est à l'affût du moindre changement dans les inputs 
// pour désactiver le formulaire
disabledForm2(pass1,'keyup');
disabledForm2(pass2,'keyup');
disabledForm2(pass3,'keyup');

// pour faire apparaître le bloc pour modifier un article
showHidden(update);
showHidden(cancelBtn);

