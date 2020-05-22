document.addEventListener("DOMContentLoaded", function () {
    var identifier = "js-privacy-policy-content-placeholder";
    var content = document.getElementById(identifier);
    var endpoint = "/privacy-policy/content";

    fetch(endpoint)
        .then(function (response) {
            return response.text();
        })
        .then(function (html) {
            content.innerHTML = html;
        })
        .catch(function (error) {
            console.log(error);
        });
});