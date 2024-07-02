//For navigation dropdown menu
const hamburger = document.querySelector("#drop");

hamburger.addEventListener("click", function(){
    document.querySelector(".dropdown").classList.toggle("drop");
})

//For Employeetask page (Admin)
const BtnAdd = document.getElementById("add");
const DivContainer = document.getElementById("adding-block");

let inputCount = 2;

BtnAdd.addEventListener("click", addNew);

function addNew() {
  const newInput = document.createElement("input");
  newInput.type = "text";
  newInput.classList.add("id_input");
  newInput.classList.add("form-control");

  newInput.name = `id-${inputCount}`;
  newInput.value = "TMZ";
  newInput.maxLength = "9";
  newInput.required = true;

  inputCount++;

  DivContainer.appendChild(newInput);
}
