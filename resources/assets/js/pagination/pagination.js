document.addEventListener("DOMContentLoaded", function () {
    var pagination = JSON.parse(document.getElementById('pagination').dataset.pagination);
    var previousButton = document.getElementById('previous');
    var nextButton = document.getElementById('next');
    var page = parseInt(pagination.page);
    var totalPages = parseInt(pagination.totalPages);
    var uri = new URL(window.location.href);
    var parameters = uri.searchParams;

    if (page < 1) {
        page = 1;
    }

    previousButton.disabled = page === 1;
    nextButton.disabled = page >= totalPages;

    previousButton.addEventListener('click', function () {
        if (page !== 1) {
            page = page - 1;
            parameters.set("page", page);
            window.location.href = encodeURI(uri.href);
        }
    });

    nextButton.addEventListener('click', function () {
        if (page < totalPages) {
            page = page + 1;
            parameters.set("page", page);
            window.location.href = encodeURI(uri.href);
        }
    });
});