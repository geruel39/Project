//NAVIGATION DROP DOWN MENU
const hamburger = document.querySelector("#drop");

hamburger.addEventListener("click", function(){
    document.querySelector(".dropdown").classList.toggle("drop");
})

//ACCOUNT SETTING RESET BUTTON
function refreshPage() {
    location.reload();
  }