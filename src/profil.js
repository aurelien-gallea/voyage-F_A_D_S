const block1 = document.querySelector('#block1');
const block2 = document.querySelector('#block2');
const pass1 = document.querySelector('#passChange1');
const pass2 = document.querySelector('#passChange2');
const pass3 = document.querySelector('#passChange3');
const passWindow = document.querySelector('#passWindow');
const userWindow = document.querySelector('#userWindow');
block2.style.display = "none";

passWindow.addEventListener('click', (e) => {
    e.preventDefault();
    block2.style.display = "block";
    block1.style.display = "none";
});

userWindow.addEventListener('click', (e) => {
    e.preventDefault();
    block2.style.display = "none";
    block1.style.display = "block";

});