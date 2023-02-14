const passwordInput = document.querySelector("#password");
const togglePassword = document.getElementById("toggleid");
const eye=document.querySelector("fa-eye");


togglePassword.addEventListener("click", function () {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
      
    } else {
        passwordInput.type = "password";
       
    }
});