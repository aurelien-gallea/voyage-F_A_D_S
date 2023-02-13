const prog = document.querySelector('.progress');
let scrollPosition = 0;
const maxScrollPosition = 7830;

document.addEventListener("scroll", () => {
    scrollPosition = window.scrollY;
    console.log(scrollPosition);
    let percentValue = (scrollPosition/maxScrollPosition) * 100 + '%';
    prog.style.width = percentValue;
    prog.style.height= '5px';
    
});