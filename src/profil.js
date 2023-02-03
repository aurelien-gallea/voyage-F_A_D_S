const block1 = document.querySelector('#block1');
const block2 = document.querySelector('#block2');
const password = document.querySelector("#password");
const pass1 = document.querySelector('#passChange1');
const pass2 = document.querySelector('#passChange2');
const pass3 = document.querySelector('#passChange3');
const divBtn = document.querySelector("#divBtn"); // div du button 1er formulaire
const divBtn2 = document.querySelector("#divBtn2"); // div du button 2e formaulaire
const btn = document.querySelector('#btn'); // boutton 1er formulaire
const btn2 = document.querySelector('#btn2'); // boutton 2e formulaire
const passWindow = document.querySelector('#passWindow');
const userWindow = document.querySelector('#userWindow');

block2.style.display = "none"; // on cache par défaut le block2: le changement de mdp


function enabledBtn(button,divButton) {
    button.disabled = false;
    button.style.cursor = "pointer";
    divButton.style.filter = "opacity(1)";
}

function disabledBtn(button,divButton) {
    button.disabled = true;
    button.style.cursor = "not-allowed";
    divButton.style.filter = "opacity(0.2)";
}

disabledBtn(btn,divBtn); // état initial du boutton 1
disabledBtn(btn2,divBtn2); // état initial du boutton 2

password.addEventListener('keyup', () => {
    if(password.value.length >= 2) {
        enabledBtn(btn,divBtn);
    } else {
        disabledBtn(btn,divBtn);
    }
});

function disabledForm2(nameInput) {
    nameInput.addEventListener('keyup', () => {
        if(pass1.value.length >=2 && pass2.value.length >= 2 && pass3.value.length >= 2) {
            enabledBtn(btn2, divBtn2);
        } else {
            disabledBtn(btn2,divBtn2);
        }
    });
}

disabledForm2(pass1);
disabledForm2(pass2);
disabledForm2(pass3);

//le block2 qui correspond à la maj du mot de passe
passWindow.addEventListener('click', (e) => {
    e.preventDefault();
    block2.style.display = "block";
    
    block1.style.display = "none";
});

//le block1 qui correspond à la maj de login / email
userWindow.addEventListener('click', (e) => {
    e.preventDefault();
    block2.style.display = "none";
    block1.style.display = "block";

});