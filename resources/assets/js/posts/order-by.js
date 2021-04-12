document.addEventListener("DOMContentLoaded", function () {
    var allowedKeysForOrderBy = ['date', 'views'];
    var allowedKeysForOrderByDirection = ['desc', 'asc'];
    var defaultOrderByKey = allowedKeysForOrderBy[0];
    var defaultOrderByDirection = allowedKeysForOrderByDirection[0];
    var orderByInput = document.getElementById("orderBy");

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

            var uri = "/posts?order-by=" + orderByKey + "&direction=" + orderByDirection;
            window.location.href = encodeURI(uri);
        }
    });
});