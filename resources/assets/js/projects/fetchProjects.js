document.addEventListener("DOMContentLoaded", function () {
    var identifier = 'js-projects-partial-container';
    var targetElement = document.querySelector(`[data-identifier='${identifier}']`);

    fetch('api/projects/partial')
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