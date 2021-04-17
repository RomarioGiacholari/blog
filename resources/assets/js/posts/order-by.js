document.addEventListener("DOMContentLoaded", function () {
    var allowedKeysForOrderBy = ['date', 'views'];
    var allowedKeysForOrderByDirection = ['desc', 'asc'];
    var defaultOrderByKey = allowedKeysForOrderBy[0];
    var defaultOrderByDirection = allowedKeysForOrderByDirection[0];
    var orderByInput = document.getElementById("orderBy");
    var uri = new URL(window.location.href);
    var parameters = uri.searchParams;

    orderByInput.addEventListener("change", function () {
        var currentOrderBy = this.value;

        if (currentOrderBy !== undefined && currentOrderBy !== '') {
            var splitOrderBy = currentOrderBy.split("|");
            var orderByKey = splitOrderBy[0];
            var orderByDirection = splitOrderBy[1];

            if (!allowedKeysForOrderBy.includes(orderByKey)) {
                orderByKey = defaultOrderByKey;
            }

            if (!allowedKeysForOrderByDirection.includes(orderByDirection)) {
                orderByDirection = defaultOrderByDirection;
            }

            parameters.set("order-by", orderByKey);
            parameters.set("direction", orderByDirection);

            if (parameters.get("page")) {
                parameters.set("page", "1");
            }

            window.location.href = encodeURI(uri.href);
        }
    });
});