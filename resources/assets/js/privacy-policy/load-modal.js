var utilities = require('./../utilities/cookies').default;

document.addEventListener("DOMContentLoaded", function () {
    var cookieName = '__privacy';
    var isCookie = utilities.getCookie(cookieName);
    var url = window.location.href;
    var isPrivacyPage = url.includes('privacy-policy');

    if (!isPrivacyPage) {
        if (!isCookie || isCookie == null) {
            var modal = '#privacy-policy-modal';
            var _ = $(`${modal}`).modal('show');
            var endpoint = '/privacy-policy/content';
            var contentIdentifier = 'js-privacy-policy-modal-body';
            var content = document.getElementById(contentIdentifier);
            var accpetIdentifier = 'accept-cookie';
            var accept = document.getElementById(accpetIdentifier);
            var setCookie = function () {
                var cookie = {
                    name: cookieName,
                    value: true,
                    age: 30,
                    domain: ".giacholari.com",
                    path: "/"
                };
                var days = cookie.age;
                var length = days * 24 * 60 * 60;
                document.cookie = `${cookie.name}=${cookie.value}; max-age=${length}; domain=${cookie.domain}; path=${cookie.path}`;
            };

            accept.addEventListener("click", setCookie);

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
    }
});