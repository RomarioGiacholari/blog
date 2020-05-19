var utilities = require('./../utilities/cookies');

document.addEventListener("DOMContentLoaded", function () {
    var cookie = utilities.getCookie("privacy-policy-accepted");

    if (!cookie) {
        var modal = '#privacy-policy-modal';
        var _ = $(`${modal}`).modal('show');

        var identifier = 'js-privacy-policy-modal-body';
        var content = document.getElementById(identifier);
        var endpoint = '/privacy-policy/content';

        var accpetedButtonIdentifier = 'accept-cookie';
        var acceptedButton = document.getElementById(accpetedButtonIdentifier);

        acceptedButton.addEventListener("click", function () {
            var month = 30*24*60*60;
            document.cookie = `privacy-policy-accepted=${true}; max-age=${month}`;
        })

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
    }
});