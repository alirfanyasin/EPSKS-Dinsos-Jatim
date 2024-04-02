// modal add
var modalAdd = document.getElementById("modalAdd");
var btnAdd = document.getElementById("btnModalAdd");
var btnClose = document.getElementById("closeModal");
var span = document.getElementsByClassName("close")[0];

btnAdd.onclick = function () {
    modalAdd.style.display = "block";
};

btnClose.onclick = function () {
    modalAdd.style.display = "none";
};

span.onclick = function () {
    modalAdd.style.display = "none";
};

window.onclick = function (event) {
    if (event.target == modal) {
        modalAdd.style.display = "none";
    }
};
