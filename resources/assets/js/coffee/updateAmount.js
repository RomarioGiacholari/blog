document.addEventListener("DOMContentLoaded", function () {
    var amount = document.getElementById("amount");
    var displayAmount = document.getElementById("currentAmount");

    displayAmount.innerHTML = amount.value;

    amount.addEventListener("input", function () {
        displayAmount.innerHTML = this.value;
    });
});