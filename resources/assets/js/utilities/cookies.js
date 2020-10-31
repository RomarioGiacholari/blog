export default {
    getCookie: function getCookie(name) {
        var cookieList = document.cookie.split(";");
        var cookie = null;

        for (var i = 0; i < cookieList.length; i++) {
            var cookiePair = cookieList[i].split("=");

            if (name == cookiePair[0].trim()) {
                cookie = decodeURIComponent(cookiePair[1]);
            }
        }

        return cookie;
    }
};