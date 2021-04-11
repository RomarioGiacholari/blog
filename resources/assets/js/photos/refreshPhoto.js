document.addEventListener("DOMContentLoaded", function () {
    var endpoint = "api/photos";
    var identifier = 'thumbnail';
    var targetElement = document.getElementById(identifier);
    var refreshPhoto = function (photos, targetElement) {
        if (photos && targetElement) {
            var keys = Object.keys(photos);
            var selectedPhoto = keys[Math.floor(Math.random() * keys.length)]
            var src = photos[selectedPhoto];
            var photoFriendlyName = selectedPhoto;

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