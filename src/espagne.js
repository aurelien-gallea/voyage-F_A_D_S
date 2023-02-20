const prog = document.querySelector('.progress');
let scrollPosition = 0;
const maxScrollPosition = 8830;

document.addEventListener("scroll", () => {
    scrollPosition = window.scrollY;
    let percentValue = (scrollPosition/maxScrollPosition) * 100 + '%';
    prog.style.width = percentValue;
    prog.style.height= '8px';
    
});