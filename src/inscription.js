const login = document.querySelector("#login");
const email = document.querySelector("#email");
const password = document.querySelector("#password");
const password2 = document.querySelector("#password2");
const error = document.querySelector("#error");
const errorLogin = document.querySelector("#errorLogin");
const errorEmail = document.querySelector("#errorEmail");
const errorPassword = document.querySelector("#errorPassword");
const divBtn = document.querySelector("#divBtn");
const btn = document.querySelector("#btn");
const regexMail =
  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,6}))$/;
const regexPass = new RegExp(
  "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})"
);
let used = 0; // doublon login
let usedMail = 0; // doublon mail

function enabledBtn() { // activer le btn
    divBtn.style.filter = "opacity(1)";
    btn.disabled = false;
    btn.style.cursor = "pointer";
}

function disabledBtn() { // desactiver btn
    btn.disabled = true;
    btn.style.cursor = "not-allowed";
    divBtn.style.filter = "opacity(0.2)";
}

function buttonStatus() { // le status du bouton 
  if (used== 0 && usedMail==0 && login.value.length >=2 && regexMail.test(email.value) && (password.value == password2.value) && (regexPass.test(password.value) && regexPass.test(password2.value))) {
    
    enabledBtn();
    }
  else {
    disabledBtn();
  }
}

// on recupère un json envoyé par le back pour vérifier si le login existe déjà
function fetchLogin() { 
  fetch('./src/infos.php')
  .then(response => response.json())
  .then(response => {
    for(key in response) {
      if(response[key].login === login.value) {
        errorLogin.innerHTML = 'Identifiant déjà utilisé !'
        errorLogin.classList.remove('text-red-500');
        errorLogin.classList.add('text-orange-500');
        errorLogin.style.visibility = "visible";
        return used=1;
      } 
      errorLogin.innerHTML = 'Entrez un nom d\'utilisateur';
      errorLogin.classList.remove('text-orange-500');
      errorLogin.classList.add('text-red-500');

      if(login.value != "" && login.value.length >= 2) {
        errorLogin.style.visibility = "hidden";
        
      } else {
        errorLogin.style.visibility = "visible";
        
      }
    }
    return used=0;
  });
}

buttonStatus(); // on initialise le bouton en disabled

// input du login
login.addEventListener("keyup", () => {
   fetchLogin();
   buttonStatus();
  
});

//input du mail
email.addEventListener("keyup", () => {
  if (!regexMail.test(email.value)) {
    errorEmail.style.visibility = "visible";
    errorEmail.innerHTML = "Utilisez un email valide"
    errorEmail.classList.remove('text-orange-500');
    errorEmail.classList.add('text-red-500');
    buttonStatus();
  } else {
    fetch('./src/infos.php')
    .then(response => response.json())
    .then(response => {
      for(key in response) {
        if(response[key].email === email.value) {
          errorEmail.innerHTML = 'Email déjà utilisé !'
          errorEmail.classList.remove('text-red-500');
          errorEmail.classList.add('text-orange-500');
          errorEmail.style.visibility = "visible";
          
          return usedMail=1;
        }     
      }
      return usedMail=0;
    });
    errorEmail.style.visibility = "hidden";
    errorEmail.innerHTML= ".";
    
  }
  buttonStatus();
});
 // input password
password.addEventListener("keyup", () => {
  if (password.value != password2.value) {
    errorPassword.style.visibility = "visible";
  } else {
    if (!regexPass.test(password.value)) {
      errorPassword.style.visibility = "visible";
    } else {
      errorPassword.style.visibility = "hidden";
    }
  }
  buttonStatus();
});

// input confirmation password
password2.addEventListener("keyup", () => {
  if (password.value != password2.value) {
    errorPassword.style.visibility = "visible";
  } else {
    if (!regexPass.test(password2.value)) {
      errorPassword.style.visibility = "visible";
    } else {
      errorPassword.style.visibility = "hidden";
    }
  }
  buttonStatus();
});

// on fait une derniere vérification lorsqu'on s'apprete a cliquer sur le bouton
// ou faire tab dessus
btn.addEventListener('mouseover', () => {
    buttonStatus();
});
btn.addEventListener('focus', () => {
    buttonStatus();
});