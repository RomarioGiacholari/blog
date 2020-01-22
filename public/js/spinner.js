window.addEventListener("load", function () {
    setTimeout(function () {
        var spinner = document.getElementsByClassName("fa-spin")[0];
        var body = document.querySelector("body");
        body.classList.remove("opacity-is-loading");
        spinner.classList.add("hidden");
    }, 200);
});