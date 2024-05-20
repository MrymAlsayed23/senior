const hamburger = document.querySelector("#togglebutton");
hamburger.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("expand");
});