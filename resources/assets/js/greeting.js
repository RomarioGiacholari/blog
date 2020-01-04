(function (document) {
    var weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var dateElement = document.getElementById("dateElement");

    var today = new Date();
    var dayIndex = today.getDay();
    var day = weekday[dayIndex];
    var message = "Enjoy the rest of your " + day + "!";

    dateElement.innerText = message;
})(document);