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

function buttonStatus() {
  if (login.value != "" && regexMail.test(email.value) && (password.value == password2.value) && (regexPass.test(password.value) && regexPass.test(password2.value))) {
    
    divBtn.style.filter = "opacity(1)";
    btn.disabled = false;
    btn.style.cursor = "pointer";
    }
  else {
    btn.disabled = true;
    btn.style.cursor = "not-allowed";
    divBtn.style.filter = "opacity(0.2)";
  }
}

buttonStatus();

login.addEventListener("keyup", () => {
  
    fetch('./src/infos.php')
    .then(response => response.json())
    .then(response => {
      for(key in response) {
        if(response[key].login === login.value) {
          errorLogin.innerHTML = 'Identifiant déjà utilisé !'
          errorLogin.classList.remove('text-red-500');
          errorLogin.classList.add('text-orange-500');
          errorLogin.style.visibility = "visible";
          return;
        } 
        errorLogin.innerHTML = 'Entrez un nom d\'utilisateur';
        errorLogin.classList.remove('text-orange-500');
        errorLogin.classList.add('text-red-500');
        if(login.value != "" && login.value.length > 2) {
          errorLogin.style.visibility = "hidden";
        } else {
          errorLogin.style.visibility = "visible";
        }
      }
    });
  buttonStatus();
});

email.addEventListener("keyup", () => {
  if (!regexMail.test(email.value)) {
    errorEmail.style.visibility = "visible";
    errorEmail.innerHTML = "Utilisez un email valide"
    errorEmail.classList.remove('text-orange-500');
    errorEmail.classList.add('text-red-500');
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
          btn.disabled = true;
          return;
        }     
      }
    });
    errorEmail.style.visibility = "hidden";
    errorEmail.innerHTML= ".";
    buttonStatus();
  }
});

password.addEventListener("keyup", () => {
  if (password.value != password2.value) {
    errorPassword.style.visibility = "visible";
  } else {
    if (!regexPass.test(password.value)) {
      errorPassword.style.visibility = "visible";
    } else {
      errorPassword.style.visibility = "hidden";
      buttonStatus();
    }
  }
});
password2.addEventListener("keyup", () => {
  if (password.value != password2.value) {
    errorPassword.style.visibility = "visible";
  } else {
    if (!regexPass.test(password2.value)) {
      errorPassword.style.visibility = "visible";
    } else {
      errorPassword.style.visibility = "hidden";
      buttonStatus();
    }
  }
});

btn.addEventListener('mouseover', () => {
    buttonStatus();
});
btn.addEventListener('focus', () => {
    buttonStatus();
});