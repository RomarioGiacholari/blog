document.addEventListener("DOMContentLoaded", function () {
    var endpoint = "api/photos";
    var identifier = 'thumbnail';
    var targetElement = document.getElementById(identifier);
    var refreshPhoto = function (photos, targetElement) {
        if (photos && targetElement) {
            var origin = window.location.origin;
            var keys = Object.keys(photos);
            var selectedKey = keys[Math.floor(Math.random() * keys.length)]
            var photo = photos[selectedKey];
            var src = `${origin}/${photo}`;
            var photoFriendlyName = photo.replace(".jpg", "");

            targetElement.src = src;
            targetElement.title = photoFriendlyName;
            targetElement.alt = photoFriendlyName;
        }
    }

    fetch(endpoint)
        .then(function (response) {
            return response.json();
        })
        .then(function (photos) {
            if (photos) {
                setInterval(function () {
                    refreshPhoto(photos, targetElement);
                }, 5000);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
});