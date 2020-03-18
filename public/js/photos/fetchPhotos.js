document.addEventListener("DOMContentLoaded", function () {
    var targetElement = document.getElementById('pinBoot');

    fetch('/all-photos/partial')
        .then(function (response) {
            return response.text();
        })
        .then(function (html) {
            targetElement.innerHTML = html;
        })
        .catch(function (error) {
            console.log(error);
        });
});