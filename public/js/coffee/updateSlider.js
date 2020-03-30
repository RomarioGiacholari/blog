document.addEventListener("DOMContentLoaded", function () {
    var slider = document.getElementById("amount");
    var output = document.getElementById("currentAmount");
    output.innerHTML = slider.value;

    slider.oninput = function () {
        output.innerHTML = this.value;
    }
});