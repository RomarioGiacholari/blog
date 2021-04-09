document.addEventListener("DOMContentLoaded", function () {
    var pagination = JSON.parse(document.getElementById('pagination').dataset.pagination);
    var previousButton = document.getElementById('previous');
    var nextButton = document.getElementById('next');
    var currentPage = parseInt(pagination.currentPage);
    var totalPages = parseInt(pagination.totalPages);

    // TODO - preserve the query string parameters
    // var urlParameters = new URLSearchParams(window.location.search);
    // var x = urlParameters.get('x');
    // var y = urlParameters.get('y');
    // var z = urlParameters.get('z');

    previousButton.addEventListener('click', function () {
        if (currentPage === 1) {
            previousButton.disabled = true;
        } else {
            previousButton.disabled = false;
            var page = currentPage - 1;
            var uri = '/posts?currentPage=' + page;
            window.location.href = encodeURI(uri);
        }
    });

    nextButton.addEventListener('click', function () {
        if (currentPage >= totalPages) {
            nextButton.disabled = true;
        } else {
            nextButton.disabled = false;
            var page = currentPage + 1;
            var uri = '/posts?currentPage=' + page;
            window.location.href = encodeURI(uri);
        }
    });
});