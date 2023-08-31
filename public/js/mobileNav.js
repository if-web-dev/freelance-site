const menuBtn = document.querySelector(".menu-btn");
const wrapper = document.querySelector(".wrapper-mobile");
const mobileMenuClose = document.querySelectorAll(".mobile-menu-close");

menuBtn.addEventListener("click", () => {
    //alert("Le bouton a été cliqué !");
    menuBtn.classList.toggle("appear");
    wrapper.classList.toggle("appear");
});


mobileMenuClose.forEach((close) => {
    close.addEventListener("click",() => {
        menuBtn.classList.toggle("appear");
        wrapper.classList.toggle("appear");
    });
});