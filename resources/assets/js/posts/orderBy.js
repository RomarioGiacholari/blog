document.addEventListener("DOMContentLoaded", function () {
    var allowedKeysForOrderBy = ['created_at', 'views'];
    var defaultOrderBy = allowedKeysForOrderBy[0];
    var orderByInput = document.getElementById("orderBy");

    orderByInput.addEventListener("change", function () {
        var currentValue = this.value;

        if (currentValue !== undefined && currentValue !== '') {
            if (!allowedKeysForOrderBy.includes(currentValue)) {
                currentValue = defaultOrderBy;
            }

            var uri = "/posts?orderBy=" + currentValue;
            var encodedUri = encodeURI(uri);
            window.location.href = encodedUri;
        }
    });
});