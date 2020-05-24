document.addEventListener("DOMContentLoaded", function () {
    var identifier = 'js-photos-partial-container';
    var targetElement = document.querySelector(`[data-identifier='${identifier}']`);

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