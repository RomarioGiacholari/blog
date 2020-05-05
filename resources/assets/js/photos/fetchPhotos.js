document.addEventListener("DOMContentLoaded", function () {
    var identifier = 'js-photos-partial-container';
    var targetElement = document.querySelector(`[data-identifier='${identifier}']`);

    fetch('/all-photos/partial')
        .then(function (response) {
            return response.text();
        })
        .then(function (html) {
            setTimeout(function () {
                targetElement.innerHTML = html;
            }, 500);

        })
        .catch(function (error) {
            console.log(error);
        });
});